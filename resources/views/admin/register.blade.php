<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #6366f1; --primary-dark: #4f46e5; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 24px;
            padding: 48px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 32px 80px rgba(0,0,0,0.4);
        }
        .brand { display: flex; align-items: center; gap: 12px; margin-bottom: 32px; }
        .brand-icon { width: 48px; height: 48px; background: linear-gradient(135deg, #6366f1, #ec4899); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; }
        .brand h1 { font-size: 18px; font-weight: 800; color: var(--text); }
        .brand p { font-size: 12px; color: var(--text-light); }
        h2 { font-size: 24px; font-weight: 800; color: var(--text); margin-bottom: 6px; }
        .subtitle { color: var(--text-light); font-size: 14px; margin-bottom: 28px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; color: var(--text); margin-bottom: 8px; font-weight: 600; }
        .input-wrap { position: relative; }
        .input-wrap .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-light); width: 18px; height: 18px; }
        input, select {
            width: 100%;
            padding: 13px 14px 13px 44px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            transition: border 0.2s;
            color: var(--text);
        }
        input:focus, select:focus { border-color: var(--primary); }
        .btn { width: 100%; padding: 14px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 8px; }
        .btn:hover { opacity: 0.9; }
        .error { color: #dc2626; font-size: 12px; margin-top: 6px; }
        .link-row { text-align: center; margin-top: 20px; font-size: 14px; color: var(--text-light); }
        .link-row a { color: var(--primary); text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <div class="brand">
            <div class="brand-icon"><i data-lucide="heart" style="width:22px;height:22px;"></i></div>
            <div>
                <h1>Diligent Mom</h1>
                <p>Admin Registration</p>
            </div>
        </div>
        <h2>Create Admin Account</h2>
        <p class="subtitle">Fill in your details to create an admin account</p>
        <form action="/admin/register" method="POST">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <div class="input-wrap">
                    <i data-lucide="user" class="input-icon"></i>
                    <input type="text" name="name" placeholder="John Admin" value="{{ old('name') }}"/>
                </div>
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <i data-lucide="mail" class="input-icon"></i>
                    <input type="email" name="email" placeholder="admin@example.com" value="{{ old('email') }}"/>
                </div>
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i data-lucide="lock" class="input-icon"></i>
                    <input type="password" name="password" placeholder="Min 6 characters"/>
                </div>
                @error('password') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <div class="input-wrap">
                    <i data-lucide="lock" class="input-icon"></i>
                    <input type="password" name="password_confirmation" placeholder="Repeat password"/>
                </div>
            </div>
            <input type="hidden" name="role" value="admin"/>
            <button type="submit" class="btn">
                <i data-lucide="user-plus" style="width:18px;height:18px;"></i>
                Create Account
            </button>
        </form>
        <div class="link-row">Already have an account? <a href="/admin/login">Sign in here</a></div>
        <div class="link-row" style="margin-top:8px;"><a href="/">Back to Home</a></div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>