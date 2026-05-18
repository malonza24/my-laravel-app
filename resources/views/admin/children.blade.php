<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Children - Diligent Mom Admin</title>
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
        .badge { display: inline-block; padding: 3px 10px; border-radius: 10px; font-size: 11px; font-weight: 600; }
        .badge-checked_in { background: #bee3f8; color: #2a69ac; }
        .badge-checked_out { background: #e9d8fd; color: #553c9a; }
        .badge-pending { background: #fefcbf; color: #744210; }
        .btn { display: inline-block; padding: 5px 12px; border-radius: 6px; font-size: 12px; cursor: pointer; border: none; margin-right: 4px; }
        .btn-checkin { background: #bee3f8; color: #2a69ac; }
        .btn-checkout { background: #e9d8fd; color: #553c9a; }
        .child-photo { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
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
        <a href="/admin/parents">👩 Parents</a>
        <a href="/admin/children" class="active">👶 Children</a>
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
            <h1>👶 Children ({{ $children->count() }})</h1>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
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
                        <td>{{ $child->name }}</td>
                        <td>{{ $child->parent->name ?? 'N/A' }}</td>
                        <td>{{ $child->age }}</td>
                        <td>{{ ucfirst($child->gender) }}</td>
                        <td>{{ $child->checkin_time ?? '--' }}</td>
                        <td>{{ $child->checkout_time ?? '--' }}</td>
                        <td><span class="badge badge-{{ $child->status }}">{{ ucfirst(str_replace('_', ' ', $child->status)) }}</span></td>
                        <td>
                            @if($child->status !== 'checked_in')
                            <form action="/admin/children/{{ $child->id }}/checkin" method="POST" style="display:inline">
                                @csrf
                                <button class="btn btn-checkin">Check In</button>
                            </form>
                            @endif
                            @if($child->status === 'checked_in')
                            <form action="/admin/children/{{ $child->id }}/checkout" method="POST" style="display:inline">
                                @csrf
                                <button class="btn btn-checkout">Check Out</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>