<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Paket Belajar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f9f8ff; color: #1a1a2e; }

        /* Navbar */
        .navbar {
            background: white;
            border-bottom: 1px solid #e8e4ff;
            padding: 0 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-logo { font-size: 1.4rem; font-weight: 800; color: #5b21b6; text-decoration: none; }
        .navbar-links { display: flex; gap: 2rem; align-items: center; }
        .navbar-links a { text-decoration: none; color: #6b7280; font-size: 0.9rem; font-weight: 500; transition: color 0.2s; }
        .navbar-links a:hover, .navbar-links a.active { color: #5b21b6; }
        .navbar-right { display: flex; align-items: center; gap: 1rem; }
        .btn-logout { background: none; border: 1px solid #e5e7eb; color: #6b7280; padding: 0.4rem 1rem; border-radius: 0.5rem; cursor: pointer; font-size: 0.875rem; font-family: inherit; transition: all 0.2s; }
        .btn-logout:hover { border-color: #ef4444; color: #ef4444; }

        /* Hero */
        .hero {
            max-width: 1100px;
            margin: 0 auto;
            padding: 4rem 2rem 2rem;
        }
        .hero-tag { font-size: 0.75rem; font-weight: 600; color: #7c3aed; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 1rem; }
        .hero-title { font-size: 3rem; font-weight: 800; line-height: 1.15; color: #1a1a2e; margin-bottom: 1rem; }
        .hero-title span { color: #a78bfa; }
        .hero-subtitle { font-size: 1rem; color: #6b7280; max-width: 480px; line-height: 1.7; margin-bottom: 0.5rem; }

        @if(session('success'))
        /* handled inline */
        @endif

        /* Alert */
        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 1rem 1.5rem;
            border-radius: 0.75rem;
            margin: 0 auto 1.5rem;
            max-width: 1100px;
            padding-left: 2rem;
            padding-right: 2rem;
        }

        /* Pricing Cards */
        .pricing-section { max-width: 1100px; margin: 0 auto; padding: 2rem; }
        .pricing-grid {
            display: grid;
            grid-template-columns: 1fr 1.15fr 1fr;
            gap: 1.5rem;
            align-items: start;
        }
        .pricing-card {
            background: white;
            border-radius: 1.25rem;
            padding: 2.5rem;
            border: 1.5px solid #e8e4ff;
            position: relative;
        }
        .pricing-card.popular {
            background: #3b0764;
            color: white;
            border-color: #3b0764;
            transform: scale(1.02);
        }
        .popular-badge {
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #fbbf24;
            color: #78350f;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.3rem 1rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .card-icon { font-size: 1.5rem; margin-bottom: 1rem; }
        .card-name { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.25rem; }
        .card-desc { font-size: 0.8rem; color: #9ca3af; margin-bottom: 1.5rem; }
        .pricing-card.popular .card-desc { color: #c4b5fd; }
        .price { font-size: 2.5rem; font-weight: 800; margin-bottom: 0.25rem; }
        .price span { font-size: 1rem; font-weight: 400; color: #9ca3af; }
        .pricing-card.popular .price span { color: #c4b5fd; }
        .price-period { font-size: 0.8rem; color: #9ca3af; margin-bottom: 2rem; }
        .pricing-card.popular .price-period { color: #c4b5fd; }
        .feature-list { list-style: none; margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.75rem; }
        .feature-list li { font-size: 0.875rem; display: flex; align-items: flex-start; gap: 0.5rem; }
        .feature-list li .check { color: #10b981; flex-shrink: 0; margin-top: 1px; }
        .feature-list li .cross { color: #9ca3af; flex-shrink: 0; margin-top: 1px; }
        .pricing-card.popular .feature-list li { color: #e9d5ff; }
        .pricing-card.popular .feature-list li .check { color: #a78bfa; }
        .btn-plan {
            display: block;
            width: 100%;
            padding: 0.85rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            font-family: inherit;
        }
        .btn-free { background: #f3f0ff; color: #5b21b6; }
        .btn-free:hover { background: #ede9fe; }
        .btn-popular { background: #fbbf24; color: #1a1a2e; }
        .btn-popular:hover { background: #f59e0b; }
        .btn-enterprise { background: #3b0764; color: white; }
        .btn-enterprise:hover { background: #4c1d95; }
        .btn-current { background: #d1fae5; color: #065f46; cursor: not-allowed; }

        /* Comparison Table */
        .comparison-section { max-width: 1100px; margin: 3rem auto; padding: 0 2rem; }
        .comparison-title { text-align: center; font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem; }
        .comparison-sub { text-align: center; color: #6b7280; font-size: 0.9rem; margin-bottom: 2.5rem; }
        .comparison-table { width: 100%; border-collapse: collapse; background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 1px 8px rgba(0,0,0,0.06); }
        .comparison-table th { padding: 1.25rem 1.5rem; text-align: left; font-size: 0.8rem; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.08em; background: #f9fafb; border-bottom: 1px solid #f3f4f6; }
        .comparison-table th.highlight { color: #7c3aed; background: #faf5ff; }
        .comparison-table td { padding: 1.1rem 1.5rem; border-bottom: 1px solid #f3f4f6; font-size: 0.875rem; }
        .comparison-table tr:last-child td { border-bottom: none; }
        .comparison-table td:first-child { color: #374151; font-weight: 500; }
        .comparison-table td.cap-desc { color: #9ca3af; font-size: 0.75rem; display: block; margin-top: 0.1rem; }
        .comparison-table td .val-free { color: #6b7280; }
        .comparison-table td .val-pro { color: #7c3aed; font-weight: 600; }
        .comparison-table td .val-dash { color: #d1d5db; }
        .check-icon { color: #10b981; font-size: 1.1rem; }

        /* Stats Section */
        .stats-section { max-width: 1100px; margin: 3rem auto 4rem; padding: 0 2rem; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 1.5rem; align-items: center; }
        .stats-editorial { background: #1a1a2e; color: white; border-radius: 1.25rem; padding: 2rem; display: flex; align-items: center; gap: 1.5rem; }
        .stats-editorial-icon { font-size: 2.5rem; }
        .stats-editorial h3 { font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem; }
        .stats-editorial p { font-size: 0.8rem; color: #9ca3af; line-height: 1.5; }
        .stat-card { border-radius: 1.25rem; padding: 2rem; text-align: center; }
        .stat-card.green { background: #ecfdf5; }
        .stat-card.yellow { background: #fffbeb; }
        .stat-number { font-size: 2.25rem; font-weight: 800; margin-bottom: 0.25rem; }
        .stat-card.green .stat-number { color: #059669; }
        .stat-card.yellow .stat-number { color: #d97706; }
        .stat-label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: #6b7280; }

        /* Footer */
        footer { background: white; border-top: 1px solid #e8e4ff; padding: 1.5rem 3rem; display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; color: #9ca3af; }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { color: #9ca3af; text-decoration: none; }
        .footer-links a:hover { color: #5b21b6; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-logo">Intellecta</a>
        <div class="navbar-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('subscription.index') }}" class="active">Resources</a>
            <a href="{{ route('student.quizzes.index') }}">Kuis Saya</a>
        </div>
        <div class="navbar-right">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Keluar</button>
            </form>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert-success" style="margin-top: 1rem;">✅ {{ session('success') }}</div>
    @endif

    <!-- Hero -->
    <div class="hero">
        <div class="hero-tag">Academic Year 2024</div>
        <h1 class="hero-title">Elevate Your <span>Learning</span><br>Path.</h1>
        <p class="hero-subtitle">Choose the catalyst for your intellectual growth. From fundamental access to premium editorial excellence, our packages are designed for the serious scholar.</p>
    </div>

    <!-- Pricing Cards -->
    <div class="pricing-section">
        <div class="pricing-grid">
            <!-- Free Plan -->
            <div class="pricing-card">
                <div class="card-icon">📚</div>
                <div class="card-name">Basic Access</div>
                <div class="card-desc">Essential tools for curious minds</div>
                <div class="price">Free<span></span></div>
                <div class="price-period">/ forever</div>
                <ul class="feature-list">
                    <li><span class="check">✓</span> Public Course Modules</li>
                    <li><span class="check">✓</span> Standard Study Groups</li>
                    <li><span class="cross">—</span> <span style="color:#9ca3af;">Premium Editorial Content</span></li>
                    <li><span class="cross">—</span> <span style="color:#9ca3af;">Live Teaching Access</span></li>
                    <li><span class="cross">—</span> <span style="color:#9ca3af;">Study Planner</span></li>
                </ul>
                @if(auth()->user()->package === 'free')
                    <button class="btn-plan btn-current" disabled>Paket Saat Ini</button>
                @else
                    <button class="btn-plan btn-free" disabled>Tersedia</button>
                @endif
            </div>

            <!-- Premium Plan -->
            <div class="pricing-card popular">
                <div class="popular-badge">⭐ MOST POPULAR</div>
                <div class="card-icon">🚀</div>
                <div class="card-name">Intellecta Pro</div>
                <div class="card-desc">Complete editorial mastery for leaders</div>
                <div class="price">Rp49k<span> /bulan</span></div>
                <div class="price-period">Bayar simulasi, akses langsung</div>
                <ul class="feature-list">
                    <li><span class="check">✓</span> All Core Modules + Advanced</li>
                    <li><span class="check">✓</span> Private Mentorship Access</li>
                    <li><span class="check">✓</span> Exclusive Editorial Insights</li>
                    <li><span class="check">✓</span> Live Teaching</li>
                    <li><span class="check">✓</span> Study Planner Premium</li>
                </ul>
                @if(auth()->user()->package === 'premium')
                    <button class="btn-plan btn-current" disabled>✓ Aktif</button>
                @else
                    <a href="{{ route('subscription.checkout') }}" class="btn-plan btn-popular" style="text-decoration:none; display:block; text-align:center;">Upgrade ke Pro →</a>
                @endif
            </div>

            <!-- Enterprise -->
            <div class="pricing-card">
                <div class="card-icon">🏛️</div>
                <div class="card-name">Institutions</div>
                <div class="card-desc">Scalable knowledge for departments</div>
                <div class="price">Custom<span></span></div>
                <div class="price-period">/ per seat</div>
                <ul class="feature-list">
                    <li><span class="check">✓</span> Bulk License Management</li>
                    <li><span class="check">✓</span> LMS Integration Support</li>
                    <li><span class="check">✓</span> Dedicated Success Manager</li>
                    <li><span class="check">✓</span> Custom Curriculum</li>
                    <li><span class="check">✓</span> Priority Support 24/7</li>
                </ul>
                <button class="btn-plan btn-enterprise">Contact Sales</button>
            </div>
        </div>
    </div>

    <!-- Comparison Table -->
    <div class="comparison-section">
        <h2 class="comparison-title">Deep Feature Comparison</h2>
        <p class="comparison-sub">The clarity you need to make the right choice.</p>
        <table class="comparison-table">
            <thead>
                <tr>
                    <th style="width:45%;">Capabilities</th>
                    <th>Free</th>
                    <th class="highlight">Intellecta Pro</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Course Library
                        <span class="cap-desc">Access to foundational learning tracks</span>
                    </td>
                    <td><span class="val-free">10 Basic Tracks</span></td>
                    <td><span class="val-pro">Unlimited Access</span></td>
                </tr>
                <tr>
                    <td>
                        Kuis & Evaluasi
                        <span class="cap-desc">Test your understanding with quizzes</span>
                    </td>
                    <td><span class="val-free">Basic Quizzes</span></td>
                    <td><span class="val-pro">All Quizzes + Analytics</span></td>
                </tr>
                <tr>
                    <td>
                        Peer Networking
                        <span class="cap-desc">Connect with fellow students globally</span>
                    </td>
                    <td><span class="val-free">Public Channels</span></td>
                    <td><span class="val-pro">Elite Circles Only</span></td>
                </tr>
                <tr>
                    <td>
                        Live Teaching
                        <span class="cap-desc">Join live sessions with instructors</span>
                    </td>
                    <td><span class="val-dash">—</span></td>
                    <td><span class="check-icon">✓</span></td>
                </tr>
                <tr>
                    <td>
                        Study Planner
                        <span class="cap-desc">Plan and track your learning schedule</span>
                    </td>
                    <td><span class="val-dash">—</span></td>
                    <td><span class="check-icon">✓</span></td>
                </tr>
                <tr>
                    <td>
                        Progress Milestones
                        <span class="cap-desc">Track mastery and goal setting</span>
                    </td>
                    <td><span class="val-free">Standard</span></td>
                    <td><span class="val-pro">Gold-Tier Rewards</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Stats -->
    <div class="stats-section">
        <div class="stats-editorial">
            <div class="stats-editorial-icon">💻</div>
            <div>
                <h3>Editorial Excellence</h3>
                <p>Every course is hand-curated by industry-leading intellectuals to ensure peer-academic quality.</p>
            </div>
        </div>
        <div class="stat-card green">
            <div class="stat-number">98%</div>
            <div class="stat-label">Success Rate</div>
        </div>
        <div class="stat-card yellow">
            <div class="stat-number">50k+</div>
            <div class="stat-label">Active Scholars</div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div>Intellecta © 2024 Intellecta Indonesia. Cerdas & Fokus.</div>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Accessibility</a>
        </div>
    </footer>

</body>
</html>
