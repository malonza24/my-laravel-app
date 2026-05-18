<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parents - Diligent Mom Admin</title>
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
        .sidebar a { display: flex; align-items: center; gap: 10px; padding: 12px 24px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 14px; transition: all 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,0.1); color: white; }
        .sidebar .logout { position: absolute; bottom: 20px; width: 100%; }
        .sidebar .logout form button { width: 100%; padding: 12px 24px; background: none; border: none; color: rgba(255,255,255,0.7); text-align: left; cursor: pointer; font-size: 14px; }
        .sidebar .logout form button:hover { color: white; background: rgba(255,255,255,0.1); }
        .main { margin-left: 250px; flex: 1; padding: 32px; }
        .topbar { margin-bottom: 24px; }
        .topbar h1 { font-size: 24px; color: #333; }
        .card { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 12px; color: #888; text-align: left; padding: 10px 12px; border-bottom: 2px solid #f0f0f0; text-transform: uppercase; background: #f8f9fa; }
        td { font-size: 14px; color: #333; padding: 12px; border-bottom: 1px solid #f0f0f0; }
        tr:hover td { background: #f8f9fa; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 10px; font-size: 11px; font-weight: 600; }
        .badge-active { background: #c6f6d5; color: #276749; }
        .badge-blocked { background: #fed7d7; color: #c53030; }
        .btn { display: inline-block; padding: 5px 12px; border-radius: 6px; font-size: 12px; cursor: pointer; border: none; text-decoration: none; margin-right: 4px; }
        .btn-view { background: #ebf4ff; color: #2b6cb0; }
        .btn-edit { background: #fefcbf; color: #744210; }
        .btn-block { background: #fed7d7; color: #c53030; }
        .btn-unblock { background: #c6f6d5; color: #276749; }
        .btn-delete { background: #fff5f5; color: #e53e3e; }
        .success { background: #c6f6d5; color: #276749; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
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
            <h1>👩 Parents ({{ $parents->count() }})</h1>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>ID Number</th>
                        <th>Children</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parents as $parent)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $parent->name }}</td>
                        <td>{{ $parent->email }}</td>
                        <td>{{ $parent->phone }}</td>
                        <td>{{ $parent->id_number }}</td>
                        <td>{{ $parent->children_count }}</td>
                        <td><span class="badge badge-{{ $parent->status }}">{{ ucfirst($parent->status) }}</span></td>
                        <td>
                            <a href="/admin/parents/{{ $parent->id }}" class="btn btn-view">View</a>
                            <a href="/admin/parents/{{ $parent->id }}/edit" class="btn btn-edit">Edit</a>
                            <form action="/admin/parents/{{ $parent->id }}/toggle-block" method="POST" style="display:inline">
                                @csrf
                                <button class="btn {{ $parent->status === 'active' ? 'btn-block' : 'btn-unblock' }}">
                                    {{ $parent->status === 'active' ? 'Block' : 'Unblock' }}
                                </button>
                            </form>
                            <form action="/admin/parents/{{ $parent->id }}/delete" method="POST" style="display:inline" onsubmit="return confirm('Delete this parent?')">
                                @csrf
                                <button class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>