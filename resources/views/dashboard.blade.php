<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; min-height: 100vh; }
        .navbar {
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h2 { color: white; font-size: 20px; }
        .navbar form button {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.4);
            padding: 8px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        .container { max-width: 800px; margin: 50px auto; padding: 0 20px; }
        .welcome-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            text-align: center;
        }
        .emoji { font-size: 60px; margin-bottom: 20px; }
        h1 { font-size: 28px; color: #333; margin-bottom: 10px; }
        h1 span { color: #667eea; }
        p { color: #888; font-size: 16px; line-height: 1.6; }
        .badge {
            display: inline-block;
            background: #ebf4ff;
            color: #667eea;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>🏠 User Dashboard</h2>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">Logout →</button>
        </form>
    </div>
    <div class="container">
        <div class="welcome-card">
            <div class="emoji">🎉</div>
            <h1>Welcome to the Team, <span>{{ $user->name }}</span>!</h1>
            <p>You are logged in as a regular user.<br>We are glad to have you here!</p>
            <div class="badge">👤 Regular User</div>
        </div>
    </div>
</body>
</html>