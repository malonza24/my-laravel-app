<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Team!</title>
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
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 480px;
            text-align: center;
            animation: popIn 0.5s ease;
        }

        @keyframes popIn {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .emoji { font-size: 64px; margin-bottom: 20px; }

        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 12px;
        }

        h1 span {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: #888;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            transition: opacity 0.3s;
        }

        a:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="card">
        <div class="emoji">🎉</div>
        <h1>Welcome to the Team, <span>{{ $name }}</span>!</h1>
        <p>
            We are thrilled to have you on board.<br>
            Great things are ahead — let's build something amazing together!
        </p>
        <a href="/">← Go Back</a>
    </div>
</body>
</html>