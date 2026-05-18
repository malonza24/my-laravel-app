<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Register - Diligent Mom</title>
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
            max-width: 480px;
        }
        .logo { text-align: center; margin-bottom: 24px; }
        .logo h1 { font-size: 24px; color: #f5576c; }
        .logo p { color: #888; font-size: 13px; }
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
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 4px;
        }
        button:hover { opacity: 0.9; }
        .error { color: #e53e3e; font-size: 12px; margin-top: -12px; margin-bottom: 12px; }
        .login-link { text-align: center; margin-top: 20px; font-size: 14px; color: #888; }
        .login-link a { color: #f5576c; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <h1>👶 Diligent Mom</h1>
            <p>Support System — Create Parent Account</p>
        </div>

        <form action="/parent/register" method="POST">
            @csrf
            <label>Full Name</label>
            <input type="text" name="name" placeholder="Jane Doe" value="{{ old('name') }}"/>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label>Email Address</label>
            <input type="email" name="email" placeholder="jane@example.com" value="{{ old('email') }}"/>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label>Phone Number</label>
            <input type="text" name="phone" placeholder="0712345678" value="{{ old('phone') }}"/>
            @error('phone') <div class="error">{{ $message }}</div> @enderror

            <label>ID Number</label>
            <input type="text" name="id_number" placeholder="12345678" value="{{ old('id_number') }}"/>
            @error('id_number') <div class="error">{{ $message }}</div> @enderror

            <label>Password</label>
            <input type="password" name="password" placeholder="Min 6 characters"/>
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Repeat password"/>

            <button type="submit">Create Account 🚀</button>
        </form>

       <div class="login-link">
    Already have an account? <a href="/parent/login">Log in here</a>
</div>
<div class="login-link" style="margin-top:10px;">
    <a href="/">← Back to Home</a>
</div>
    </div>
</body>
</html>