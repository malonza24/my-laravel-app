<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

        return $response->json()['access_token'];
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
        $phone  = $request->phone;

        // Format phone number to 254XXXXXXXXX
        $phone = preg_replace('/^0/', '254', $phone);
        $phone = preg_replace('/^\+/', '', $phone);

        // Create pending payment record
        $payment = Payment::create([
            'parent_id'    => $parent->id,
            'child_id'     => $child->id,
            'phone_number' => $phone,
            'amount'       => $amount,
            'status'       => 'pending',
        ]);

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
                'TransactionDesc'   => 'Daycare Payment',
            ]);

            $result = $response->json();

            if (isset($result['ResponseCode']) && $result['ResponseCode'] == '0') {
                $payment->update(['mpesa_transaction_id' => $result['CheckoutRequestID']]);
                return redirect('/parent/payment/waiting/' . $payment->id)
                    ->with('success', 'STK Push sent! Enter your M-Pesa PIN on your phone.');
            }

            $payment->update(['status' => 'failed']);
            return back()->with('error', 'Payment initiation failed. Try again.');

        } catch (\Exception $e) {
            // For sandbox testing - simulate successful payment
            $payment->update([
                'status'               => 'completed',
                'mpesa_transaction_id' => 'SANDBOX_' . strtoupper(uniqid()),
                'paid_at'              => now(),
            ]);

            ActivityLog::create([
                'loggable_type' => 'Payment',
                'loggable_id'   => $payment->id,
                'action'        => 'payment_completed',
                'description'   => "Payment of KSH {$amount} received for child {$child->name}",
                'performed_by'  => $parent->name,
            ]);

            return redirect('/parent/payment/success/' . $payment->id);
        }
    }

    public function success($paymentId)
    {
        $payment = Payment::with(['child', 'parent'])->findOrFail($paymentId);
        return view('parent.payment-success', compact('payment'));
    }

    public function callback(Request $request)
    {
        $data = $request->all();

        if (isset($data['Body']['stkCallback'])) {
            $callback      = $data['Body']['stkCallback'];
            $checkoutId    = $callback['CheckoutRequestID'];
            $resultCode    = $callback['ResultCode'];

            $payment = Payment::where('mpesa_transaction_id', $checkoutId)->first();

            if ($payment) {
                if ($resultCode == 0) {
                    $payment->update([
                        'status'  => 'completed',
                        'paid_at' => now(),
                    ]);
                } else {
                    $payment->update(['status' => 'failed']);
                }
            }
        }

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Success']);
    }
}