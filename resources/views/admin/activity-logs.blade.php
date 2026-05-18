<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Logs - Diligent Mom Admin</title>
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
        .topbar { margin-bottom: 24px; }
        .topbar h1 { font-size: 24px; color: #333; }
        .card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 12px; color: #888; text-align: left; padding: 10px 12px; border-bottom: 2px solid #f0f0f0; text-transform: uppercase; background: #f8f9fa; }
        td { font-size: 14px; color: #333; padding: 12px; border-bottom: 1px solid #f0f0f0; }
        tr:hover td { background: #f8f9fa; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 10px; font-size: 11px; font-weight: 600; background: #ebf4ff; color: #2b6cb0; }
        .pagination { margin-top: 20px; }
        .pagination a, .pagination span { display: inline-block; padding: 6px 12px; border-radius: 6px; font-size: 13px; margin-right: 4px; text-decoration: none; background: white; color: #333; border: 1px solid #e0e0e0; }
        .pagination .active { background: #2d3748; color: white; border-color: #2d3748; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">
            <h2>⚙️ Diligent Mom</h2>
            <p>Admin Panel</p>
        </div>
        <a href="/admin/dashboard">📊 Dashboard</a>
        <a href="/admin/parents">👩 Parents</a>
        <a href="/admin/children">👶 Children</a>
        <a href="/admin/payments">💳 Payments</a>
        <a href="/admin/settings">⚙️ Settings</a>
        <a href="/admin/activity" class="active">📋 Activity Logs</a>
        <div class="logout">
            <form action="/admin/logout" method="POST">
                @csrf
                <button type="submit">🚪 Logout</button>
            </form>
        </div>
    </div>

    <div class="main">
        <div class="topbar">
            <h1>📋 Activity Logs</h1>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th>Performed By</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge">{{ $log->action }}</span></td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->performed_by }}</td>
                        <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">{{ $logs->links() }}</div>
        </div>
    </div>
</body>
</html>