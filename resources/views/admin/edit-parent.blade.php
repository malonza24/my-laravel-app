<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Parent - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #6366f1; --primary-dark: #4f46e5; --bg: #f1f5f9; --sidebar: #0f172a; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; --radius: 14px; --shadow: 0 4px 24px rgba(0,0,0,0.08); }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); min-height: 100vh; display: flex; }
        .sidebar { width: 260px; background: var(--sidebar); min-height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 100; }
        .sidebar-brand { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 8px; }
        .brand-logo { display: flex; align-items: center; gap: 12px; }
        .brand-icon { width: 42px; height: 42px; background: linear-gradient(135deg, #6366f1, #ec4899); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; }
        .brand-text h2 { color: white; font-size: 16px; font-weight: 700; }
        .brand-text p { color: rgba(255,255,255,0.4); font-size: 11px; }
        .nav-section { padding: 8px 12px; margin-bottom: 4px; }
        .nav-label { font-size: 10px; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1.5px; padding: 0 8px; margin-bottom: 6px; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 12px; border-radius: 10px; color: rgba(255,255,255,0.6); text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s; margin-bottom: 2px; }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: white; }
        .nav-item.active { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
        .nav-item .icon { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar-footer { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .logout-btn { display: flex; align-items: center; gap: 12px; padding: 11px 12px; border-radius: 10px; color: rgba(255,255,255,0.6); font-size: 14px; width: 100%; background: none; border: none; cursor: pointer; }
        .logout-btn:hover { background: rgba(239,68,68,0.15); color: #ef4444; }
        .main { margin-left: 260px; flex: 1; padding: 32px; }
        .topbar { display: flex; align-items: center; gap: 16px; margin-bottom: 28px; }
        .topbar h1 { font-size: 24px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 10px; }
        .topbar a { display: flex; align-items: center; gap: 6px; color: var(--text-light); text-decoration: none; font-size: 14px; }
        .card { background: white; border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow); max-width: 560px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 13px; color: var(--text); margin-bottom: 8px; font-weight: 600; }
        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-light); width: 18px; height: 18px; }
        input { width: 100%; padding: 13px 14px 13px 44px; border: 2px solid var(--border); border-radius: 10px; font-size: 15px; outline: none; transition: border 0.2s; color: var(--text); }
        input:focus { border-color: var(--primary); }
        .error { color: #dc2626; font-size: 12px; margin-top: 6px; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; }
        .btn:hover { opacity: 0.9; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <div class="brand-icon"><i data-lucide="heart" style="width:20px;height:20px;"></i></div>
                <div class="brand-text"><h2>Diligent Mom</h2><p>Admin Panel</p></div>
            </div>
        </div>
        <div class="nav-section">
            <div class="nav-label">Main Menu</div>
            <a href="/admin/dashboard" class="nav-item"><i data-lucide="layout-dashboard" class="icon"></i> Dashboard</a>
            <a href="/admin/parents" class="nav-item active"><i data-lucide="users" class="icon"></i> Parents</a>
            <a href="/admin/children" class="nav-item"><i data-lucide="baby" class="icon"></i> Children</a>
            <a href="/admin/payments" class="nav-item"><i data-lucide="credit-card" class="icon"></i> Payments</a>
        </div>
        <div class="nav-section">
            <div class="nav-label">Reports & Settings</div>
            <a href="/admin/report" class="nav-item"><i data-lucide="bar-chart-2" class="icon"></i> Daily Report</a>
            <a href="/admin/activity" class="nav-item"><i data-lucide="activity" class="icon"></i> Activity Logs</a>
            <a href="/admin/settings" class="nav-item"><i data-lucide="settings" class="icon"></i> Settings</a>
            <a href="/" class="nav-item"><i data-lucide="home" class="icon"></i> Home</a>
        </div>
        <div class="sidebar-footer">
            <form action="/admin/logout" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i data-lucide="log-out" style="width:18px;height:18px;"></i> Logout</button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <a href="/admin/parents"><i data-lucide="arrow-left" style="width:16px;height:16px;"></i> Back</a>
            <h1><i data-lucide="pencil" style="width:22px;height:22px;color:#6366f1;"></i> Edit Parent</h1>
        </div>
        <div class="card">
            <form action="/admin/parents/{{ $parent->id }}/edit" method="POST">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <div class="input-wrap">
                        <i data-lucide="user" class="input-icon"></i>
                        <input type="text" name="name" value="{{ old('name', $parent->name) }}"/>
                    </div>
                    @error('name') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrap">
                        <i data-lucide="mail" class="input-icon"></i>
                        <input type="email" name="email" value="{{ old('email', $parent->email) }}"/>
                    </div>
                    @error('email') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <div class="input-wrap">
                        <i data-lucide="phone" class="input-icon"></i>
                        <input type="text" name="phone" value="{{ old('phone', $parent->phone) }}"/>
                    </div>
                    @error('phone') <div class="error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label>ID Number</label>
                    <div class="input-wrap">
                        <i data-lucide="credit-card" class="input-icon"></i>
                        <input type="text" name="id_number" value="{{ old('id_number', $parent->id_number) }}"/>
                    </div>
                    @error('id_number') <div class="error">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn">
                    <i data-lucide="save" style="width:18px;height:18px;"></i>
                    Save Changes
                </button>
            </form>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>