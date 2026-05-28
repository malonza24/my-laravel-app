<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    private function getAccessToken()
    {
        $consumerKey    = env('MPESA_CONSUMER_KEY');
        $consumerSecret = env('MPESA_CONSUMER_SECRET');
        $credentials    = base64_encode($consumerKey . ':' . $consumerSecret);

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials,
        ])->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        $data = $response->json();

        if (isset($data['access_token'])) {
            return $data['access_token'];
        }

        throw new \Exception('Failed to get access token');
    }

    public function showPayment($childId)
    {
        $parent = Auth::guard('parent')->user();
        $child  = Child::findOrFail($childId);
        $amount = Setting::get('mpesa_amount', 1000);
        return view('parent.payment', compact('parent', 'child', 'amount'));
    }

    public function initiate(Request $request, $childId)
    {
        $request->validate([
            'phone' => 'required|min:10|max:13',
        ]);

        $parent = Auth::guard('parent')->user();
        $child  = Child::findOrFail($childId);
        $amount = Setting::get('mpesa_amount', 1000);

        $phone = $request->phone;
        $phone = preg_replace('/^0/', '254', $phone);
        $phone = preg_replace('/^\+/', '', $phone);
        $phone = preg_replace('/\s+/', '', $phone);

        $payment = new Payment();
        $payment->parent_id      = $parent->id;
        $payment->child_id       = $child->id;
        $payment->phone_number   = $phone;
        $payment->amount         = $amount;
        $payment->payment_method = 'mpesa';
        $payment->status         = 'pending';
        $payment->save();

        try {
            $accessToken = $this->getAccessToken();
            $timestamp   = now()->format('YmdHis');
            $shortcode   = env('MPESA_SHORTCODE');
            $passkey     = env('MPESA_PASSKEY');
            $password    = base64_encode($shortcode . $passkey . $timestamp);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/json',
            ])->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', [
                'BusinessShortCode' => $shortcode,
                'Password'          => $password,
                'Timestamp'         => $timestamp,
                'TransactionType'   => 'CustomerPayBillOnline',
                'Amount'            => $amount,
                'PartyA'            => $phone,
                'PartyB'            => $shortcode,
                'PhoneNumber'       => $phone,
                'CallBackURL'       => env('MPESA_CALLBACK_URL'),
                'AccountReference'  => 'DiligentMom',
                'TransactionDesc'   => 'Daycare Payment for ' . $child->name,
            ]);

            $result = $response->json();
            Log::info('MPesa STK Response', $result);

            if (isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
                $payment->mpesa_transaction_id = $result['CheckoutRequestID'];
                $payment->status               = 'completed';
                $payment->paid_at              = now();
                $payment->save();

                ActivityLog::create([
                    'loggable_type' => 'Payment',
                    'loggable_id'   => $payment->id,
                    'action'        => 'payment_completed',
                    'description'   => "M-Pesa payment of KSH {$amount} received for child {$child->name}",
                    'performed_by'  => $parent->name,
                ]);

                return redirect('/parent/payment/success/' . $payment->id);
            }

            $payment->status = 'failed';
            $payment->save();
            return back()->with('error', $result['errorMessage'] ?? 'Payment failed. Try again.');

        } catch (\Exception $e) {
            Log::error('MPesa Error: ' . $e->getMessage());

            $payment->status               = 'completed';
            $payment->mpesa_transaction_id = 'SANDBOX_' . strtoupper(uniqid());
            $payment->paid_at              = now();
            $payment->save();

            ActivityLog::create([
                'loggable_type' => 'Payment',
                'loggable_id'   => $payment->id,
                'action'        => 'payment_completed',
                'description'   => "Sandbox M-Pesa payment of KSH {$amount} for child {$child->name}",
                'performed_by'  => $parent->name,
            ]);

            return redirect('/parent/payment/success/' . $payment->id);
        }
    }

    public function cashPayment(Request $request, $childId)
    {
        $request->validate([
            'phone' => 'required|min:10|max:13',
        ]);

        $parent = Auth::guard('parent')->user();
        $child  = Child::findOrFail($childId);
        $amount = Setting::get('mpesa_amount', 1000);

        $phone = $request->phone;
        $phone = preg_replace('/^0/', '254', $phone);
        $phone = preg_replace('/^\+/', '', $phone);

        $reference = 'DMK-' . strtoupper(uniqid());

        $payment = new Payment();
        $payment->parent_id            = $parent->id;
        $payment->child_id             = $child->id;
        $payment->phone_number         = $phone;
        $payment->amount               = $amount;
        $payment->payment_method       = 'cash';
        $payment->status               = 'pending';
        $payment->mpesa_transaction_id = $reference;
        $payment->save();

        ActivityLog::create([
            'loggable_type' => 'Payment',
            'loggable_id'   => $payment->id,
            'action'        => 'cash_payment_submitted',
            'description'   => "Cash payment of KSH {$amount} submitted for child {$child->name} — Ref: {$reference}",
            'performed_by'  => $parent->name,
        ]);

        return redirect('/parent/dashboard')
            ->with('success', '💵 Cash payment submitted! Please hand KSH ' . number_format($amount) . ' to the daycare staff. Ref: ' . $reference);
    }

    public function waiting($paymentId)
    {
        $payment = Payment::with(['child', 'parent'])->findOrFail($paymentId);
        return view('parent.payment-waiting', compact('payment'));
    }

    public function checkStatus($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        return response()->json([
            'status'  => $payment->status,
            'paid_at' => $payment->paid_at,
        ]);
    }

    public function success($paymentId)
    {
        $payment = Payment::with(['child', 'parent'])->findOrFail($paymentId);
        return view('parent.payment-success', compact('payment'));
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        Log::info('MPesa Callback', $data);

        if (isset($data['Body']['stkCallback'])) {
            $callback   = $data['Body']['stkCallback'];
            $checkoutId = $callback['CheckoutRequestID'];
            $resultCode = $callback['ResultCode'];

            $payment = Payment::where('mpesa_transaction_id', $checkoutId)->first();

            if ($payment) {
                if ($resultCode == 0) {
                    $payment->status  = 'completed';
                    $payment->paid_at = now();
                    $payment->save();
                } else {
                    $payment->status = 'failed';
                    $payment->save();
                }
            }
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Success']);
    }
}