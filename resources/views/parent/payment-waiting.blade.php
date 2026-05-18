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
        p { color: #888; font-size: 14px; line-height: 1.6; }
        a { display: inline-block; margin-top: 24px; color: #f5576c; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="spinner"></div>
        <h1>Waiting for Payment...</h1>
        <p>An STK push has been sent to your phone.<br>Please enter your M-Pesa PIN to complete payment.</p>
        <a href="/parent/dashboard">← Go to Dashboard</a>
    </div>
</body>
</html>