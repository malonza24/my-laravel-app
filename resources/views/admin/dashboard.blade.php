<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #f43f5e;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #3b82f6;
            --purple: #8b5cf6;
            --pink: #ec4899;
            --bg: #f1f5f9;
            --sidebar: #0f172a;
            --white: #ffffff;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --radius: 14px;
            --shadow: 0 4px 24px rgba(0,0,0,0.08);
        }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); min-height: 100vh; display: flex; }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: var(--sidebar);
            min-height: 100vh;
            padding: 0;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }
        .sidebar-brand {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            margin-bottom: 8px;
        }
        .sidebar-brand .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary), var(--pink));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .brand-text h2 { color: white; font-size: 16px; font-weight: 700; }
        .brand-text p { color: rgba(255,255,255,0.4); font-size: 11px; margin-top: 2px; }
        .nav-section { padding: 8px 12px; margin-bottom: 4px; }
        .nav-label { font-size: 10px; color: rgba(255,255,255,0.3); text-transform: uppercase; letter-spacing: 1.5px; padding: 0 8px; margin-bottom: 6px; }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 2px;
        }
        .nav-item:hover { background: rgba(255,255,255,0.08); color: white; }
        .nav-item.active { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
        .nav-item .icon { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar-footer {
            margin-top: auto;
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.6);
            font-size: 14px;
            font-weight: 500;
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .logout-btn:hover { background: rgba(239,68,68,0.15); color: #ef4444; }

        /* MAIN */
        .main { margin-left: 260px; flex: 1; padding: 32px; }

        /* TOPBAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        .topbar-left h1 { font-size: 24px; font-weight: 700; color: var(--text); }
        .topbar-left p { color: var(--text-light); font-size: 14px; margin-top: 4px; }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .admin-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            padding: 8px 16px;
            border-radius: 50px;
            box-shadow: var(--shadow);
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }
        .admin-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--pink));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 13px;
            font-weight: 700;
        }

        /* STATS */
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 28px; }
        .stat-card {
            background: white;
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 80px;
            height: 80px;
            border-radius: 0 var(--radius) 0 80px;
            opacity: 0.1;
        }
        .stat-card.blue::before { background: var(--info); }
        .stat-card.green::before { background: var(--success); }
        .stat-card.purple::before { background: var(--purple); }
        .stat-card.orange::before { background: var(--warning); }
        .stat-card.pink::before { background: var(--pink); }
        .stat-card.indigo::before { background: var(--primary); }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .stat-icon.blue { background: #eff6ff; color: var(--info); }
        .stat-icon.green { background: #ecfdf5; color: var(--success); }
        .stat-icon.purple { background: #f5f3ff; color: var(--purple); }
        .stat-icon.orange { background: #fffbeb; color: var(--warning); }
        .stat-icon.pink { background: #fdf2f8; color: var(--pink); }
        .stat-icon.indigo { background: #eef2ff; color: var(--primary); }
        .stat-value { font-size: 30px; font-weight: 800; color: var(--text); }
        .stat-label { font-size: 13px; color: var(--text-light); margin-top: 4px; font-weight: 500; }
        .stat-sub { font-size: 11px; color: var(--text-light); margin-top: 6px; }

        /* GRID */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .card {
            background: white;
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px solid var(--bg);
        }
        .card-header h3 { font-size: 16px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 8px; }
        .card-header a { font-size: 13px; color: var(--primary); text-decoration: none; font-weight: 600; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; color: var(--text-light); text-align: left; padding: 8px 12px; text-transform: uppercase; letter-spacing: 0.5px; background: var(--bg); border-radius: 6px; }
        td { font-size: 14px; color: var(--text); padding: 12px; border-bottom: 1px solid var(--bg); }
        tr:last-child td { border-bottom: none; }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-active { background: #ecfdf5; color: #059669; }
        .badge-blocked { background: #fef2f2; color: #dc2626; }
        .badge-completed { background: #ecfdf5; color: #059669; }
        .badge-pending { background: #fffbeb; color: #d97706; }
        .badge-failed { background: #fef2f2; color: #dc2626; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo">
                <div class="brand-icon">
                    <i data-lucide="heart" style="width:20px;height:20px;"></i>
                </div>
                <div class="brand-text">
                    <h2>Diligent Mom</h2>
                    <p>Admin Panel</p>
                </div>
            </div>
        </div>

        <div class="nav-section">
            <div class="nav-label">Main Menu</div>
            <a href="/admin/dashboard" class="nav-item active">
                <i data-lucide="layout-dashboard" class="icon"></i> Dashboard
            </a>
            <a href="/admin/parents" class="nav-item">
                <i data-lucide="users" class="icon"></i> Parents
            </a>
            <a href="/admin/children" class="nav-item">
                <i data-lucide="baby" class="icon"></i> Children
            </a>
            <a href="/admin/payments" class="nav-item">
                <i data-lucide="credit-card" class="icon"></i> Payments
            </a>
        </div>

        <div class="nav-section">
            <div class="nav-label">Reports & Settings</div>
            <a href="/admin/report" class="nav-item">
                <i data-lucide="bar-chart-2" class="icon"></i> Daily Report
            </a>
            <a href="/admin/activity" class="nav-item">
                <i data-lucide="activity" class="icon"></i> Activity Logs
            </a>
            <a href="/admin/settings" class="nav-item">
                <i data-lucide="settings" class="icon"></i> Settings
            </a>
            <a href="/" class="nav-item">
                <i data-lucide="home" class="icon"></i> Home
            </a>
        </div>

        <div class="sidebar-footer">
            <form action="/admin/logout" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i data-lucide="log-out" style="width:18px;height:18px;"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <div class="topbar-left">
                <h1>Good {{ now()->hour < 12 ? 'Morning' : (now()->hour < 17 ? 'Afternoon' : 'Evening') }}! 👋</h1>
                <p>{{ now()->format('l, F d Y') }} — Here\'s what\'s happening today</p>
            </div>
            <div class="topbar-right">
                <div class="admin-badge">
                    <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    {{ Auth::user()->name }}
                </div>
            </div>
        </div>

        <!-- STATS -->
        <div class="stats">
            <div class="stat-card blue">
                <div class="stat-icon blue">
                    <i data-lucide="users" style="width:22px;height:22px;"></i>
                </div>
                <div class="stat-value">{{ $totalParents }}</div>
                <div class="stat-label">Total Parents</div>
                <div class="stat-sub">Registered in system</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon green">
                    <i data-lucide="baby" style="width:22px;height:22px;"></i>
                </div>
                <div class="stat-value">{{ $totalChildren }}</div>
                <div class="stat-label">Total Children</div>
                <div class="stat-sub">All registered children</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-icon purple">
                    <i data-lucide="clipboard-list" style="width:22px;height:22px;"></i>
                </div>
                <div class="stat-value">{{ $checkedIn }}</div>
                <div class="stat-label">Checked In Today</div>
                <div class="stat-sub">Total arrivals today</div>
            </div>
            <div class="stat-card indigo">
                <div class="stat-icon indigo">
                    <i data-lucide="user-check" style="width:22px;height:22px;"></i>
                </div>
                <div class="stat-value">{{ $currentlyIn }}</div>
                <div class="stat-label">Currently Inside</div>
                <div class="stat-sub">Still in daycare now</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-icon orange">
                    <i data-lucide="door-open" style="width:22px;height:22px;"></i>
                </div>
                <div class="stat-value">{{ $checkedOut }}</div>
                <div class="stat-label">Checked Out Today</div>
                <div class="stat-sub">Already picked up</div>
            </div>
            <div class="stat-card pink">
                <div class="stat-icon pink">
                    <i data-lucide="banknote" style="width:22px;height:22px;"></i>
                </div>
                <div class="stat-value">KSH {{ number_format($totalPayments) }}</div>
                <div class="stat-label">Total Revenue</div>
                <div class="stat-sub">All confirmed payments</div>
            </div>
        </div>

        <!-- TABLES -->
        <div class="grid-2">
            <div class="card">
                <div class="card-header">
                    <h3>
                        <i data-lucide="users" style="width:16px;height:16px;color:#6366f1;"></i>
                        Recent Parents
                    </h3>
                    <a href="/admin/parents">View all →</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentParents as $parent)
                        <tr>
                            <td>{{ $parent->name }}</td>
                            <td>{{ $parent->phone }}</td>
                            <td><span class="badge badge-{{ $parent->status }}">{{ ucfirst($parent->status) }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>
                        <i data-lucide="credit-card" style="width:16px;height:16px;color:#10b981;"></i>
                        Recent Payments
                    </h3>
                    <a href="/admin/payments">View all →</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Parent</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentPayments as $payment)
                        <tr>
                            <td>{{ $payment->parent->name ?? 'N/A' }}</td>
                            <td>KSH {{ number_format($payment->amount) }}</td>
                            <td><span class="badge badge-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>