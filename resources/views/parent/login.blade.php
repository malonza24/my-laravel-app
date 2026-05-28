<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Login - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #f43f5e; --primary-dark: #e11d48; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container { display: flex; width: 100%; max-width: 900px; border-radius: 24px; overflow: hidden; box-shadow: 0 32px 80px rgba(0,0,0,0.4); }
        .left {
            flex: 1;
            background: linear-gradient(135deg, #f43f5e, #fb7185, #f97316);
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 48px; }
        .brand-icon { width: 48px; height: 48px; background: rgba(255,255,255,0.2); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; }
        .brand h1 { color: white; font-size: 20px; font-weight: 800; }
        .left h2 { color: white; font-size: 32px; font-weight: 800; line-height: 1.3; margin-bottom: 16px; }
        .left p { color: rgba(255,255,255,0.8); font-size: 15px; line-height: 1.7; margin-bottom: 32px; }
        .features { display: flex; flex-direction: column; gap: 14px; }
        .feature { display: flex; align-items: center; gap: 12px; color: rgba(255,255,255,0.9); font-size: 14px; }
        .feature-icon { width: 34px; height: 34px; background: rgba(255,255,255,0.15); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .right { width: 420px; background: white; padding: 48px; display: flex; flex-direction: column; justify-content: center; }
        .right h2 { font-size: 26px; font-weight: 800; color: var(--text); margin-bottom: 6px; }
        .right p { color: var(--text-light); font-size: 14px; margin-bottom: 32px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 13px; color: var(--text); margin-bottom: 8px; font-weight: 600; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-light); width: 18px; height: 18px; }
        input { width: 100%; padding: 13px 14px 13px 44px; border: 2px solid var(--border); border-radius: 10px; font-size: 15px; outline: none; transition: border 0.2s; color: var(--text); }
        input:focus { border-color: var(--primary); }
        .error { color: #dc2626; font-size: 12px; margin-top: 6px; }
        .btn { width: 100%; padding: 14px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 8px; }
        .btn:hover { opacity: 0.9; }
        .success { background: #ecfdf5; color: #059669; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px; }
        .link-row { text-align: center; margin-top: 20px; font-size: 14px; color: var(--text-light); }
        .link-row a { color: var(--primary); text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <div class="brand">
                <div class="brand-icon"><i data-lucide="heart" style="width:22px;height:22px;"></i></div>
                <h1>Diligent Mom</h1>
            </div>
            <h2>Your child is in safe hands</h2>
            <p>Sign in to manage your child's daycare registration, payments and attendance.</p>
            <div class="features">
                <div class="feature">
                    <div class="feature-icon"><i data-lucide="user-check" style="width:16px;height:16px;"></i></div>
                    Register and manage your children
                </div>
                <div class="feature">
                    <div class="feature-icon"><i data-lucide="clock" style="width:16px;height:16px;"></i></div>
                    Track check-in and check-out times
                </div>
                <div class="feature">
                    <div class="feature-icon"><i data-lucide="smartphone" style="width:16px;height:16px;"></i></div>
                    Pay securely via M-Pesa or cash
                </div>
            </div>
        </div>
        <div class="right">
            <h2>Welcome Back</h2>
            <p>Sign in to your parent account</p>

            @if(session('success'))
                <div class="success"><i data-lucide="check-circle" style="width:16px;height:16px;"></i> {{ session('success') }}</div>
            @endif

            <form action="/parent/login" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrap">
                        <i data-lucide="mail" class="input-icon"></i>
                        <input type="email" name="email" placeholder="jane@example.com" value="{{ old('email') }}"/>
                    </div>
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrap">
                        <i data-lucide="lock" class="input-icon"></i>
                        <input type="password" name="password" placeholder="Your password"/>
                    </div>
                    @error('password') <div class="error">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn">
                    <i data-lucide="log-in" style="width:18px;height:18px;"></i>
                    Sign In
                </button>
            </form>
            <div class="link-row">Don't have an account? <a href="/parent/register">Register here</a></div>
            <div class="link-row" style="margin-top:8px;"><a href="/">Back to Home</a></div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>