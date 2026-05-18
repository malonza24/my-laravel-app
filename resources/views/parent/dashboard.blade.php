<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parent Dashboard - Diligent Mom</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; min-height: 100vh; }
        .navbar {
            background: white;
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar .brand h2 { font-size: 18px; color: #1a2a5e; font-weight: 800; }
        .navbar .brand h2 span { color: #e8386d; }
        .navbar .nav-right { display: flex; align-items: center; gap: 16px; }
        .navbar .nav-right a { color: #555; text-decoration: none; font-size: 14px; }
        .navbar .nav-right a:hover { color: #e8386d; }
        .navbar form button {
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }
        .hero-banner {
            width: 100%;
            height: 320px;
            overflow: hidden;
            position: relative;
        }
        .hero-banner img { width: 100%; height: 100%; object-fit: cover; }
        .hero-banner .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(26,42,94,0.7), rgba(232,56,109,0.4));
            display: flex;
            align-items: center;
            padding: 0 48px;
        }
        .hero-banner .overlay h1 { font-size: 36px; color: white; font-weight: 800; line-height: 1.3; }
        .hero-banner .overlay h1 span { color: #ffd6e7; }
        .hero-banner .overlay p { color: rgba(255,255,255,0.9); font-size: 16px; margin-top: 8px; }
        .container { max-width: 1000px; margin: 0 auto; padding: 32px 20px; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-bottom: 32px; }
        .stat-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); text-align: center; }
        .stat-card .icon { font-size: 28px; margin-bottom: 8px; }
        .stat-card .value { font-size: 24px; font-weight: 700; color: #1a2a5e; }
        .stat-card .label { font-size: 13px; color: #888; margin-top: 4px; }
        .section-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-header h2 { font-size: 20px; color: #1a2a5e; font-weight: 700; }
        .add-btn {
            display: inline-block;
            padding: 10px 20px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }
        .success-msg { background: #c6f6d5; color: #276749; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
        .children-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        .child-card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: transform 0.2s; }
        .child-card:hover { transform: translateY(-4px); }
        .child-card .child-photo { width: 100%; height: 180px; object-fit: cover; }
        .child-card .child-info { padding: 20px; }
        .child-card h3 { font-size: 18px; color: #1a2a5e; margin-bottom: 8px; font-weight: 700; }
        .child-card p { font-size: 13px; color: #888; margin-bottom: 4px; }
        .badges { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 12px; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; }
        .badge-paid { background: #c6f6d5; color: #276749; }
        .badge-pending { background: #fefcbf; color: #744210; }
        .badge-checked-in { background: #bee3f8; color: #2a69ac; }
        .badge-checked-out { background: #e9d8fd; color: #553c9a; }
        .badge-default { background: #f0f0f0; color: #555; }
        .pay-link {
            display: block;
            margin-top: 12px;
            padding: 10px;
            background: linear-gradient(135deg, #f093fb, #f5576c);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
        }
        .checkout-btn {
            width: 100%;
            margin-top: 8px;
            padding: 10px;
            background: #e9d8fd;
            color: #553c9a;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .checkout-btn:hover { background: #d6bcfa; }
        .checkin-info { font-size: 12px; color: #888; margin-top: 6px; text-align: center; }
        .empty { text-align: center; padding: 60px 20px; background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
        .empty p { color: #888; font-size: 16px; margin-bottom: 16px; }
        @media (max-width: 768px) {
            .stats { grid-template-columns: 1fr; }
            .hero-banner .overlay { padding: 0 24px; }
            .hero-banner .overlay h1 { font-size: 24px; }
            .navbar { padding: 16px 20px; }
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">
            <h2>DILIGENT <span>MOM</span></h2>
        </div>
        <div class="nav-right">
            <a href="/">🏠 Home</a>
            <a href="/parent/child/register">+ Add Child</a>
            <form action="/parent/logout" method="POST">
                @csrf
                <button type="submit">Logout →</button>
            </form>
        </div>
    </div>

    <div class="hero-banner">
        <img src="/images/dashboard-hero.png" alt="Diligent Mom"/>
        <div class="overlay">
            <div>
                <h1>Welcome back, <span>{{ $parent->name }}!</span> 👋</h1>
                <p>We care. You focus. They thrive. ❤️</p>
            </div>
        </div>
    </div>

    <div class="container">

        @if(session('success'))
            <div class="success-msg">✅ {{ session('success') }}</div>
        @endif

        <div class="stats">
            <div class="stat-card">
                <div class="icon">👶</div>
                <div class="value">{{ $children->count() }}</div>
                <div class="label">Registered Children</div>
            </div>
            <div class="stat-card">
                <div class="icon">✅</div>
                <div class="value">{{ $children->where('status', 'checked_in')->count() }}</div>
                <div class="label">Currently Checked In</div>
            </div>
            <div class="stat-card">
                <div class="icon">💳</div>
                <div class="value">{{ $children->filter(fn($c) => $c->payments->where('status', 'completed')->count() > 0)->count() }}</div>
                <div class="label">Payments Completed</div>
            </div>
        </div>

        <div class="section-header">
            <h2>👶 Your Children</h2>
            <a href="/parent/child/register" class="add-btn">+ Register Child</a>
        </div>

        @if($children->count() > 0)
            <div class="children-grid">
                @foreach($children as $child)
                <div class="child-card">
                    <img src="{{ asset('storage/' . $child->photo) }}" class="child-photo" alt="{{ $child->name }}"/>
                    <div class="child-info">
                        <h3>{{ $child->name }}</h3>
                        <p>🧒 Age: {{ $child->age }} | {{ ucfirst($child->gender) }}</p>
                        <p>🕐 Check-in: {{ $child->checkin_time ?? 'Not set' }}</p>
                        <p>🕑 Check-out: {{ $child->checkout_time ?? 'Not set' }}</p>
                        @if($child->checkin_date)
                            <p>📅 Date: {{ \Carbon\Carbon::parse($child->checkin_date)->format('M d, Y') }}</p>
                        @endif
                        @if($child->has_disability)
                            <p>♿ {{ $child->disability_details }}</p>
                        @endif
                        @if($child->has_allergy)
                            <p>⚠️ Allergy: {{ $child->allergy_details }}</p>
                        @endif

                        <div class="badges">
                            <span class="badge {{ $child->status === 'checked_in' ? 'badge-checked-in' : ($child->status === 'checked_out' ? 'badge-checked-out' : 'badge-default') }}">
                                {{ ucfirst(str_replace('_', ' ', $child->status)) }}
                            </span>
                            @php $latestPayment = $child->payments->last(); @endphp
                            @if($latestPayment && $latestPayment->status === 'completed')
                                <span class="badge badge-paid">✅ Paid</span>
                            @else
                                <span class="badge badge-pending">💳 Pending</span>
                            @endif
                        </div>

                        @if(!$latestPayment || $latestPayment->status !== 'completed')
                            <a href="/parent/payment/{{ $child->id }}" class="pay-link">
                                Pay Now via M-Pesa 📱
                            </a>
                        @endif

                        @if($child->status === 'checked_in')
                            <form action="/parent/child/{{ $child->id }}/checkout" method="POST">
                                @csrf
                                <button type="submit" class="checkout-btn">
                                    🚪 Check Out Child
                                </button>
                            </form>
                            <p class="checkin-info">
                                Checked in at {{ $child->checkin_time }}
                                on {{ $child->checkin_date ? \Carbon\Carbon::parse($child->checkin_date)->format('M d, Y') : 'today' }}
                            </p>
                        @endif

                        @if($child->status === 'checked_out')
                            <p class="checkin-info" style="color:#553c9a; margin-top:8px;">
                                ✅ Checked out at {{ $child->checkout_time }}
                                on {{ $child->checkout_date ? \Carbon\Carbon::parse($child->checkout_date)->format('M d, Y') : 'today' }}
                            </p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty">
                <p>No children registered yet.</p>
                <a href="/parent/child/register" class="add-btn">Register your first child →</a>
            </div>
        @endif
    </div>
</body>
</html>