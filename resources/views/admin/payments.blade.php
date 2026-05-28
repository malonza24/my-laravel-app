<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root { --primary: #6366f1; --primary-dark: #4f46e5; --success: #10b981; --warning: #f59e0b; --bg: #f1f5f9; --sidebar: #0f172a; --text: #1e293b; --text-light: #64748b; --border: #e2e8f0; --radius: 14px; --shadow: 0 4px 24px rgba(0,0,0,0.08); }
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
        .alert-success { background: #ecfdf5; color: #059669; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 8px; border-left: 4px solid #10b981; }
        .card { background: white; border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow); }
        table { width: 100%; border-collapse: collapse; }
        th { font-size: 11px; color: var(--text-light); text-align: left; padding: 10px 14px; text-transform: uppercase; letter-spacing: 0.5px; background: var(--bg); }
        td { font-size: 14px; color: var(--text); padding: 14px; border-bottom: 1px solid var(--bg); vertical-align: middle; }
        tr:hover td { background: #fafafa; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 50px; font-size: 11px; font-weight: 600; }
        .badge-completed { background: #ecfdf5; color: #059669; }
        .badge-pending { background: #fffbeb; color: #d97706; }
        .badge-failed { background: #fef2f2; color: #dc2626; }
        .badge-mpesa { background: #ecfdf5; color: #059669; }
        .badge-cash { background: #eff6ff; color: #2563eb; }
        .actions { display: flex; gap: 6px; }
        .btn-sm { display: inline-flex; align-items: center; gap: 4px; padding: 7px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; border: none; transition: opacity 0.2s; }
        .btn-confirm { background: #ecfdf5; color: #059669; }
        .btn-decline { background: #fef2f2; color: #dc2626; }
        .btn-sm:hover { opacity: 0.8; }
        .decline-reason { font-size: 11px; color: #dc2626; margin-top: 4px; }
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; }
        .modal-overlay.open { display: flex; }
        .modal { background: white; border-radius: 16px; padding: 32px; width: 100%; max-width: 440px; box-shadow: 0 32px 80px rgba(0,0,0,0.3); }
        .modal h3 { font-size: 18px; font-weight: 700; color: var(--text); margin-bottom: 6px; display: flex; align-items: center; gap: 8px; }
        .modal p { font-size: 14px; color: var(--text-light); margin-bottom: 20px; }
        .modal label { display: block; font-size: 13px; color: var(--text); margin-bottom: 8px; font-weight: 600; }
        .modal textarea { width: 100%; padding: 12px; border: 2px solid var(--border); border-radius: 10px; font-size: 14px; outline: none; resize: vertical; margin-bottom: 16px; }
        .modal textarea:focus { border-color: #ef4444; }
        .modal-btns { display: flex; gap: 10px; }
        .modal-btns button { flex: 1; padding: 11px; border-radius: 10px; font-size: 14px; cursor: pointer; border: none; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 6px; }
        .btn-cancel { background: var(--bg); color: var(--text); }
        .btn-decline-confirm { background: #fef2f2; color: #dc2626; }
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
            <a href="/admin/payments" class="nav-item active"><i data-lucide="credit-card" class="icon"></i> Payments</a>
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
            <h1><i data-lucide="credit-card" style="width:24px;height:24px;color:#10b981;"></i> Payments</h1>
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
                        <th>Child</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $payment->parent->name ?? 'N/A' }}</td>
                        <td>{{ $payment->child->name ?? 'N/A' }}</td>
                        <td>{{ $payment->phone_number }}</td>
                        <td><strong>KSH {{ number_format($payment->amount) }}</strong></td>
                        <td><span class="badge badge-{{ $payment->payment_method }}">{{ strtoupper($payment->payment_method) }}</span></td>
                        <td style="font-size:12px;">{{ $payment->mpesa_transaction_id ?? '--' }}</td>
                        <td>
                            <span class="badge badge-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span>
                            @if($payment->decline_reason)
                                <div class="decline-reason">{{ $payment->decline_reason }}</div>
                            @endif
                        </td>
                        <td style="font-size:12px;">{{ $payment->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            @if($payment->status === 'pending')
                                <div class="actions">
                                    <form action="/admin/payments/{{ $payment->id }}/confirm" method="POST" style="display:inline">
                                        @csrf
                                        <button class="btn-sm btn-confirm"><i data-lucide="check" style="width:12px;height:12px;"></i> Confirm</button>
                                    </form>
                                    <button class="btn-sm btn-decline" onclick="openDeclineModal({{ $payment->id }})">
                                        <i data-lucide="x" style="width:12px;height:12px;"></i> Decline
                                    </button>
                                </div>
                            @elseif($payment->status === 'completed')
                                <span style="color:#059669;font-size:12px;font-weight:600;display:flex;align-items:center;gap:4px;">
                                    <i data-lucide="check-circle" style="width:14px;height:14px;"></i> Confirmed
                                </span>
                            @else
                                <span style="color:#dc2626;font-size:12px;font-weight:600;display:flex;align-items:center;gap:4px;">
                                    <i data-lucide="x-circle" style="width:14px;height:14px;"></i> Declined
                                </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal-overlay" id="declineModal">
        <div class="modal">
            <h3><i data-lucide="alert-triangle" style="width:20px;height:20px;color:#dc2626;"></i> Decline Payment</h3>
            <p>Please provide a reason for declining this payment.</p>
            <form id="declineForm" method="POST">
                @csrf
                <label>Reason for declining</label>
                <textarea name="decline_reason" rows="3" placeholder="e.g. Cash not received, incorrect amount..."></textarea>
                <div class="modal-btns">
                    <button type="button" class="btn-cancel" onclick="closeDeclineModal()">
                        <i data-lucide="x" style="width:16px;height:16px;"></i> Cancel
                    </button>
                    <button type="submit" class="btn-decline-confirm">
                        <i data-lucide="x-circle" style="width:16px;height:16px;"></i> Decline Payment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeclineModal(paymentId) {
            document.getElementById('declineForm').action = '/admin/payments/' + paymentId + '/decline';
            document.getElementById('declineModal').classList.add('open');
        }
        function closeDeclineModal() {
            document.getElementById('declineModal').classList.remove('open');
        }
        lucide.createIcons();
    </script>
</body>
</html>