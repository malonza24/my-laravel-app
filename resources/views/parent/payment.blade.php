<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Diligent Mom</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 440px;
        }
        .logo { text-align: center; margin-bottom: 24px; }
        .logo h1 { font-size: 22px; color: #333; }
        .logo p { color: #888; font-size: 13px; margin-top: 4px; }
        .amount-box {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin-bottom: 24px;
            color: white;
        }
        .amount-box .amount { font-size: 36px; font-weight: 700; }
        .amount-box p { font-size: 13px; opacity: 0.9; margin-top: 4px; }
        .child-info { background: #f8f9fa; border-radius: 8px; padding: 14px; margin-bottom: 24px; font-size: 14px; color: #555; }
        .child-info p { margin-bottom: 4px; }
        label { display: block; font-size: 13px; color: #555; margin-bottom: 6px; font-weight: 600; }
        input {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border 0.3s;
            margin-bottom: 16px;
        }
        input:focus { border-color: #f5576c; }
        button {
            width: 100%;
            padding: 13px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover { opacity: 0.9; }
        .error { color: #e53e3e; font-size: 12px; margin-top: -12px; margin-bottom: 12px; }
        .mpesa-logo { text-align: center; margin-bottom: 16px; font-size: 28px; }
        .info { font-size: 12px; color: #888; text-align: center; margin-top: 12px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <h1>💳 M-Pesa Payment</h1>
            <p>Complete payment to confirm registration</p>
        </div>

        <div class="amount-box">
            <div class="amount">KSH {{ number_format($amount) }}</div>
            <p>Daily Daycare Fee</p>
        </div>

        <div class="child-info">
            <p>👶 <strong>Child:</strong> {{ $child->name }}</p>
            <p>🕐 <strong>Check-in:</strong> {{ $child->checkin_time }}</p>
            <p>🕐 <strong>Check-out:</strong> {{ $child->checkout_time }}</p>
        </div>

        <div class="mpesa-logo">📱</div>

        <form action="/parent/payment/{{ $child->id }}" method="POST">
            @csrf
            <label>M-Pesa Phone Number</label>
            <input type="text" name="phone" placeholder="0712345678" value="{{ $parent->phone }}"/>
            @error('phone') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Pay KSH {{ number_format($amount) }} via M-Pesa 📱</button>
        </form>

        <p class="info">You will receive an STK push on your phone. Enter your M-Pesa PIN to complete payment.</p>
    </div>
</body>
</html>