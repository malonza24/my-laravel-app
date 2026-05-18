<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Diligent Mom</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; min-height: 100vh; display: flex; }
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #2d3748, #1a202c);
            min-height: 100vh;
            padding: 24px 0;
            position: fixed;
            top: 0; left: 0;
        }
        .sidebar .brand { padding: 0 24px 24px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 16px; }
        .sidebar .brand h2 { color: white; font-size: 18px; }
        .sidebar .brand p { color: rgba(255,255,255,0.5); font-size: 12px; margin-top: 4px; }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: white; }
        .sidebar .logout { position: absolute; bottom: 20px; width: 100%; }
        .sidebar .logout form button {
            width: 100%;
            padding: 12px 24px;
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            text-align: left;
            cursor: pointer;
            font-size: 14px;
        }
        .sidebar .logout form button:hover { color: white; background: rgba(255,255,255,0.1); }
        .main { margin-left: 250px; flex: 1; padding: 32px; }
        .topbar { margin-bottom: 32px; }
        .topbar h1 { font-size: 26px; color: #333; }
        .topbar p { color: #888; font-size: 14px; margin-top: 4px; }
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        .stat-card .icon { font-size: 32px; margin-bottom: 12px; }
        .stat-card .value { font-size: 28px; font-weight: 700; color: #333; }
        .stat-card .label { font-size: 13px; color: #888; margin-top: 4px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        .card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
        .card h3 { font-size: 16px; color: #333; margin-bottom: 16px; font-weight: 700; }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 12px; color: #888; text-align: left; padding: 8px 0; border-bottom: 1px solid #f0f0f0; text-transform: uppercase; }
        td { font-size: 14px; color: #333; padding: 10px 0; border-bottom: 1px solid #f8f8f8; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 11px; font-weight: 600; }
        .badge-active { background: #c6f6d5; color: #276749; }
        .badge-blocked { background: #fed7d7; color: #c53030; }
        .badge-completed { background: #c6f6d5; color: #276749; }
        .badge-pending { background: #fefcbf; color: #744210; }
        .view-all { display: inline-block; margin-top: 12px; font-size: 13px; color: #667eea; text-decoration: none; }
        .today-info { font-size: 12px; color: #888; margin-top: 4px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">
            <h2>⚙️ Diligent Mom</h2>
            <p>Admin Panel</p>
        </div>
        <a href="/admin/dashboard" class="active">📊 Dashboard</a>
        <a href="/admin/parents">👩 Parents</a>
        <a href="/admin/children">👶 Children</a>
        <a href="/admin/payments">💳 Payments</a>
        <a href="/admin/settings">⚙️ Settings</a>
        <a href="/admin/activity">📋 Activity Logs</a>
        <a href="/">🏠 Home</a>
        <div class="logout">
            <form action="/admin/logout" method="POST">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <h1>Welcome back, {{ Auth::user()->name }}! 👋</h1>
            <p>Here's what's happening at the daycare today — {{ now()->format('l, M d Y') }}</p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="icon">👩</div>
                <div class="value">{{ $totalParents }}</div>
                <div class="label">Total Parents</div>
            </div>
            <div class="stat-card">
                <div class="icon">👶</div>
                <div class="value">{{ $totalChildren }}</div>
                <div class="label">Total Children</div>
            </div>
            <div class="stat-card">
                <div class="icon">📋</div>
                <div class="value">{{ $checkedIn }}</div>
                <div class="label">Checked In Today</div>
                <div class="today-info">All children who came in today</div>
            </div>
            <div class="stat-card">
                <div class="icon">✅</div>
                <div class="value">{{ $currentlyIn }}</div>
                <div class="label">Currently Inside</div>
                <div class="today-info">Still in the daycare now</div>
            </div>
            <div class="stat-card">
                <div class="icon">🚪</div>
                <div class="value">{{ $checkedOut }}</div>
                <div class="label">Checked Out Today</div>
                <div class="today-info">Already picked up today</div>
            </div>
            <div class="stat-card">
                <div class="icon">💰</div>
                <div class="value">KSH {{ number_format($totalPayments) }}</div>
                <div class="label">Total Payments</div>
            </div>
        </div>

        <div class="grid-2">
            <div class="card">
                <h3>Recent Parents</h3>
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
                <a href="/admin/parents" class="view-all">View all parents →</a>
            </div>

            <div class="card">
                <h3>Recent Payments</h3>
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
                <a href="/admin/payments" class="view-all">View all payments →</a>
            </div>
        </div>
    </div>
</body>
</html>