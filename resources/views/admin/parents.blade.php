<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #6366f1; --primary-dark: #4f46e5; --secondary: #f43f5e; --success: #10b981; --warning: #f59e0b; --bg: #f1f5f9; --sidebar: #0f172a; --white: #ffffff; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; --radius: 14px; --shadow: 0 4px 24px rgba(0,0,0,0.08); }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); min-height: 100vh; display: flex; }
        .sidebar { width: 260px; background: var(--sidebar); min-height: 100vh; padding: 0; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 100; }
        .sidebar-brand { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 8px; }
        .brand-logo { display: flex; align-items: center; gap: 12px; }
        .brand-icon { width: 42px; height: 42px; background: linear-gradient(135deg, #6366f1, #ec4899); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; }
        .brand-text h2 { color: white; font-size: 16px; font-weight: 700; }
        .brand-text p { color: rgba(255,255,255,0.4); font-size: 11px; margin-top: 2px; }
        .nav-section { padding: 8px 12px; margin-bottom: 4px; }
        .nav-label { font-size: 10px; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1.5px; padding: 0 8px; margin-bottom: 6px; }
        .nav-item { display: flex; align-items: center; gap: 12px; padding: 11px 12px; border-radius: 10px; color: rgba(255,255,255,0.6); text-decoration: none; font-size: 14px; font-weight: 500; transition: all 0.2s; margin-bottom: 2px; }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: white; }
        .nav-item.active { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
        .nav-item .icon { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar-footer { margin-top: auto; padding: 16px 12px; border-top: 1px solid rgba(255,255,255,0.08); }
        .logout-btn { display: flex; align-items: center; gap: 12px; padding: 11px 12px; border-radius: 10px; color: rgba(255,255,255,0.6); font-size: 14px; font-weight: 500; width: 100%; background: none; border: none; cursor: pointer; transition: all 0.2s; }
        .logout-btn:hover { background: rgba(239,68,68,0.15); color: #ef4444; }
        .main { margin-left: 260px; flex: 1; padding: 32px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .topbar h1 { font-size: 24px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 10px; }
        .topbar a { display: flex; align-items: center; gap: 6px; color: var(--text-light); text-decoration: none; font-size: 14px; }
        .card { background: white; border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow); }
        .alert-success { background: #ecfdf5; color: #059669; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px; border-left: 4px solid #10b981; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; color: var(--text-light); text-align: left; padding: 10px 14px; text-transform: uppercase; letter-spacing: 0.5px; background: var(--bg); }
        td { font-size: 14px; color: var(--text); padding: 14px; border-bottom: 1px solid var(--bg); }
        tr:hover td { background: #fafafa; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 50px; font-size: 11px; font-weight: 600; }
        .badge-active { background: #ecfdf5; color: #059669; }
        .badge-blocked { background: #fef2f2; color: #dc2626; }
        .actions { display: flex; align-items: center; gap: 6px; }
        .btn-sm { display: inline-flex; align-items: center; gap: 4px; padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: opacity 0.2s; }
        .btn-view { background: #eef2ff; color: var(--primary); }
        .btn-edit { background: #fffbeb; color: #d97706; }
        .btn-block { background: #fef2f2; color: #dc2626; }
        .btn-unblock { background: #ecfdf5; color: #059669; }
        .btn-delete { background: #fff1f2; color: #e11d48; }
        .btn-sm:hover { opacity: 0.8; }
        .parent-info { display: flex; align-items: center; gap: 10px; }
        .parent-avatar { width: 36px; height: 36px; border-radius: 10px; background: linear-gradient(135deg, #6366f1, #ec4899); display: flex; align-items: center; justify-content: center; color: white; font-size: 13px; font-weight: 700; flex-shrink: 0; }
        .parent-name { font-weight: 600; color: var(--text); }
        .parent-email { font-size: 12px; color: var(--text-light); }
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
            <h1><i data-lucide="users" style="width:24px;height:24px;color:#6366f1;"></i> Parents ({{ $parents->count() }})</h1>
            <a href="/admin/dashboard"><i data-lucide="arrow-left" style="width:16px;height:16px;"></i> Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert-success"><i data-lucide="check-circle" style="width:16px;height:16px;"></i> {{ session('success') }}</div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Parent</th>
                        <th>Phone</th>
                        <th>ID Number</th>
                        <th>Children</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parents as $parent)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="parent-info">
                                <div class="parent-avatar">{{ strtoupper(substr($parent->name, 0, 1)) }}</div>
                                <div>
                                    <div class="parent-name">{{ $parent->name }}</div>
                                    <div class="parent-email">{{ $parent->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $parent->phone }}</td>
                        <td>{{ $parent->id_number }}</td>
                        <td>{{ $parent->children_count }}</td>
                        <td><span class="badge badge-{{ $parent->status }}">{{ ucfirst($parent->status) }}</span></td>
                        <td>{{ $parent->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="actions">
                                <a href="/admin/parents/{{ $parent->id }}" class="btn-sm btn-view"><i data-lucide="eye" style="width:12px;height:12px;"></i> View</a>
                                <a href="/admin/parents/{{ $parent->id }}/edit" class="btn-sm btn-edit"><i data-lucide="pencil" style="width:12px;height:12px;"></i> Edit</a>
                                <form action="/admin/parents/{{ $parent->id }}/toggle-block" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn-sm {{ $parent->status === 'active' ? 'btn-block' : 'btn-unblock' }}">
                                        <i data-lucide="{{ $parent->status === 'active' ? 'ban' : 'check-circle' }}" style="width:12px;height:12px;"></i>
                                        {{ $parent->status === 'active' ? 'Block' : 'Unblock' }}
                                    </button>
                                </form>
                                <form action="/admin/parents/{{ $parent->id }}/delete" method="POST" style="display:inline" onsubmit="return confirm('Delete this parent?')">
                                    @csrf
                                    <button class="btn-sm btn-delete"><i data-lucide="trash-2" style="width:12px;height:12px;"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>