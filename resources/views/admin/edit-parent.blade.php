<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parent - Diligent Mom Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; min-height: 100vh; display: flex; }
        .sidebar { width: 250px; background: linear-gradient(180deg, #2d3748, #1a202c); min-height: 100vh; padding: 24px 0; position: fixed; top: 0; left: 0; }
        .sidebar .brand { padding: 0 24px 24px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 16px; }
        .sidebar .brand h2 { color: white; font-size: 18px; }
        .sidebar .brand p { color: rgba(255,255,255,0.5); font-size: 12px; margin-top: 4px; }
        .sidebar a { display: flex; align-items: center; gap: 10px; padding: 12px 24px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: white; }
        .sidebar .logout { position: absolute; bottom: 20px; width: 100%; }
        .sidebar .logout form button { width: 100%; padding: 12px 24px; background: none; border: none; color: rgba(255,255,255,0.7); text-align: left; cursor: pointer; font-size: 14px; }
        .main { margin-left: 250px; flex: 1; padding: 32px; }
        .topbar { margin-bottom: 24px; display: flex; align-items: center; gap: 16px; }
        .topbar h1 { font-size: 24px; color: #333; }
        .topbar a { font-size: 13px; color: #667eea; text-decoration: none; }
        .card { background: white; border-radius: 12px; padding: 32px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); max-width: 500px; }
        label { display: block; font-size: 13px; color: #555; margin-bottom: 6px; font-weight: 600; }
        input { width: 100%; padding: 12px 14px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; outline: none; margin-bottom: 16px; }
        input:focus { border-color: #2d3748; }
        button { padding: 12px 28px; background: linear-gradient(135deg, #2d3748, #1a202c); color: white; border: none; border-radius: 8px; font-size: 15px; cursor: pointer; }
        .error { color: #e53e3e; font-size: 12px; margin-top: -12px; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">
            <h2>⚙️ Diligent Mom</h2>
            <p>Admin Panel</p>
        </div>
        <a href="/admin/dashboard">📊 Dashboard</a>
        <a href="/admin/parents" class="active">👩 Parents</a>
        <a href="/admin/children">👶 Children</a>
        <a href="/admin/payments">💳 Payments</a>
        <a href="/admin/settings">⚙️ Settings</a>
        <a href="/admin/activity">📋 Activity Logs</a>
        <div class="logout">
            <form action="/admin/logout" method="POST">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <h1>✏️ Edit Parent</h1>
            <a href="/admin/parents">← Back to Parents</a>
        </div>

        <div class="card">
            <form action="/admin/parents/{{ $parent->id }}/edit" method="POST">
                @csrf
                <label>Full Name</label>
                <input type="text" name="name" value="{{ old('name', $parent->name) }}"/>
                @error('name') <div class="error">{{ $message }}</div> @enderror

                <label>Email Address</label>
                <input type="email" name="email" value="{{ old('email', $parent->email) }}"/>
                @error('email') <div class="error">{{ $message }}</div> @enderror

                <label>Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone', $parent->phone) }}"/>
                @error('phone') <div class="error">{{ $message }}</div> @enderror

                <label>ID Number</label>
                <input type="text" name="id_number" value="{{ old('id_number', $parent->id_number) }}"/>
                @error('id_number') <div class="error">{{ $message }}</div> @enderror

                <button type="submit">Save Changes 💾</button>
            </form>
        </div>
    </div>
</body>
</html>