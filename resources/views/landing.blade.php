<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diligent Mom Support System</title>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #6366f1;
            --pink: #f43f5e;
            --orange: #f97316;
            --dark: #0f172a;
            --text: #1e293b;
            --text-light: #64748b;
            --border: #e2e8f0;
            --bg: #f8fafc;
        }
        body { font-family: 'Segoe UI', sans-serif; background: white; color: var(--text); overflow-x: hidden; }

        /* NAVBAR */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(12px);
            padding: 16px 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 20px rgba(0,0,0,0.06);
            z-index: 1000;
            animation: slideDown 0.6s ease;
        }
        @keyframes slideDown { from { transform: translateY(-100%); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .nav-brand-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--primary), var(--pink)); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; }
        .nav-brand-text { font-size: 18px; font-weight: 800; color: var(--text); }
        .nav-brand-text span { color: var(--pink); }
        .hamburger { display: flex; flex-direction: column; gap: 5px; cursor: pointer; padding: 8px; border-radius: 8px; transition: background 0.2s; border: none; background: none; }
        .hamburger:hover { background: var(--bg); }
        .hamburger span { display: block; width: 24px; height: 2px; background: var(--text); border-radius: 2px; transition: all 0.3s; }
        .hamburger.open span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .hamburger.open span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

        /* SIDE MENU */
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1500; backdrop-filter: blur(4px); }
        .overlay.open { display: block; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .side-menu {
            position: fixed;
            top: 0; right: -340px;
            width: 320px;
            height: 100vh;
            background: white;
            box-shadow: -8px 0 40px rgba(0,0,0,0.15);
            z-index: 2000;
            transition: right 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            padding: 0;
        }
        .side-menu.open { right: 0; }
        .side-menu-header {
            padding: 24px 24px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, var(--primary), var(--pink));
        }
        .side-menu-header .brand { display: flex; align-items: center; gap: 10px; }
        .side-menu-header .brand-icon { width: 36px; height: 36px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; }
        .side-menu-header h3 { color: white; font-size: 16px; font-weight: 700; }
        .side-menu-header p { color: rgba(255,255,255,0.7); font-size: 12px; }
        .close-btn { background: rgba(255,255,255,0.2); border: none; cursor: pointer; color: white; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: background 0.2s; }
        .close-btn:hover { background: rgba(255,255,255,0.3); }
        .side-menu-body { flex: 1; padding: 20px 16px; overflow-y: auto; }
        .menu-section-label { font-size: 11px; color: var(--text-light); text-transform: uppercase; letter-spacing: 1px; padding: 0 8px; margin: 16px 0 8px; font-weight: 600; }
        .menu-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 12px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--text);
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 4px;
        }
        .menu-item:hover { background: var(--bg); transform: translateX(4px); }
        .menu-item .menu-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .menu-icon.parent { background: #fff1f2; color: var(--pink); }
        .menu-icon.admin { background: #eef2ff; color: var(--primary); }
        .menu-icon.support { background: #ecfdf5; color: #059669; }
        .menu-icon.email { background: #fffbeb; color: #d97706; }
        .menu-item-text { flex: 1; }
        .menu-item-title { font-weight: 600; color: var(--text); font-size: 14px; }
        .menu-item-sub { font-size: 12px; color: var(--text-light); margin-top: 1px; }
        .menu-divider { height: 1px; background: var(--border); margin: 12px 0; }
        .side-menu-footer { padding: 16px; border-top: 1px solid var(--border); background: var(--bg); }
        .contact-card { background: white; border-radius: 12px; padding: 16px; border: 1px solid var(--border); }
        .contact-card h4 { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
        .contact-item { display: flex; align-items: center; gap: 10px; padding: 8px 0; font-size: 13px; color: var(--text); text-decoration: none; }
        .contact-item:hover { color: var(--primary); }
        .contact-icon { width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .contact-icon.phone { background: #ecfdf5; color: #059669; }
        .contact-icon.mail { background: #eef2ff; color: var(--primary); }

        /* HERO */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 48px 60px;
            background: linear-gradient(135deg, #fafafa 0%, #f0f4ff 50%, #fff1f2 100%);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99,102,241,0.08) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero::after {
            content: '';
            position: absolute;
            bottom: -200px; left: -200px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(244,63,94,0.08) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-content { flex: 1; max-width: 580px; animation: heroLeft 0.8s ease; position: relative; z-index: 1; }
        @keyframes heroLeft { from { transform: translateX(-40px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: white;
            border: 1px solid var(--border);
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(99,102,241,0.1);
        }
        .hero h1 { font-size: 52px; font-weight: 900; line-height: 1.15; color: var(--text); margin-bottom: 20px; }
        .hero h1 .highlight { background: linear-gradient(135deg, var(--primary), var(--pink)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .hero p { font-size: 18px; color: var(--text-light); line-height: 1.7; margin-bottom: 36px; }
        .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 15px 28px;
            background: linear-gradient(135deg, var(--primary), var(--pink));
            color: white;
            border-radius: 12px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            box-shadow: 0 8px 24px rgba(99,102,241,0.3);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(99,102,241,0.4); }
        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 15px 28px;
            background: white;
            color: var(--text);
            border-radius: 12px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            border: 2px solid var(--border);
            transition: border-color 0.2s, transform 0.2s;
        }
        .btn-secondary:hover { border-color: var(--primary); transform: translateY(-2px); }
        .hero-image { flex: 1; display: flex; justify-content: center; padding-left: 48px; animation: heroRight 0.8s ease; position: relative; z-index: 1; }
        @keyframes heroRight { from { transform: translateX(40px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        .hero-image img { width: 100%; max-width: 560px; border-radius: 24px; box-shadow: 0 32px 80px rgba(0,0,0,0.12); }
        .hero-stats { display: flex; gap: 32px; margin-top: 40px; }
        .hero-stat .number { font-size: 28px; font-weight: 800; color: var(--text); }
        .hero-stat .label { font-size: 13px; color: var(--text-light); margin-top: 2px; }

        /* FEATURES */
        .features { padding: 100px 48px; background: white; }
        .section-header { text-align: center; margin-bottom: 64px; animation: fadeUp 0.6s ease; }
        .section-badge { display: inline-flex; align-items: center; gap: 6px; background: #eef2ff; padding: 6px 14px; border-radius: 50px; font-size: 13px; font-weight: 600; color: var(--primary); margin-bottom: 16px; }
        .section-header h2 { font-size: 40px; font-weight: 800; color: var(--text); margin-bottom: 16px; }
        .section-header p { font-size: 17px; color: var(--text-light); max-width: 560px; margin: 0 auto; line-height: 1.7; }
        .features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; max-width: 1100px; margin: 0 auto; }
        .feature-card {
            background: var(--bg);
            border-radius: 20px;
            padding: 32px 28px;
            border: 1px solid var(--border);
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            animation: fadeUp 0.6s ease;
        }
        .feature-card:hover { transform: translateY(-8px); box-shadow: 0 24px 48px rgba(0,0,0,0.08); border-color: var(--primary); }
        .feature-icon-wrap { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; }
        .feature-card h3 { font-size: 17px; font-weight: 700; color: var(--text); margin-bottom: 10px; }
        .feature-card p { font-size: 14px; color: var(--text-light); line-height: 1.6; }

        /* CTA */
        .cta {
            padding: 100px 48px;
            background: linear-gradient(135deg, var(--dark) 0%, #1e1b4b 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta::before { content: ''; position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%); border-radius: 50%; }
        .cta::after { content: ''; position: absolute; bottom: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(244,63,94,0.2) 0%, transparent 70%); border-radius: 50%; }
        .cta-content { position: relative; z-index: 1; }
        .cta h2 { font-size: 40px; font-weight: 800; color: white; margin-bottom: 16px; }
        .cta p { color: rgba(255,255,255,0.7); font-size: 17px; margin-bottom: 40px; max-width: 500px; margin-left: auto; margin-right: auto; }
        .cta-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .btn-white { display: inline-flex; align-items: center; gap: 8px; padding: 15px 28px; background: white; color: var(--text); border-radius: 12px; text-decoration: none; font-size: 15px; font-weight: 600; transition: transform 0.2s; }
        .btn-white:hover { transform: translateY(-2px); }
        .btn-outline { display: inline-flex; align-items: center; gap: 8px; padding: 15px 28px; background: transparent; color: white; border-radius: 12px; text-decoration: none; font-size: 15px; font-weight: 600; border: 2px solid rgba(255,255,255,0.3); transition: border-color 0.2s, transform 0.2s; }
        .btn-outline:hover { border-color: white; transform: translateY(-2px); }

        /* FOOTER */
        footer { background: var(--dark); padding: 32px 48px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; border-top: 1px solid rgba(255,255,255,0.06); }
        footer p { color: rgba(255,255,255,0.4); font-size: 13px; }
        .footer-links { display: flex; gap: 24px; }
        .footer-links a { color: rgba(255,255,255,0.4); text-decoration: none; font-size: 13px; display: flex; align-items: center; gap: 6px; transition: color 0.2s; }
        .footer-links a:hover { color: white; }

        @keyframes fadeUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        @media (max-width: 900px) {
            .hero { flex-direction: column; padding: 100px 24px 48px; text-align: center; }
            .hero h1 { font-size: 36px; }
            .hero-image { padding-left: 0; margin-top: 32px; }
            .hero-btns { justify-content: center; }
            .hero-stats { justify-content: center; }
            .features { padding: 60px 24px; }
            .features-grid { grid-template-columns: 1fr; }
            .cta { padding: 60px 24px; }
            nav { padding: 16px 24px; }
            footer { padding: 24px; flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

<div class="overlay" id="overlay" onclick="closeMenu()"></div>

<div class="side-menu" id="sideMenu">
    <div class="side-menu-header">
        <div class="brand">
            <div class="brand-icon"><i data-lucide="heart" style="width:18px;height:18px;"></i></div>
            <div>
                <h3>Diligent Mom</h3>
                <p>Support System</p>
            </div>
        </div>
        <button class="close-btn" onclick="closeMenu()">
            <i data-lucide="x" style="width:18px;height:18px;"></i>
        </button>
    </div>
    <div class="side-menu-body">
        <div class="menu-section-label">Parent Portal</div>
        <a href="/parent/register" class="menu-item">
            <div class="menu-icon parent"><i data-lucide="user-plus" style="width:18px;height:18px;"></i></div>
            <div class="menu-item-text">
                <div class="menu-item-title">Parent Register</div>
                <div class="menu-item-sub">Create a new parent account</div>
            </div>
            <i data-lucide="chevron-right" style="width:16px;height:16px;color:#94a3b8;"></i>
        </a>
        <a href="/parent/login" class="menu-item">
            <div class="menu-icon parent"><i data-lucide="log-in" style="width:18px;height:18px;"></i></div>
            <div class="menu-item-text">
                <div class="menu-item-title">Parent Login</div>
                <div class="menu-item-sub">Sign in to your account</div>
            </div>
            <i data-lucide="chevron-right" style="width:16px;height:16px;color:#94a3b8;"></i>
        </a>

        <div class="menu-divider"></div>
        <div class="menu-section-label">Admin Portal</div>

        <a href="/admin/login" class="menu-item">
            <div class="menu-icon admin"><i data-lucide="shield" style="width:18px;height:18px;"></i></div>
            <div class="menu-item-text">
                <div class="menu-item-title">Admin Login</div>
                <div class="menu-item-sub">Access admin dashboard</div>
            </div>
            <i data-lucide="chevron-right" style="width:16px;height:16px;color:#94a3b8;"></i>
        </a>
    </div>
    <div class="side-menu-footer">
        <div class="contact-card">
            <h4><i data-lucide="headphones" style="width:14px;height:14px;"></i> Contact Support</h4>
            <a href="tel:0708295236" class="contact-item">
                <div class="contact-icon phone"><i data-lucide="phone" style="width:14px;height:14px;"></i></div>
                0708295236
            </a>
            <a href="mailto:malonzazakayo23@gmail.com" class="contact-item">
                <div class="contact-icon mail"><i data-lucide="mail" style="width:14px;height:14px;"></i></div>
                malonzazakayo23@gmail.com
            </a>
        </div>
    </div>
</div>

<!-- NAVBAR -->
<nav>
    <a href="/" class="nav-brand">
        <div class="nav-brand-icon"><i data-lucide="heart" style="width:18px;height:18px;"></i></div>
        <span class="nav-brand-text">Diligent <span>Mom</span></span>
    </a>
    <button class="hamburger" id="hamburger" onclick="toggleMenu()">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">
            <i data-lucide="shield-check" style="width:14px;height:14px;"></i>
            Trusted Daycare Management
        </div>
        <h1>Peace of mind <span class="highlight">while you work.</span></h1>
        <p>Diligent Mom Support System looks out for your most precious ones — so you can focus on your work with complete confidence.</p>
        <div class="hero-btns">
            <a href="/parent/register" class="btn-primary">
                <i data-lucide="user-plus" style="width:18px;height:18px;"></i>
                Register as Parent
            </a>
            <a href="/parent/login" class="btn-secondary">
                <i data-lucide="log-in" style="width:18px;height:18px;"></i>
                Sign In
            </a>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="number">100%</div>
                <div class="label">Secure & Safe</div>
            </div>
            <div class="hero-stat">
                <div class="number">24/7</div>
                <div class="label">Monitoring</div>
            </div>
            <div class="hero-stat">
                <div class="number">M-Pesa</div>
                <div class="label">Payments</div>
            </div>
        </div>
    </div>
    <div class="hero-image">
        <img src="/images/hero.png" alt="Diligent Mom Support System"/>
    </div>
</section>

<!-- FEATURES -->
<section class="features">
    <div class="section-header">
        <div class="section-badge">
            <i data-lucide="star" style="width:14px;height:14px;"></i>
            Why Choose Us
        </div>
        <h2>Everything you need</h2>
        <p>A complete daycare management solution designed for modern Kenyan families</p>
    </div>
    <div class="features-grid">
        <div class="feature-card" style="animation-delay:0.1s">
            <div class="feature-icon-wrap" style="background:#eef2ff;">
                <i data-lucide="shield-check" style="width:26px;height:26px;color:#6366f1;"></i>
            </div>
            <h3>Real-time Safety Monitoring</h3>
            <p>Track your child's check-in and check-out times in real time with instant notifications.</p>
        </div>
        <div class="feature-card" style="animation-delay:0.2s">
            <div class="feature-icon-wrap" style="background:#fff1f2;">
                <i data-lucide="bell" style="width:26px;height:26px;color:#f43f5e;"></i>
            </div>
            <h3>Instant Alerts</h3>
            <p>Get notified the moment your child arrives or leaves the daycare facility.</p>
        </div>
        <div class="feature-card" style="animation-delay:0.3s">
            <div class="feature-icon-wrap" style="background:#ecfdf5;">
                <i data-lucide="users" style="width:26px;height:26px;color:#10b981;"></i>
            </div>
            <h3>Trusted Care Network</h3>
            <p>Connect with a verified network of professional and caring staff members.</p>
        </div>
        <div class="feature-card" style="animation-delay:0.4s">
            <div class="feature-icon-wrap" style="background:#fffbeb;">
                <i data-lucide="bar-chart-2" style="width:26px;height:26px;color:#f59e0b;"></i>
            </div>
            <h3>Activity Reports</h3>
            <p>Access detailed daily reports on your child's activities and wellbeing.</p>
        </div>
        <div class="feature-card" style="animation-delay:0.5s">
            <div class="feature-icon-wrap" style="background:#f0fdf4;">
                <i data-lucide="smartphone" style="width:26px;height:26px;color:#22c55e;"></i>
            </div>
            <h3>M-Pesa Payments</h3>
            <p>Pay securely and conveniently via M-Pesa or cash with instant confirmation.</p>
        </div>
        <div class="feature-card" style="animation-delay:0.6s">
            <div class="feature-icon-wrap" style="background:#faf5ff;">
                <i data-lucide="heart" style="width:26px;height:26px;color:#a855f7;"></i>
            </div>
            <h3>Special Needs Support</h3>
            <p>Dedicated support and care for children with disabilities and allergies.</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <div class="cta-content">
        <h2>Ready to get started?</h2>
        <p>Join families who trust Diligent Mom Support System with their most precious ones</p>
        <div class="cta-btns">
            <a href="/parent/register" class="btn-white">
                <i data-lucide="user-plus" style="width:18px;height:18px;color:#6366f1;"></i>
                Register as Parent
            </a>
            <a href="/admin/login" class="btn-outline">
                <i data-lucide="shield" style="width:18px;height:18px;"></i>
                Admin Login
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>2026 Diligent Mom Support System. All rights reserved.</p>
    <div class="footer-links">
        <a href="tel:0708295236">
            <i data-lucide="phone" style="width:14px;height:14px;"></i>
            0708295236
        </a>
        <a href="mailto:malonzazakayo23@gmail.com">
            <i data-lucide="mail" style="width:14px;height:14px;"></i>
            malonzazakayo23@gmail.com
        </a>
    </div>
</footer>

<script>
    function toggleMenu() {
        document.getElementById('sideMenu').classList.toggle('open');
        document.getElementById('overlay').classList.toggle('open');
        document.getElementById('hamburger').classList.toggle('open');
    }
    function closeMenu() {
        document.getElementById('sideMenu').classList.remove('open');
        document.getElementById('overlay').classList.remove('open');
        document.getElementById('hamburger').classList.remove('open');
    }
    lucide.createIcons();
</script>
</body>
</html>