<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report - Diligent Mom</title>
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
        .topbar { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 28px; flex-wrap: wrap; gap: 16px; }
        .topbar-left h1 { font-size: 24px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 10px; }
        .topbar-left p { color: var(--text-light); font-size: 14px; margin-top: 4px; font-weight: 600; }
        .topbar-right { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
        .date-form { display: flex; align-items: center; gap: 8px; }
        .date-input { padding: 9px 14px; border: 2px solid var(--border); border-radius: 10px; font-size: 14px; outline: none; color: var(--text); }
        .date-input:focus { border-color: var(--primary); }
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s; }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
        .btn-primary:hover { opacity: 0.9; }
        .btn-secondary { background: white; color: var(--text); border: 1px solid var(--border); }
        .btn-secondary:hover { border-color: var(--primary); }
        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px; }
        .stat-card { background: white; border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow); display: flex; align-items: center; gap: 14px; border: 1px solid var(--border); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon.blue { background: #eff6ff; color: #2563eb; }
        .stat-icon.green { background: #ecfdf5; color: #059669; }
        .stat-icon.purple { background: #faf5ff; color: #7c3aed; }
        .stat-icon.orange { background: #fffbeb; color: #d97706; }
        .stat-value { font-size: 24px; font-weight: 800; color: var(--text); }
        .stat-label { font-size: 12px; color: var(--text-light); margin-top: 2px; }
        .card { background: white; border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow); margin-bottom: 24px; border: 1px solid var(--border); }
        .card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 2px solid var(--bg); }
        .card-header h3 { font-size: 16px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 8px; }
        .card-header span { font-size: 13px; color: var(--text-light); background: var(--bg); padding: 4px 12px; border-radius: 50px; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; color: var(--text-light); text-align: left; padding: 10px 14px; text-transform: uppercase; letter-spacing: 0.5px; background: var(--bg); }
        td { font-size: 14px; color: var(--text); padding: 14px; border-bottom: 1px solid var(--bg); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 50px; font-size: 11px; font-weight: 600; }
        .badge-checked_in { background: #eff6ff; color: #2563eb; }
        .badge-checked_out { background: #f5f3ff; color: #7c3aed; }
        .badge-completed { background: #ecfdf5; color: #059669; }
        .badge-pending { background: #fffbeb; color: #d97706; }
        .child-photo { width: 36px; height: 36px; border-radius: 8px; object-fit: cover; }
        .empty-row td { text-align: center; padding: 40px; color: var(--text-light); }
        @media print {
            .sidebar { display: none; }
            .main { margin-left: 0; }
            .topbar-right { display: none; }
        }
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
            <a href="/admin/children" class="nav-item"><i data-lucide="baby" class="icon"></i> Children</a>
            <a href="/admin/payments" class="nav-item"><i data-lucide="credit-card" class="icon"></i> Payments</a>
        </div>
        <div class="nav-section">
            <div class="nav-label">Reports & Settings</div>
            <a href="/admin/report" class="nav-item active"><i data-lucide="bar-chart-2" class="icon"></i> Daily Report</a>
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
            <div class="topbar-left">
                <h1><i data-lucide="bar-chart-2" style="width:24px;height:24px;color:#6366f1;"></i> Daily Report</h1>
                <p>{{ \Carbon\Carbon::parse($date)->format('l, F d Y') }}</p>
            </div>
            <div class="topbar-right">
                <form action="/admin/report" method="GET" class="date-form">
                    <input type="date" name="date" value="{{ $date }}" class="date-input"/>
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="search" style="width:14px;height:14px;"></i>
                        View Report
                    </button>
                </form>
                <button class="btn btn-secondary" onclick="window.print()">
                    <i data-lucide="printer" style="width:14px;height:14px;"></i>
                    Print
                </button>
            </div>
        </div>

        <!-- STATS -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-icon blue"><i data-lucide="clipboard-list" style="width:22px;height:22px;"></i></div>
                <div>
                    <div class="stat-value">{{ $checkedInToday->count() }}</div>
                    <div class="stat-label">Checked In Today</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i data-lucide="user-check" style="width:22px;height:22px;"></i></div>
                <div>
                    <div class="stat-value">{{ $currentlyIn->count() }}</div>
                    <div class="stat-label">Currently Inside</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon purple"><i data-lucide="door-open" style="width:22px;height:22px;"></i></div>
                <div>
                    <div class="stat-value">{{ $checkedOutToday->count() }}</div>
                    <div class="stat-label">Checked Out</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange"><i data-lucide="banknote" style="width:22px;height:22px;"></i></div>
                <div>
                    <div class="stat-value">KSH {{ number_format($totalRevenue) }}</div>
                    <div class="stat-label">Revenue Today</div>
                </div>
            </div>
        </div>

        <!-- CHILDREN TABLE -->
        <div class="card">
            <div class="card-header">
                <h3><i data-lucide="baby" style="width:16px;height:16px;color:#8b5cf6;"></i> Children Checked In Today</h3>
                <span>{{ $checkedInToday->count() }} children</span>
            </div>
            @if($checkedInToday->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Child</th>
                        <th>Parent</th>
                        <th>Age</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Status</th>
                        <th>Disability</th>
                        <th>Allergy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($checkedInToday as $child)
                    <tr>
                        <td><img src="{{ asset('storage/' . $child->photo) }}" class="child-photo" alt="{{ $child->name }}"/></td>
                        <td style="font-weight:600;">{{ $child->name }}</td>
                        <td>{{ $child->parent->name ?? 'N/A' }}</td>
                        <td>{{ $child->age }} yrs</td>
                        <td>{{ $child->checkin_time ?? '--' }}</td>
                        <td>{{ $child->checkout_time ?? '--' }}</td>
                        <td><span class="badge badge-{{ $child->status }}">{{ ucfirst(str_replace('_', ' ', $child->status)) }}</span></td>
                        <td>{{ $child->has_disability ? $child->disability_details : 'None' }}</td>
                        <td>{{ $child->has_allergy ? $child->allergy_details : 'None' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <table><tbody><tr class="empty-row"><td colspan="9">
                <i data-lucide="inbox" style="width:32px;height:32px;margin-bottom:8px;display:block;margin-left:auto;margin-right:auto;color:#94a3b8;"></i>
                No children checked in on this date.
            </td></tr></tbody></table>
            @endif
        </div>

        <!-- PAYMENTS TABLE -->
        <div class="card">
            <div class="card-header">
                <h3><i data-lucide="credit-card" style="width:16px;height:16px;color:#10b981;"></i> Payments Received Today</h3>
                <span>KSH {{ number_format($totalRevenue) }} total</span>
            </div>
            @if($paymentsToday->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Parent</th>
                        <th>Child</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Transaction ID</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentsToday as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->parent->name ?? 'N/A' }}</td>
                        <td>{{ $payment->child->name ?? 'N/A' }}</td>
                        <td>{{ $payment->phone_number }}</td>
                        <td><strong>KSH {{ number_format($payment->amount) }}</strong></td>
                        <td style="font-size:12px;">{{ $payment->mpesa_transaction_id ?? '--' }}</td>
                        <td>{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('H:i') : '--' }}</td>
                        <td><span class="badge badge-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <table><tbody><tr class="empty-row"><td colspan="8">
                <i data-lucide="inbox" style="width:32px;height:32px;margin-bottom:8px;display:block;margin-left:auto;margin-right:auto;color:#94a3b8;"></i>
                No payments received on this date.
            </td></tr></tbody></table>
            @endif
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>