<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
            max-width: 420px;
            text-align: center;
        }
        h1 { font-size: 28px; color: #333; margin-bottom: 8px; }
        p { color: #888; margin-bottom: 30px; font-size: 15px; }
        input[type="text"] {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            transition: border 0.3s;
            margin-bottom: 16px;
        }
        input[type="text"]:focus { border-color: #667eea; }
        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: opacity 0.3s;
        }
        button:hover { opacity: 0.9; }
        .error { color: #e53e3e; font-size: 13px; margin-top: -10px; margin-bottom: 12px; text-align: left; }
    </style>
</head>
<body>
    <div class="card">
        <h1>👋 Hello There!</h1>
        <p>Enter your name to join the team</p>
        <form action="/greet" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Enter your name..." value="{{ old('name') }}" autofocus/>
            @error('name')
                <div class="error">⚠️ {{ $message }}</div>
            @enderror
            <button type="submit">Join the Team 🚀</button>
        </form>
    </div>
</body>
</html>
