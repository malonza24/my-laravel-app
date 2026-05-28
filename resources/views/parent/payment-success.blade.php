<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f43f5e 0%, #fb7185 50%, #f97316 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 24px;
            padding: 48px 40px;
            width: 100%;
            max-width: 480px;
            text-align: center;
            box-shadow: 0 32px 80px rgba(0,0,0,0.2);
            animation: popIn 0.5s ease;
        }
        @keyframes popIn { 0% { transform: scale(0.8); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: white;
        }
        h1 { font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 8px; }
        h1 span { color: #10b981; }
        p { color: #64748b; font-size: 15px; margin-bottom: 28px; }
        .details {
            background: #f8fafc;
            border-radius: 14px;
            padding: 20px;
            text-align: left;
            margin-bottom: 28px;
        }
        .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #e2e8f0; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 6px; }
        .detail-value { font-size: 14px; font-weight: 600; color: #1e293b; }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 28px;
            background: linear-gradient(135deg, #f43f5e, #e11d48);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
        }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="card">
        <div class="success-icon">
            <i data-lucide="check" style="width:36px;height:36px;"></i>
        </div>
        <h1>Payment <span>Successful!</span></h1>
        <p>Your payment has been received and confirmed successfully.</p>

        <div class="details">
            <div class="detail-row">
                <span class="detail-label"><i data-lucide="user" style="width:14px;height:14px;"></i> Child</span>
                <span class="detail-value">{{ $payment->child->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i data-lucide="banknote" style="width:14px;height:14px;"></i> Amount</span>
                <span class="detail-value">KSH {{ number_format($payment->amount) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i data-lucide="smartphone" style="width:14px;height:14px;"></i> Phone</span>
                <span class="detail-value">{{ $payment->phone_number }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i data-lucide="hash" style="width:14px;height:14px;"></i> Reference</span>
                <span class="detail-value" style="font-size:12px;">{{ $payment->mpesa_transaction_id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i data-lucide="calendar" style="width:14px;height:14px;"></i> Date</span>
                <span class="detail-value">{{ $payment->paid_at ? $payment->paid_at->format('M d, Y H:i') : now()->format('M d, Y H:i') }}</span>
            </div>
        </div>

        <a href="/parent/dashboard" class="btn">
            <i data-lucide="arrow-left" style="width:18px;height:18px;"></i>
            Back to Dashboard
        </a>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>