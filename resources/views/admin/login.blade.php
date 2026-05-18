<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Diligent Mom</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
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
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 420px;
        }
        .logo { text-align: center; margin-bottom: 24px; }
        .logo h1 { font-size: 24px; color: #2d3748; }
        .logo p { color: #888; font-size: 13px; margin-top: 4px; }
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
        input:focus { border-color: #2d3748; }
        button {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #2d3748, #1a202c);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover { opacity: 0.9; }
        .error { color: #e53e3e; font-size: 12px; margin-top: -12px; margin-bottom: 12px; }
        .success { background: #c6f6d5; color: #276749; padding: 10px 14px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; }
        .register-link { text-align: center; margin-top: 20px; font-size: 14px; color: #888; }
        .register-link a { color: #2d3748; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <h1>⚙️ Admin Panel</h1>
            <p>Diligent Mom Support System</p>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="/admin/login" method="POST">
            @csrf
            <label>Email Address</label>
            <input type="email" name="email" placeholder="admin@example.com" value="{{ old('email') }}"/>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label>Password</label>
            <input type="password" name="password" placeholder="Your password"/>
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Log In →</button>
        </form>

        <div class="register-link">
    Need an account? <a href="/admin/register">Register here</a>
</div>
<div class="register-link" style="margin-top:10px;">
    <a href="/">← Back to Home</a>
</div>
    </div>
</body>
</html>