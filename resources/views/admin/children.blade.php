<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Children - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #6366f1; --primary-dark: #4f46e5; --success: #10b981; --warning: #f59e0b; --info: #3b82f6; --purple: #8b5cf6; --bg: #f1f5f9; --sidebar: #0f172a; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; --radius: 14px; --shadow: 0 4px 24px rgba(0,0,0,0.08); }
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
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px; }
        .topbar h1 { font-size: 24px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 10px; }
        .topbar a { display: flex; align-items: center; gap: 6px; color: var(--text-light); text-decoration: none; font-size: 14px; }
        .alert-success { background: #ecfdf5; color: #059669; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px; border-left: 4px solid #10b981; }
        .alert-error { background: #fef2f2; color: #dc2626; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px; border-left: 4px solid #ef4444; }
        .card { background: white; border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow); }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; color: var(--text-light); text-align: left; padding: 10px 14px; text-transform: uppercase; letter-spacing: 0.5px; background: var(--bg); }
        td { font-size: 14px; color: var(--text); padding: 14px; border-bottom: 1px solid var(--bg); vertical-align: middle; }
        tr:hover td { background: #fafafa; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 50px; font-size: 11px; font-weight: 600; }
        .badge-checked_in { background: #eff6ff; color: #2563eb; }
        .badge-checked_out { background: #f5f3ff; color: #7c3aed; }
        .badge-pending { background: #fffbeb; color: #d97706; }
        .child-photo { width: 40px; height: 40px; border-radius: 10px; object-fit: cover; }
        .child-name { font-weight: 600; }
        .actions { display: flex; gap: 6px; }
        .btn-sm { display: inline-flex; align-items: center; gap: 4px; padding: 7px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; transition: opacity 0.2s; }
        .btn-checkin { background: #eff6ff; color: #2563eb; }
        .btn-checkout { background: #f5f3ff; color: #7c3aed; }
        .btn-sm:hover { opacity: 0.8; }
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
            <a href="/admin/parents" class="nav-item"><i data-lucide="users" class="icon"></i> Parents</a>
            <a href="/admin/children" class="nav-item active"><i data-lucide="baby" class="icon"></i> Children</a>
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
            <h1><i data-lucide="baby" style="width:24px;height:24px;color:#8b5cf6;"></i> Children ({{ $children->count() }})</h1>
            <a href="/admin/dashboard"><i data-lucide="arrow-left" style="width:16px;height:16px;"></i> Dashboard</a>
        </div>

        @if(session('success'))
            <div class="alert-success"><i data-lucide="check-circle" style="width:16px;height:16px;"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert-error"><i data-lucide="alert-circle" style="width:16px;height:16px;"></i> {{ session('error') }}</div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Child</th>
                        <th>Parent</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($children as $child)
                    <tr>
                        <td><img src="{{ asset('storage/' . $child->photo) }}" class="child-photo" alt="{{ $child->name }}"/></td>
                        <td>
                            <div class="child-name">{{ $child->name }}</div>
                            @if($child->has_disability)<div style="font-size:11px;color:#7c3aed;margin-top:2px;">Has disability</div>@endif
                            @if($child->has_allergy)<div style="font-size:11px;color:#d97706;margin-top:2px;">Has allergy</div>@endif
                        </td>
                        <td>{{ $child->parent->name ?? 'N/A' }}</td>
                        <td>{{ $child->age }} yrs</td>
                        <td>{{ ucfirst($child->gender) }}</td>
                        <td>{{ $child->checkin_time ?? '--' }}</td>
                        <td>{{ $child->checkout_time ?? '--' }}</td>
                        <td><span class="badge badge-{{ $child->status }}">{{ ucfirst(str_replace('_', ' ', $child->status)) }}</span></td>
                        <td>
                            <div class="actions">
                                @if($child->status !== 'checked_in')
                                <form action="/admin/children/{{ $child->id }}/checkin" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn-sm btn-checkin"><i data-lucide="log-in" style="width:12px;height:12px;"></i> Check In</button>
                                </form>
                                @endif
                                @if($child->status === 'checked_in')
                                <form action="/admin/children/{{ $child->id }}/checkout" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn-sm btn-checkout"><i data-lucide="log-out" style="width:12px;height:12px;"></i> Check Out</button>
                                </form>
                                @endif
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