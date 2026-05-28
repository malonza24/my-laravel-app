<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Diligent Mom</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #f43f5e;
            --primary-dark: #e11d48;
            --indigo: #6366f1;
            --success: #10b981;
            --warning: #f59e0b;
            --purple: #8b5cf6;
            --bg: #f8fafc;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --radius: 16px;
            --shadow: 0 4px 24px rgba(0,0,0,0.06);
            --shadow-lg: 0 12px 40px rgba(0,0,0,0.1);
        }
        body { font-family: 'Segoe UI', sans-serif; background: var(--bg); min-height: 100vh; }

        /* NAVBAR */
        .navbar {
            background: white;
            padding: 0 32px;
            height: 68px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 20px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 100;
            animation: slideDown 0.5s ease;
        }
        @keyframes slideDown { from { transform: translateY(-100%); } to { transform: translateY(0); } }
        .navbar .brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .brand-icon { width: 38px; height: 38px; background: linear-gradient(135deg, var(--primary), var(--warning)); border-radius: 11px; display: flex; align-items: center; justify-content: center; color: white; }
        .brand-text { font-size: 16px; font-weight: 800; color: var(--text); }
        .brand-text span { color: var(--primary); }
        .nav-right { display: flex; align-items: center; gap: 8px; }
        .nav-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }
        .nav-btn-ghost { color: var(--text-light); background: none; }
        .nav-btn-ghost:hover { background: var(--bg); color: var(--text); }
        .nav-btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
        .nav-btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }
        .user-chip { display: flex; align-items: center; gap: 8px; padding: 6px 12px; background: var(--bg); border-radius: 50px; border: 1px solid var(--border); }
        .user-avatar { width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--warning)); display: flex; align-items: center; justify-content: center; color: white; font-size: 11px; font-weight: 700; }
        .user-name { font-size: 13px; font-weight: 600; color: var(--text); }

        /* HERO BANNER */
        .hero-banner {
            width: 100%;
            height: 300px;
            overflow: hidden;
            position: relative;
        }
        .hero-banner img { width: 100%; height: 100%; object-fit: cover; }
        .hero-banner .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(244,63,94,0.85), rgba(249,115,22,0.6));
            display: flex;
            align-items: center;
            padding: 0 48px;
        }
        .hero-text { animation: heroFadeIn 0.8s ease; }
        @keyframes heroFadeIn { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .hero-text h1 { font-size: 36px; font-weight: 800; color: white; margin-bottom: 8px; }
        .hero-text p { color: rgba(255,255,255,0.85); font-size: 16px; }
        .hero-text .welcome-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.2); color: white; padding: 6px 14px; border-radius: 50px; font-size: 13px; font-weight: 600; margin-bottom: 16px; backdrop-filter: blur(4px); }

        /* MAIN CONTENT */
        .container { max-width: 1100px; margin: 0 auto; padding: 32px 24px; }

        /* ALERT */
        .alert { padding: 14px 18px; border-radius: 12px; margin-bottom: 24px; font-size: 14px; display: flex; align-items: center; gap: 10px; animation: alertIn 0.4s ease; }
        @keyframes alertIn { from { transform: translateY(-10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .alert-success { background: #ecfdf5; color: #059669; border-left: 4px solid #10b981; }
        .alert-error { background: #fef2f2; color: #dc2626; border-left: 4px solid #ef4444; }

        /* STATS */
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 32px; }
        .stat-card {
            background: white;
            border-radius: var(--radius);
            padding: 22px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 16px;
            border: 1px solid var(--border);
            transition: transform 0.2s, box-shadow 0.2s;
            animation: cardIn 0.5s ease;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); }
        @keyframes cardIn { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .stat-icon { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-icon.pink { background: #fff1f2; color: var(--primary); }
        .stat-icon.green { background: #ecfdf5; color: var(--success); }
        .stat-icon.purple { background: #faf5ff; color: var(--purple); }
        .stat-value { font-size: 26px; font-weight: 800; color: var(--text); }
        .stat-label { font-size: 13px; color: var(--text-light); margin-top: 2px; }

        /* SECTION HEADER */
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-header h2 { font-size: 20px; font-weight: 700; color: var(--text); display: flex; align-items: center; gap: 8px; }
        .add-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: transform 0.2s, opacity 0.2s;
        }
        .add-btn:hover { transform: translateY(-2px); opacity: 0.9; }

        /* CHILDREN GRID */
        .children-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .child-card {
            background: white;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: transform 0.3s, box-shadow 0.3s;
            animation: cardIn 0.5s ease;
        }
        .child-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-lg); }
        .child-card-image { width: 100%; height: 200px; object-fit: cover; }
        .child-card-body { padding: 20px; }
        .child-name { font-size: 18px; font-weight: 700; color: var(--text); margin-bottom: 12px; }
        .child-detail { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-light); margin-bottom: 6px; }
        .child-detail svg { flex-shrink: 0; color: var(--text-light); }
        .badges { display: flex; flex-wrap: wrap; gap: 6px; margin: 14px 0; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 50px; font-size: 11px; font-weight: 600; }
        .badge-checked-in { background: #eff6ff; color: #2563eb; }
        .badge-checked-out { background: #f5f3ff; color: #7c3aed; }
        .badge-pending { background: #fffbeb; color: #d97706; }
        .badge-paid { background: #ecfdf5; color: #059669; }
        .badge-unpaid { background: #fef2f2; color: #dc2626; }
        .child-actions { display: flex; flex-direction: column; gap: 8px; margin-top: 14px; }
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-pay { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: white; }
        .btn-pay:hover { opacity: 0.9; transform: translateY(-1px); }
        .btn-checkout { background: #f5f3ff; color: #7c3aed; }
        .btn-checkout:hover { background: #ede9fe; transform: translateY(-1px); }
        .btn-disabled { background: #f1f5f9; color: #94a3b8; cursor: not-allowed; }
        .payment-warning { background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 10px 12px; font-size: 12px; color: #dc2626; display: flex; align-items: center; gap: 6px; margin-top: 8px; }
        .checkin-info { font-size: 12px; color: var(--text-light); text-align: center; margin-top: 6px; display: flex; align-items: center; justify-content: center; gap: 4px; }

        /* EMPTY */
        .empty-state { text-align: center; padding: 64px 32px; background: white; border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--border); }
        .empty-icon { width: 72px; height: 72px; background: #fff1f2; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; color: var(--primary); }
        .empty-state h3 { font-size: 18px; font-weight: 700; color: var(--text); margin-bottom: 8px; }
        .empty-state p { color: var(--text-light); font-size: 14px; margin-bottom: 20px; }

        @media (max-width: 768px) {
            .stats { grid-template-columns: 1fr; }
            .hero-banner .hero-overlay { padding: 0 24px; }
            .hero-text h1 { font-size: 26px; }
            .navbar { padding: 0 16px; }
            .container { padding: 20px 16px; }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="/" class="brand">
            <div class="brand-icon"><i data-lucide="heart" style="width:16px;height:16px;"></i></div>
            <span class="brand-text">Diligent <span>Mom</span></span>
        </a>
        <div class="nav-right">
            <div class="user-chip">
                <div class="user-avatar">{{ strtoupper(substr($parent->name, 0, 1)) }}</div>
                <span class="user-name">{{ $parent->name }}</span>
            </div>
            <a href="/parent/child/register" class="nav-btn nav-btn-ghost">
                <i data-lucide="plus" style="width:14px;height:14px;"></i>
                Add Child
            </a>
            <form action="/parent/logout" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav-btn nav-btn-primary">
                    <i data-lucide="log-out" style="width:14px;height:14px;"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <div class="hero-banner">
        <img src="/images/dashboard-hero.png" alt="Diligent Mom"/>
        <div class="hero-overlay">
            <div class="hero-text">
                <div class="welcome-badge">
                    <i data-lucide="sparkles" style="width:14px;height:14px;"></i>
                    Parent Dashboard
                </div>
                <h1>Welcome back, {{ $parent->name }}!</h1>
                <p>We care. You focus. They thrive.</p>
            </div>
        </div>
    </div>

    <div class="container">

        @if(session('success'))
            <div class="alert alert-success">
                <i data-lucide="check-circle" style="width:18px;height:18px;"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                <i data-lucide="alert-circle" style="width:18px;height:18px;"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- STATS -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-icon pink">
                    <i data-lucide="users" style="width:24px;height:24px;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $children->count() }}</div>
                    <div class="stat-label">Registered Children</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green">
                    <i data-lucide="user-check" style="width:24px;height:24px;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $children->where('status', 'checked_in')->count() }}</div>
                    <div class="stat-label">Currently Checked In</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i data-lucide="credit-card" style="width:24px;height:24px;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $children->filter(fn($c) => $c->payments->where('status', 'completed')->count() > 0)->count() }}</div>
                    <div class="stat-label">Payments Completed</div>
                </div>
            </div>
        </div>

        <!-- CHILDREN -->
        <div class="section-header">
            <h2>
                <i data-lucide="baby" style="width:20px;height:20px;color:#f43f5e;"></i>
                Your Children
            </h2>
            <a href="/parent/child/register" class="add-btn">
                <i data-lucide="plus" style="width:14px;height:14px;"></i>
                Register Child
            </a>
        </div>

        @if($children->count() > 0)
            <div class="children-grid">
                @foreach($children as $child)
                <div class="child-card">
                    <img src="{{ asset('storage/' . $child->photo) }}" class="child-card-image" alt="{{ $child->name }}"/>
                    <div class="child-card-body">
                        <div class="child-name">{{ $child->name }}</div>

                        <div class="child-detail">
                            <i data-lucide="calendar" style="width:14px;height:14px;"></i>
                            Age: {{ $child->age }} years | {{ ucfirst($child->gender) }}
                        </div>
                        <div class="child-detail">
                            <i data-lucide="log-in" style="width:14px;height:14px;"></i>
                            Check-in: {{ $child->checkin_time ?? 'Not set' }}
                        </div>
                        <div class="child-detail">
                            <i data-lucide="log-out" style="width:14px;height:14px;"></i>
                            Check-out: {{ $child->checkout_time ?? 'Not set' }}
                        </div>
                        @if($child->checkin_date)
                        <div class="child-detail">
                            <i data-lucide="calendar-check" style="width:14px;height:14px;"></i>
                            Date: {{ \Carbon\Carbon::parse($child->checkin_date)->format('M d, Y') }}
                        </div>
                        @endif
                        @if($child->has_disability)
                        <div class="child-detail" style="color:#7c3aed;">
                            <i data-lucide="accessibility" style="width:14px;height:14px;"></i>
                            {{ $child->disability_details }}
                        </div>
                        @endif
                        @if($child->has_allergy)
                        <div class="child-detail" style="color:#d97706;">
                            <i data-lucide="alert-triangle" style="width:14px;height:14px;"></i>
                            Allergy: {{ $child->allergy_details }}
                        </div>
                        @endif

                        <div class="badges">
                            <span class="badge {{ $child->status === 'checked_in' ? 'badge-checked-in' : ($child->status === 'checked_out' ? 'badge-checked-out' : 'badge-pending') }}">
                                <i data-lucide="{{ $child->status === 'checked_in' ? 'circle-dot' : ($child->status === 'checked_out' ? 'circle-check' : 'clock') }}" style="width:10px;height:10px;"></i>
                                {{ ucfirst(str_replace('_', ' ', $child->status)) }}
                            </span>
                            @php $latestPayment = $child->payments->last(); @endphp
                            @if($latestPayment && $latestPayment->status === 'completed')
                                <span class="badge badge-paid">
                                    <i data-lucide="check-circle" style="width:10px;height:10px;"></i>
                                    Paid
                                </span>
                            @else
                                <span class="badge badge-unpaid">
                                    <i data-lucide="clock" style="width:10px;height:10px;"></i>
                                    Payment Pending
                                </span>
                            @endif
                        </div>

                        <div class="child-actions">
                            @if(!$latestPayment || $latestPayment->status !== 'completed')
                                <a href="/parent/payment/{{ $child->id }}" class="action-btn btn-pay">
                                    <i data-lucide="smartphone" style="width:16px;height:16px;"></i>
                                    Pay Now via M-Pesa
                                </a>
                                <div class="payment-warning">
                                    <i data-lucide="lock" style="width:12px;height:12px;"></i>
                                    Payment required before checkout
                                </div>
                            @endif

                            @if($child->status === 'checked_in')
                                @if($latestPayment && $latestPayment->status === 'completed')
                                    <form action="/parent/child/{{ $child->id }}/checkout" method="POST">
                                        @csrf
                                        <button type="submit" class="action-btn btn-checkout" style="width:100%;">
                                            <i data-lucide="log-out" style="width:16px;height:16px;"></i>
                                            Check Out Child
                                        </button>
                                    </form>
                                @else
                                    <div class="action-btn btn-disabled">
                                        <i data-lucide="lock" style="width:16px;height:16px;"></i>
                                        Check Out (Pay first)
                                    </div>
                                @endif
                                <div class="checkin-info">
                                    <i data-lucide="clock" style="width:12px;height:12px;"></i>
                                    Checked in at {{ $child->checkin_time }} on {{ $child->checkin_date ? \Carbon\Carbon::parse($child->checkin_date)->format('M d, Y') : 'today' }}
                                </div>
                            @endif

                            @if($child->status === 'checked_out')
                                <div class="checkin-info" style="color:#7c3aed;">
                                    <i data-lucide="check-circle" style="width:12px;height:12px;"></i>
                                    Checked out at {{ $child->checkout_time }}
                                    on {{ $child->checkout_date ? \Carbon\Carbon::parse($child->checkout_date)->format('M d, Y') : 'today' }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">
                    <i data-lucide="baby" style="width:32px;height:32px;"></i>
                </div>
                <h3>No children registered yet</h3>
                <p>Register your first child to get started with the daycare system.</p>
                <a href="/parent/child/register" class="add-btn">
                    <i data-lucide="plus" style="width:14px;height:14px;"></i>
                    Register First Child
                </a>
            </div>
        @endif
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>