<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class SmsService
{
    private $AT;
    private $sms;

    public function __construct()
    {
        $this->AT = new \AfricasTalking\SDK\AfricasTalking(
            env('AT_USERNAME', 'sandbox'),
            env('AT_API_KEY')
        );
        $this->sms = $this->AT->sms();
    }

    public function send($phone, $message)
    {
        try {
            // Format phone to +254XXXXXXXXX
            $phone = preg_replace('/^0/', '254', $phone);
            $phone = preg_replace('/^\+254/', '254', $phone);
            $phone = '+' . ltrim($phone, '+');

            $result = $this->sms->send([
                'to'      => $phone,
                'message' => $message,
                // No 'from' in sandbox — causes InvalidSenderId error
            ]);

            Log::info('SMS sent', ['phone' => $phone, 'result' => $result]);
            return true;

        } catch (\Exception $e) {
            Log::error('SMS failed: ' . $e->getMessage());
            return false;
        }
    }

    public function sendCashPaymentReceived($parent, $child, $amount, $reference)
    {
        $message = "Dear {$parent->name}, your cash payment of KSH " . number_format($amount) . " for {$child->name} at Diligent Mom Daycare has been received and is pending confirmation. Ref: {$reference}. We will notify you once confirmed.";
        return $this->send($parent->phone, $message);
    }

    public function sendPaymentConfirmed($parent, $child, $amount, $reference)
    {
        $message = "Dear {$parent->name}, your payment of KSH " . number_format($amount) . " for {$child->name} has been CONFIRMED. Ref: {$reference}. Thank you for choosing Diligent Mom Daycare!";
        return $this->send($parent->phone, $message);
    }

    public function sendPaymentDeclined($parent, $child, $amount, $reason)
    {
        $message = "Dear {$parent->name}, your payment of KSH " . number_format($amount) . " for {$child->name} has been DECLINED. Reason: {$reason}. Please contact Diligent Mom Daycare. Tel: 0708295236";
        return $this->send($parent->phone, $message);
    }

    public function sendMpesaPaymentConfirmed($parent, $child, $amount, $transactionId)
    {
        $message = "Dear {$parent->name}, M-Pesa payment of KSH " . number_format($amount) . " for {$child->name} has been received. Transaction ID: {$transactionId}. Thank you for choosing Diligent Mom Daycare!";
        return $this->send($parent->phone, $message);
    }
}