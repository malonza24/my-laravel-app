<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diligent Mom Support System</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #fff; color: #1a202c; }

        /* NAVBAR */
        nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            background: white;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            z-index: 1000;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .nav-brand h1 {
            font-size: 20px;
            color: #1a2a5e;
            font-weight: 800;
        }
        .nav-brand h1 span { color: #e8386d; }
        .nav-brand p { font-size: 11px; color: #888; letter-spacing: 2px; text-transform: uppercase; }

        /* HAMBURGER */
        .hamburger {
            display: flex;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .hamburger:hover { background: #f0f2f5; }
        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: #1a2a5e;
            border-radius: 2px;
            transition: all 0.3s;
        }
        .hamburger.open span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: rotate(-45deg) translate(5px, -5px); }

        /* SIDE MENU */
        .side-menu {
            position: fixed;
            top: 0; right: -320px;
            width: 300px;
            height: 100vh;
            background: white;
            box-shadow: -4px 0 24px rgba(0,0,0,0.12);
            z-index: 2000;
            transition: right 0.3s ease;
            padding: 80px 32px 32px;
            display: flex;
            flex-direction: column;
        }
        .side-menu.open { right: 0; }
        .side-menu .close-btn {
            position: absolute;
            top: 20px; right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: #888;
            background: none;
            border: none;
        }
        .side-menu h3 { font-size: 13px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }
        .side-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: #1a202c;
            font-size: 15px;
            font-weight: 500;
            transition: background 0.2s;
            margin-bottom: 6px;
        }
        .side-menu a:hover { background: #f0f2f5; }
        .side-menu a .icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .icon-parent { background: #fff0f5; }
        .icon-admin { background: #f0f4ff; }
        .icon-phone { background: #f0fff4; }
        .icon-email { background: #fff8f0; }
        .side-menu .divider { height: 1px; background: #f0f0f0; margin: 16px 0; }
        .side-menu .contact-title { font-size: 13px; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1500;
        }
        .overlay.open { display: block; }

        /* HERO */
        .hero {
            margin-top: 72px;
            min-height: calc(100vh - 72px);
            display: flex;
            align-items: center;
            padding: 60px 40px;
            background: linear-gradient(135deg, #fff5f8 0%, #f0f4ff 100%);
        }
        .hero-content {
            flex: 1;
            max-width: 560px;
        }
        .hero-badge {
            display: inline-block;
            background: #fff0f5;
            color: #e8386d;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .hero h1 {
            font-size: 48px;
            font-weight: 800;
            color: #1a2a5e;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        .hero h1 span { color: #e8386d; }
        .hero p {
            font-size: 17px;
            color: #555;
            line-height: 1.7;
            margin-bottom: 32px;
        }
        .hero-btns { display: flex; gap: 16px; flex-wrap: wrap; }
        .btn-primary {
            padding: 14px 28px;
            background: linear-gradient(135deg, #e8386d, #f093fb);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: opacity 0.2s;
            box-shadow: 0 4px 16px rgba(232,56,109,0.3);
        }
        .btn-primary:hover { opacity: 0.9; }
        .btn-secondary {
            padding: 14px 28px;
            background: white;
            color: #1a2a5e;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            border: 2px solid #e0e0e0;
            transition: border-color 0.2s;
        }
        .btn-secondary:hover { border-color: #1a2a5e; }
        .hero-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-left: 40px;
        }
        .hero-image img {
            width: 100%;
            max-width: 600px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        }

        /* FEATURES */
        .features {
            padding: 80px 40px;
            background: white;
        }
        .features h2 { text-align: center; font-size: 32px; color: #1a2a5e; margin-bottom: 12px; }
        .features p.subtitle { text-align: center; color: #888; font-size: 16px; margin-bottom: 48px; }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 24px;
            max-width: 1000px;
            margin: 0 auto;
        }
        .feature-card {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 28px 24px;
            text-align: center;
            transition: transform 0.2s;
        }
        .feature-card:hover { transform: translateY(-4px); }
        .feature-card .icon { font-size: 36px; margin-bottom: 14px; }
        .feature-card h3 { font-size: 16px; color: #1a2a5e; margin-bottom: 8px; }
        .feature-card p { font-size: 13px; color: #888; line-height: 1.6; }

        /* CTA */
        .cta {
            padding: 80px 40px;
            background: linear-gradient(135deg, #1a2a5e, #2d3748);
            text-align: center;
        }
        .cta h2 { font-size: 32px; color: white; margin-bottom: 12px; }
        .cta p { color: rgba(255,255,255,0.7); font-size: 16px; margin-bottom: 32px; }
        .cta-btns { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        .btn-white {
            padding: 14px 28px;
            background: white;
            color: #1a2a5e;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            transition: opacity 0.2s;
        }
        .btn-white:hover { opacity: 0.9; }
        .btn-outline-white {
            padding: 14px 28px;
            background: transparent;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 600;
            border: 2px solid rgba(255,255,255,0.5);
        }
        .btn-outline-white:hover { border-color: white; }

        /* FOOTER */
        footer {
            background: #1a202c;
            padding: 24px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        footer p { color: rgba(255,255,255,0.5); font-size: 13px; }
        footer a { color: rgba(255,255,255,0.5); text-decoration: none; font-size: 13px; }
        footer a:hover { color: white; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero { flex-direction: column; padding: 40px 20px; }
            .hero h1 { font-size: 32px; }
            .hero-image { padding-left: 0; margin-top: 32px; }
            .features { padding: 60px 20px; }
            .cta { padding: 60px 20px; }
            nav { padding: 16px 20px; }
            footer { padding: 20px; flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>

<!-- OVERLAY -->
<div class="overlay" id="overlay" onclick="closeMenu()"></div>

<!-- SIDE MENU -->
<div class="side-menu" id="sideMenu">
    <button class="close-btn" onclick="closeMenu()">✕</button>

    <h3>Portal Access</h3>

    <a href="/parent/register">
        <div class="icon icon-parent">👩</div>
        Parent Register
    </a>
    <a href="/parent/login">
        <div class="icon icon-parent">🔑</div>
        Parent Login
    </a>
    <a href="/admin/register">
        <div class="icon icon-admin">⚙️</div>
        Admin Register
    </a>
    <a href="/admin/login">
        <div class="icon icon-admin">🔐</div>
        Admin Login
    </a>

    <div class="divider"></div>
    <div class="contact-title">Contact Support</div>

    <a href="tel:0708295236">
        <div class="icon icon-phone">📞</div>
        0708295236
    </a>
    <a href="mailto:malonzazakayo23@gmail.com">
        <div class="icon icon-email">✉️</div>
        malonzazakayo23@gmail.com
    </a>
</div>

<!-- NAVBAR -->
<nav>
    <div class="nav-brand">
        <div>
            <h1>DILIGENT <span>MOM</span></h1>
            <p>Support System</p>
        </div>
    </div>
    <div class="hamburger" id="hamburger" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-content">
        <div class="hero-badge">🛡️ Trusted Daycare Management</div>
        <h1>Peace of mind <span>while you work.</span></h1>
        <p>Diligent Mom Support System looks out for your most precious ones — so you can focus on your work with confidence.</p>
        <div class="hero-btns">
            <a href="/parent/register" class="btn-primary">👩 Parent Register</a>
            <a href="/parent/login" class="btn-secondary">Login →</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="/images/hero.png" alt="Diligent Mom Support System"/>
    </div>
</section>

<!-- FEATURES -->
<section class="features">
    <h2>Everything you need</h2>
    <p class="subtitle">A complete daycare management solution for modern families</p>
    <div class="features-grid">
        <div class="feature-card">
            <div class="icon">🔒</div>
            <h3>Real-time Safety Monitoring</h3>
            <p>Track your child's check-in and check-out times in real time.</p>
        </div>
        <div class="feature-card">
            <div class="icon">💬</div>
            <h3>Instant Alerts & Notifications</h3>
            <p>Get notified the moment your child arrives or leaves the daycare.</p>
        </div>
        <div class="feature-card">
            <div class="icon">👨‍👩‍👧</div>
            <h3>Trusted Care Network</h3>
            <p>Connect with a verified network of professional caregivers.</p>
        </div>
        <div class="feature-card">
            <div class="icon">📊</div>
            <h3>Activity & Wellbeing Reports</h3>
            <p>Access detailed reports on your child's daily activities and health.</p>
        </div>
        <div class="feature-card">
            <div class="icon">📱</div>
            <h3>M-Pesa Payments</h3>
            <p>Pay securely and conveniently via M-Pesa with instant confirmation.</p>
        </div>
        <div class="feature-card">
            <div class="icon">♿</div>
            <h3>Special Needs Support</h3>
            <p>Dedicated support for children with disabilities and allergies.</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta">
    <h2>Ready to get started?</h2>
    <p>Join hundreds of families who trust Diligent Mom Support System</p>
    <div class="cta-btns">
        <a href="/parent/register" class="btn-white">👩 Register as Parent</a>
        <a href="/admin/login" class="btn-outline-white">⚙️ Admin Login</a>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>© 2026 Diligent Mom Support System. All rights reserved.</p>
    <div style="display:flex; gap:20px;">
        <a href="tel:0708295236">📞 0708295236</a>
        <a href="mailto:malonzazakayo23@gmail.com">✉️ malonzazakayo23@gmail.com</a>
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
</script>
</body>
</html>