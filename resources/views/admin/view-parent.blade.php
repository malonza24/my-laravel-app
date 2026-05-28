<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Parent - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #6366f1; --primary-dark: #4f46e5; --success: #10b981; --warning: #f59e0b; --pink: #f43f5e; --bg: #f1f5f9; --sidebar: #0f172a; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; --radius: 14px; --shadow: 0 4px 24px rgba(0,0,0,0.08); }
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
        .topbar h1 { font-size: 22px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 10px; }
        .topbar a { display: flex; align-items: center; gap: 6px; color: var(--text-light); text-decoration: none; font-size: 14px; padding: 8px 14px; border-radius: 8px; border: 1px solid var(--border); background: white; transition: all 0.2s; }
        .topbar a:hover { border-color: var(--primary); color: var(--primary); }
        .alert-success { background: #ecfdf5; color: #059669; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px; border-left: 4px solid #10b981; }
        .profile-grid { display: grid; grid-template-columns: 300px 1fr; gap: 24px; }
        .profile-card { background: white; border-radius: var(--radius); padding: 28px; box-shadow: var(--shadow); border: 1px solid var(--border); }
        .profile-avatar { width: 80px; height: 80px; border-radius: 20px; background: linear-gradient(135deg, var(--primary), var(--pink)); display: flex; align-items: center; justify-content: center; color: white; font-size: 28px; font-weight: 800; margin: 0 auto 16px; }
        .profile-name { font-size: 20px; font-weight: 700; color: var(--text); text-align: center; margin-bottom: 4px; }
        .profile-role { font-size: 13px; color: var(--text-light); text-align: center; margin-bottom: 16px; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 12px; border-radius: 50px; font-size: 11px; font-weight: 600; }
        .badge-active { background: #ecfdf5; color: #059669; }
        .badge-blocked { background: #fef2f2; color: #dc2626; }
        .badge-wrap { text-align: center; margin-bottom: 20px; }
        .info-list { border-top: 1px solid var(--bg); padding-top: 16px; }
        .info-row { display: flex; align-items: center; gap: 10px; padding: 10px 0; border-bottom: 1px solid var(--bg); font-size: 13px; }
        .info-row:last-child { border-bottom: none; }
        .info-icon { width: 30px; height: 30px; border-radius: 8px; background: var(--bg); display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: var(--text-light); }
        .info-label { color: var(--text-light); min-width: 80px; }
        .info-value { color: var(--text); font-weight: 600; flex: 1; }
        .action-btns { display: flex; flex-direction: column; gap: 8px; margin-top: 20px; }
        .btn-sm { display: flex; align-items: center; justify-content: center; gap: 8px; padding: 10px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; text-decoration: none; transition: opacity 0.2s; }
        .btn-edit { background: #fffbeb; color: #d97706; }
        .btn-block { background: #fef2f2; color: #dc2626; }
        .btn-unblock { background: #ecfdf5; color: #059669; }
        .btn-delete { background: #fff1f2; color: #e11d48; }
        .btn-sm:hover { opacity: 0.8; }
        .detail-col { display: flex; flex-direction: column; gap: 20px; }
        .detail-card { background: white; border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow); border: 1px solid var(--border); }
        .detail-card h3 { font-size: 15px; font-weight: 700; color: var(--text); margin-bottom: 16px; padding-bottom: 12px; border-bottom: 2px solid var(--bg); display: flex; align-items: center; gap: 8px; }
        .children-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 12px; }
        .child-mini { background: var(--bg); border-radius: 12px; overflow: hidden; border: 1px solid var(--border); }
        .child-mini img { width: 100%; height: 100px; object-fit: cover; }
        .child-mini-body { padding: 10px; }
        .child-mini-name { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 4px; }
        .child-mini-detail { font-size: 11px; color: var(--text-light); margin-bottom: 2px; }
        .child-status { display: inline-flex; align-items: center; gap: 3px; padding: 3px 8px; border-radius: 50px; font-size: 10px; font-weight: 600; margin-top: 6px; }
        .status-checked_in { background: #eff6ff; color: #2563eb; }
        .status-checked_out { background: #f5f3ff; color: #7c3aed; }
        .status-pending { background: #fffbeb; color: #d97706; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; color: var(--text-light); text-align: left; padding: 8px 12px; text-transform: uppercase; background: var(--bg); }
        td { font-size: 13px; color: var(--text); padding: 12px; border-bottom: 1px solid var(--bg); }
        .pay-badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 8px; border-radius: 50px; font-size: 11px; font-weight: 600; }
        .pay-completed { background: #ecfdf5; color: #059669; }
        .pay-pending { background: #fffbeb; color: #d97706; }
        .pay-failed { background: #fef2f2; color: #dc2626; }
        .empty { text-align: center; padding: 24px; color: var(--text-light); font-size: 14px; }
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
            <a href="/admin/parents"><i data-lucide="arrow-left" style="width:14px;height:14px;"></i> Back to Parents</a>
            <h1><i data-lucide="user" style="width:22px;height:22px;color:#6366f1;"></i> Parent Profile</h1>
        </div>

        @if(session('success'))
            <div class="alert-success"><i data-lucide="check-circle" style="width:16px;height:16px;"></i> {{ session('success') }}</div>
        @endif

        <div class="profile-grid">
            <div class="profile-card">
                <div class="profile-avatar">{{ strtoupper(substr($parent->name, 0, 1)) }}</div>
                <div class="profile-name">{{ $parent->name }}</div>
                <div class="profile-role">Registered Parent</div>
                <div class="badge-wrap">
                    <span class="badge badge-{{ $parent->status }}">{{ ucfirst($parent->status) }}</span>
                </div>
                <div class="info-list">
                    <div class="info-row">
                        <div class="info-icon"><i data-lucide="mail" style="width:14px;height:14px;"></i></div>
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $parent->email }}</span>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i data-lucide="phone" style="width:14px;height:14px;"></i></div>
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $parent->phone }}</span>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i data-lucide="credit-card" style="width:14px;height:14px;"></i></div>
                        <span class="info-label">ID No.</span>
                        <span class="info-value">{{ $parent->id_number }}</span>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i data-lucide="baby" style="width:14px;height:14px;"></i></div>
                        <span class="info-label">Children</span>
                        <span class="info-value">{{ $parent->children->count() }}</span>
                    </div>
                    <div class="info-row">
                        <div class="info-icon"><i data-lucide="calendar" style="width:14px;height:14px;"></i></div>
                        <span class="info-label">Joined</span>
                        <span class="info-value">{{ $parent->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
                <div class="action-btns">
                    <a href="/admin/parents/{{ $parent->id }}/edit" class="btn-sm btn-edit">
                        <i data-lucide="pencil" style="width:14px;height:14px;"></i> Edit Details
                    </a>
                    <form action="/admin/parents/{{ $parent->id }}/toggle-block" method="POST">
                        @csrf
                        <button class="btn-sm {{ $parent->status === 'active' ? 'btn-block' : 'btn-unblock' }}" style="width:100%;">
                            <i data-lucide="{{ $parent->status === 'active' ? 'ban' : 'check-circle' }}" style="width:14px;height:14px;"></i>
                            {{ $parent->status === 'active' ? 'Block Parent' : 'Unblock Parent' }}
                        </button>
                    </form>
                    <form action="/admin/parents/{{ $parent->id }}/delete" method="POST" onsubmit="return confirm('Delete this parent and all their data?')">
                        @csrf
                        <button class="btn-sm btn-delete" style="width:100%;">
                            <i data-lucide="trash-2" style="width:14px;height:14px;"></i> Delete Parent
                        </button>
                    </form>
                </div>
            </div>

            <div class="detail-col">
                <div class="detail-card">
                    <h3><i data-lucide="baby" style="width:16px;height:16px;color:#8b5cf6;"></i> Registered Children ({{ $parent->children->count() }})</h3>
                    @if($parent->children->count() > 0)
                        <div class="children-grid">
                            @foreach($parent->children as $child)
                            <div class="child-mini">
                                <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}"/>
                                <div class="child-mini-body">
                                    <div class="child-mini-name">{{ $child->name }}</div>
                                    <div class="child-mini-detail">Age: {{ $child->age }} | {{ ucfirst($child->gender) }}</div>
                                    <div class="child-mini-detail">In: {{ $child->checkin_time ?? '--' }}</div>
                                    @if($child->has_disability)<div class="child-mini-detail" style="color:#7c3aed;">Has disability</div>@endif
                                    @if($child->has_allergy)<div class="child-mini-detail" style="color:#d97706;">Has allergy</div>@endif
                                    <span class="child-status status-{{ $child->status }}">{{ ucfirst(str_replace('_', ' ', $child->status)) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty">No children registered yet.</div>
                    @endif
                </div>

                <div class="detail-card">
                    <h3><i data-lucide="credit-card" style="width:16px;height:16px;color:#10b981;"></i> Payment History ({{ $parent->payments->count() }})</h3>
                    @if($parent->payments->count() > 0)
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Child</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parent->payments as $payment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $payment->child->name ?? 'N/A' }}</td>
                                    <td><strong>KSH {{ number_format($payment->amount) }}</strong></td>
                                    <td>{{ strtoupper($payment->payment_method) }}</td>
                                    <td><span class="pay-badge pay-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
                                    <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty">No payments made yet.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>