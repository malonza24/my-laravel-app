<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Diligent Mom</title>
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
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 440px;
            text-align: center;
            animation: popIn 0.5s ease;
        }
        @keyframes popIn {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .icon { font-size: 64px; margin-bottom: 16px; }
        h1 { font-size: 26px; color: #333; margin-bottom: 10px; }
        h1 span { color: #4CAF50; }
        .details { background: #f8f9fa; border-radius: 12px; padding: 20px; margin: 20px 0; text-align: left; }
        .details p { font-size: 14px; color: #555; margin-bottom: 8px; }
        .details p strong { color: #333; }
        a {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">🎉</div>
        <h1>Payment <span>Successful!</span></h1>
        <div class="details">
            <p><strong>👶 Child:</strong> {{ $payment->child->name }}</p>
            <p><strong>💰 Amount:</strong> KSH {{ number_format($payment->amount) }}</p>
            <p><strong>📱 Phone:</strong> {{ $payment->phone_number }}</p>
            <p><strong>🔖 Transaction ID:</strong> {{ $payment->mpesa_transaction_id }}</p>
            <p><strong>📅 Date:</strong> {{ $payment->paid_at->format('M d, Y H:i') }}</p>
        </div>
        <a href="/parent/dashboard">← Back to Dashboard</a>
    </div>
</body>
</html>