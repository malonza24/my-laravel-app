<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Diligent Mom Admin</title>
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
        .badge-completed { background: #c6f6d5; color: #276749; }
        .badge-pending { background: #fefcbf; color: #744210; }
        .badge-failed { background: #fed7d7; color: #c53030; }
        .btn { display: inline-block; padding: 5px 12px; border-radius: 6px; font-size: 12px; cursor: pointer; border: none; }
        .btn-confirm { background: #c6f6d5; color: #276749; }
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
        <a href="/admin/children">👶 Children</a>
        <a href="/admin/payments" class="active">💳 Payments</a>
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
            <h1>💳 Payments</h1>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Parent</th>
                        <th>Child</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->parent->name ?? 'N/A' }}</td>
                        <td>{{ $payment->child->name ?? 'N/A' }}</td>
                        <td>{{ $payment->phone_number }}</td>
                        <td>KSH {{ number_format($payment->amount) }}</td>
                        <td>{{ $payment->mpesa_transaction_id ?? '--' }}</td>
                        <td><span class="badge badge-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></td>
                        <td>{{ $payment->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($payment->status !== 'completed')
                            <form action="/admin/payments/{{ $payment->id }}/confirm" method="POST" style="display:inline">
                                @csrf
                                <button class="btn btn-confirm">Confirm</button>
                            </form>
                            @else
                                ✅ Confirmed
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