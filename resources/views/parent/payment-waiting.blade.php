<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting for Payment - Diligent Mom</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: white;
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }
        .spinner {
            width: 60px; height: 60px;
            border: 6px solid #f0f0f0;
            border-top: 6px solid #f5576c;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 24px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        h1 { font-size: 22px; color: #333; margin-bottom: 10px; }
        p { color: #888; font-size: 14px; line-height: 1.6; margin-bottom: 8px; }
        .steps { background: #f8f9fa; border-radius: 10px; padding: 16px; margin: 20px 0; text-align: left; }
        .steps p { color: #555; font-size: 13px; margin-bottom: 6px; }
        .steps p:last-child { margin-bottom: 0; }
        .status-msg { margin-top: 16px; padding: 10px; border-radius: 8px; font-size: 14px; display: none; }
        .status-success { background: #c6f6d5; color: #276749; }
        .status-failed { background: #fed7d7; color: #c53030; }
        a { display: inline-block; margin-top: 16px; color: #f5576c; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="spinner" id="spinner"></div>
        <h1>Waiting for Payment...</h1>
        <p>An STK push has been sent to your phone.</p>

        <div class="steps">
            <p>1️⃣ Check your phone for the M-Pesa prompt</p>
            <p>2️⃣ Enter your M-Pesa PIN</p>
            <p>3️⃣ Wait for confirmation</p>
        </div>

        <p>Amount: <strong>KSH {{ $payment->amount }}</strong></p>
        <p>Phone: <strong>{{ $payment->phone_number }}</strong></p>

        <div class="status-msg" id="statusMsg"></div>
        <a href="/parent/dashboard">← Go to Dashboard</a>
    </div>

    <script>
        const paymentId = {{ $payment->id }};

        function checkPaymentStatus() {
            fetch('/parent/payment/status/' + paymentId)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'completed') {
                        document.getElementById('spinner').style.display = 'none';
                        const msg = document.getElementById('statusMsg');
                        msg.className = 'status-msg status-success';
                        msg.textContent = '✅ Payment received! Redirecting...';
                        msg.style.display = 'block';
                        setTimeout(() => {
                            window.location.href = '/parent/payment/success/' + paymentId;
                        }, 2000);
                    } else if (data.status === 'failed') {
                        document.getElementById('spinner').style.display = 'none';
                        const msg = document.getElementById('statusMsg');
                        msg.className = 'status-msg status-failed';
                        msg.textContent = '❌ Payment failed. Please try again.';
                        msg.style.display = 'block';
                    } else {
                        setTimeout(checkPaymentStatus, 3000);
                    }
                })
                .catch(() => setTimeout(checkPaymentStatus, 3000));
        }

        // Start checking after 5 seconds
        setTimeout(checkPaymentStatus, 5000);
    </script>
</body>
</html>