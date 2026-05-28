<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #f43f5e; --primary-dark: #e11d48; --success: #10b981; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; --bg: #f8fafc; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 60%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 24px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.4);
            overflow: hidden;
            animation: popIn 0.5s ease;
        }
        @keyframes popIn { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        .card-header {
            background: linear-gradient(135deg, var(--primary), #f97316);
            padding: 32px;
            text-align: center;
            color: white;
        }
        .card-header .header-icon { width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
        .card-header h1 { font-size: 22px; font-weight: 800; margin-bottom: 4px; }
        .card-header p { font-size: 14px; opacity: 0.85; }
        .amount-display {
            background: rgba(255,255,255,0.15);
            border-radius: 14px;
            padding: 16px;
            margin-top: 20px;
            backdrop-filter: blur(4px);
        }
        .amount-display .amount { font-size: 40px; font-weight: 900; }
        .amount-display .label { font-size: 13px; opacity: 0.8; margin-top: 4px; }
        .card-body { padding: 28px 32px; }
        .child-info {
            background: var(--bg);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
            border: 1px solid var(--border);
        }
        .child-info-row { display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--text-light); margin-bottom: 6px; }
        .child-info-row:last-child { margin-bottom: 0; }
        .child-info-row strong { color: var(--text); }
        .tab-label { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
        .payment-tabs { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 24px; }
        .tab-btn {
            padding: 14px;
            border: 2px solid var(--border);
            border-radius: 12px;
            background: white;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        .tab-btn .tab-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: var(--bg); transition: all 0.2s; }
        .tab-btn:hover { border-color: var(--primary); color: var(--primary); }
        .tab-btn.active { border-color: var(--primary); background: #fff1f2; color: var(--primary); }
        .tab-btn.active .tab-icon { background: var(--primary); color: white; }
        .payment-form { display: none; }
        .payment-form.active { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 13px; color: var(--text); margin-bottom: 8px; font-weight: 600; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-light); width: 18px; height: 18px; }
        input { width: 100%; padding: 13px 14px 13px 44px; border: 2px solid var(--border); border-radius: 10px; font-size: 15px; outline: none; transition: border 0.2s, box-shadow 0.2s; color: var(--text); }
        input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(244,63,94,0.1); }
        .error { color: #dc2626; font-size: 12px; margin-top: 6px; display: flex; align-items: center; gap: 4px; }
        .btn-mpesa {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity 0.2s, transform 0.2s;
        }
        .btn-mpesa:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-cash {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: opacity 0.2s, transform 0.2s;
        }
        .btn-cash:hover { opacity: 0.9; transform: translateY(-1px); }
        .cash-notice {
            background: #fffbeb;
            border: 1px solid #fed7aa;
            border-radius: 10px;
            padding: 14px;
            font-size: 13px;
            color: #92400e;
            margin-bottom: 16px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            line-height: 1.6;
        }
        .info-note { font-size: 12px; color: var(--text-light); text-align: center; margin-top: 12px; line-height: 1.6; }
        .alert { padding: 12px 16px; border-radius: 10px; margin-bottom: 16px; font-size: 14px; display: flex; align-items: center; gap: 8px; }
        .alert-success { background: #ecfdf5; color: #059669; }
        .alert-error { background: #fef2f2; color: #dc2626; }
        .back-link { display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 20px; font-size: 14px; color: var(--text-light); text-decoration: none; }
        .back-link:hover { color: var(--text); }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="header-icon">
                <i data-lucide="credit-card" style="width:28px;height:28px;"></i>
            </div>
            <h1>Complete Payment</h1>
            <p>Choose your preferred payment method</p>
            <div class="amount-display">
                <div class="amount">KSH {{ number_format($amount) }}</div>
                <div class="label">Daily Daycare Fee</div>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success"><i data-lucide="check-circle" style="width:16px;height:16px;"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-error"><i data-lucide="alert-circle" style="width:16px;height:16px;"></i> {{ session('error') }}</div>
            @endif

            <div class="child-info">
                <div class="child-info-row">
                    <i data-lucide="user" style="width:14px;height:14px;"></i>
                    <strong>Child:</strong> {{ $child->name }}
                </div>
                <div class="child-info-row">
                    <i data-lucide="log-in" style="width:14px;height:14px;"></i>
                    <strong>Check-in:</strong> {{ $child->checkin_time }}
                </div>
                <div class="child-info-row">
                    <i data-lucide="log-out" style="width:14px;height:14px;"></i>
                    <strong>Check-out:</strong> {{ $child->checkout_time }}
                </div>
            </div>

            <div class="tab-label">
                <i data-lucide="layers" style="width:14px;height:14px;"></i>
                Select Payment Method
            </div>

            <div class="payment-tabs">
                <button class="tab-btn active" onclick="switchTab('mpesa', this)">
                    <div class="tab-icon"><i data-lucide="smartphone" style="width:18px;height:18px;"></i></div>
                    M-Pesa
                </button>
                <button class="tab-btn" onclick="switchTab('cash', this)">
                    <div class="tab-icon"><i data-lucide="banknote" style="width:18px;height:18px;"></i></div>
                    Cash
                </button>
            </div>

            <div class="payment-form active" id="mpesa-form">
                <form action="/parent/payment/{{ $child->id }}" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="mpesa"/>
                    <div class="form-group">
                        <label>M-Pesa Phone Number</label>
                        <div class="input-wrap">
                            <i data-lucide="phone" class="input-icon"></i>
                            <input type="text" name="phone" placeholder="0712345678" value="{{ $parent->phone }}"/>
                        </div>
                        @error('phone') <div class="error"><i data-lucide="alert-circle" style="width:12px;height:12px;"></i>{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn-mpesa">
                        <i data-lucide="smartphone" style="width:18px;height:18px;"></i>
                        Pay KSH {{ number_format($amount) }} via M-Pesa
                    </button>
                </form>
                <p class="info-note">You will receive an STK push on your phone. Enter your M-Pesa PIN to complete payment.</p>
            </div>

            <div class="payment-form" id="cash-form">
                <div class="cash-notice">
                    <i data-lucide="info" style="width:16px;height:16px;flex-shrink:0;margin-top:2px;"></i>
                    <div>Please hand <strong>KSH {{ number_format($amount) }}</strong> cash to the daycare staff. Your payment will be recorded as pending until confirmed by the admin.</div>
                </div>
                <form action="/parent/payment/{{ $child->id }}/cash" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" value="cash"/>
                    <div class="form-group">
                        <label>Your Phone Number (for receipt)</label>
                        <div class="input-wrap">
                            <i data-lucide="phone" class="input-icon"></i>
                            <input type="text" name="phone" placeholder="0712345678" value="{{ $parent->phone }}"/>
                        </div>
                        @error('phone') <div class="error"><i data-lucide="alert-circle" style="width:12px;height:12px;"></i>{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn-cash">
                        <i data-lucide="banknote" style="width:18px;height:18px;"></i>
                        Submit Cash Payment Request
                    </button>
                </form>
                <p class="info-note">Admin will confirm your cash payment. You can check out your child once payment is confirmed.</p>
            </div>

            <a href="/parent/dashboard" class="back-link">
                <i data-lucide="arrow-left" style="width:14px;height:14px;"></i>
                Back to Dashboard
            </a>
        </div>
    </div>

    <script>
        function switchTab(method, btn) {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.payment-form').forEach(f => f.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById(method + '-form').classList.add('active');
        }
        lucide.createIcons();
    </script>
</body>
</html>