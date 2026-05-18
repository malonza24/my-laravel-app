<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 440px;
        }
        h1 { font-size: 26px; color: #333; margin-bottom: 6px; text-align: center; }
        .subtitle { color: #888; font-size: 14px; text-align: center; margin-bottom: 28px; }
        label { display: block; font-size: 13px; color: #555; margin-bottom: 6px; font-weight: 600; }
        input, select {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border 0.3s;
            margin-bottom: 16px;
        }
        input:focus, select:focus { border-color: #667eea; }
        button {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #667eea, #764ba2);
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
        .login-link a { color: #667eea; text-decoration: none; font-weight: 600; }
        .success { background: #c6f6d5; color: #276749; padding: 10px 14px; border-radius: 8px; margin-bottom: 16px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Create Account</h1>
        <p class="subtitle">Register as an Admin or Regular User</p>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <label>Full Name</label>
            <input type="text" name="name" placeholder="John Doe" value="{{ old('name') }}"/>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label>Email Address</label>
            <input type="email" name="email" placeholder="john@example.com" value="{{ old('email') }}"/>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label>Password</label>
            <input type="password" name="password" placeholder="Min 6 characters"/>
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Repeat password"/>

            <label>Register As</label>
            <select name="role">
                <option value="">-- Select Role --</option>
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Regular User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Create Account 🚀</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="/login">Log in here</a>
        </div>
    </div>
</body>
</html>