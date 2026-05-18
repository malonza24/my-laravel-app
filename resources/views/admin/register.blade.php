<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register - Diligent Mom</title>
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
            max-width: 440px;
        }
        .logo { text-align: center; margin-bottom: 24px; }
        .logo h1 { font-size: 24px; color: #2d3748; }
        .logo p { color: #888; font-size: 13px; margin-top: 4px; }
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
        input:focus, select:focus { border-color: #2d3748; }
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
        .login-link { text-align: center; margin-top: 20px; font-size: 14px; color: #888; }
        .login-link a { color: #2d3748; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">
            <h1>⚙️ Admin Register</h1>
            <p>Diligent Mom Support System</p>
        </div>

        <form action="/admin/register" method="POST">
            @csrf
            <label>Full Name</label>
            <input type="text" name="name" placeholder="John Admin" value="{{ old('name') }}"/>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label>Email Address</label>
            <input type="email" name="email" placeholder="admin@example.com" value="{{ old('email') }}"/>
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label>Password</label>
            <input type="password" name="password" placeholder="Min 6 characters"/>
            @error('password') <div class="error">{{ $message }}</div> @enderror

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Repeat password"/>

            <label>Role</label>
            <select name="role">
                <option value="admin">Admin</option>
            </select>

            <button type="submit">Create Admin Account 🚀</button>
        </form>
<div class="login-link">
    Already have an account? <a href="/admin/login">Log in here</a>
</div>
<div class="login-link" style="margin-top:10px;">
    <a href="/">← Back to Home</a>
</div>
        
    </div>
</body>
</html>