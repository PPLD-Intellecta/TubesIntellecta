<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Dashboard</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Logo -->
            <div class="sidebar-logo">
                Intellecta
            </div>
            <div class="sidebar-subtitle">Smart Learning</div>

            <!-- Navigation Menu -->
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-menu-link active">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('student.quizzes.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/>
                        </svg>
                        Kuis & Evaluasi
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('subscription.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11.5 2C6.81 2 3 5.81 3 10.5S6.81 19 11.5 19h.5v3c4.86-2.34 8-7 8-11.5C20 5.81 16.19 2 11.5 2zm1 14.5h-2v-2h2v2zm0-4h-2c0-3.25 3-3 3-5 0-1.1-.9-2-2-2s-2 .9-2 2h-2c0-2.21 1.79-4 4-4s4 1.79 4 4c0 2.5-3 2.75-3 5z"/>
                        </svg>
                        Paket Belajar
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('student.feedbacks.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4 4h16v12H5.17L4 17.17V4zm2 2v6h12V6H6zm0 8h8v2H6v-2z"/>
                        </svg>
                        Feedback
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('student.videos.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4z"/>
                        </svg>
                        Materi Video
                    </a>
                </li>
                <li class="sidebar-menu-item" style="margin-top: 2rem;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-menu-link" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer; color: #ef4444;">
                            <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24" style="color: #ef4444;">
                                <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="content-header">
                @if(session('error'))
                    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="greeting">
                    Halo, {{ auth()->user()->name ?? 'Aluna' }} 👋 
                    <span style="font-size: 0.875rem; padding: 0.25rem 0.5rem; background: {{ auth()->user()->package === 'premium' ? '#7c3aed' : '#9ca3af' }}; color: white; border-radius: 0.25rem; vertical-align: middle; margin-left: 0.5rem;">
                        {{ strtoupper(auth()->user()->package ?? 'FREE') }}
                    </span>
                </div>
                <div class="greeting-subtitle">Mari lanjutkan perjalanan belajarmu hari ini.</div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Left Column -->
                <div>
                    <!-- Stress Card -->
                    <div class="stress-card" style="margin-bottom: 2rem;">
                        <div class="stress-icon">⚡</div>
                        <div class="stress-value">12</div>
                        <div class="stress-label">HARI</div>
                        <div class="stress-description">Stress Belajar</div>
                    </div>

                    <!-- Chart -->
                    <div class="chart-container">
                        <div class="chart-title">Progres Belajar Mingguan</div>
                        <div class="chart-bars">
                            <div class="bar-group">
                                <div class="bar" style="height: 80px;"></div>
                                <div class="bar-label">MIN</div>
                            </div>
                            <div class="bar-group">
                                <div class="bar" style="height: 100px;"></div>
                                <div class="bar-label">SEL</div>
                            </div>
                            <div class="bar-group">
                                <div class="bar active" style="height: 160px;"></div>
                                <div class="bar-label">RAB</div>
                            </div>
                            <div class="bar-group">
                                <div class="bar" style="height: 120px;"></div>
                                <div class="bar-label">KAM</div>
                            </div>
                            <div class="bar-group">
                                <div class="bar" style="height: 90px;"></div>
                                <div class="bar-label">JUM</div>
                            </div>
                            <div class="bar-group">
                                <div class="bar" style="height: 70px;"></div>
                                <div class="bar-label">SAB</div>
                            </div>
                            <div class="bar-group">
                                <div class="bar" style="height: 60px;"></div>
                                <div class="bar-label">MIN</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div>
                    <!-- Health Summary Card -->
                    <div class="health-card">
                        <div class="card-title">Ringkasan Kesihian</div>

                        <div class="stat-item">
                            <span>Fokus Total</span>
                            <span class="stat-percent">47%</span>
                        </div>
                        <div class="stat-item">
                            <span>Focus Target</span>
                            <span class="stat-percent">67%</span>
                        </div>
                        <div class="stat-item">
                            <span>Stress Level</span>
                            <span class="stat-percent">47%</span>
                        </div>

                        <!-- Deadline Section -->
                        <div class="deadline-section">
                            <div class="deadline-title">Deadline Mendatang</div>

                            <div class="deadline-item">
                                <div class="deadline-icon">📄</div>
                                <div class="deadline-text">
                                    <div class="deadline-name">Final Case Study</div>
                                    <div class="deadline-date">23 Sep 2025</div>
                                </div>
                            </div>

                            <div class="deadline-item">
                                <div class="deadline-icon">❓</div>
                                <div class="deadline-text">
                                    <div class="deadline-name">Quiz AP Hasil</div>
                                    <div class="deadline-date">25 Sep 2025</div>
                                </div>
                            </div>

                            <div class="deadline-item">
                                <div class="deadline-icon">📚</div>
                                <div class="deadline-text">
                                    <div class="deadline-name">Susulan Belajar</div>
                                    <div class="deadline-date">30 Sep 2025</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses Section -->
            <div class="courses-section">
                <div class="section-title">Kursus Rekomendasi</div>
                <div class="courses-grid">
                    <!-- Course 1 -->
                    <div class="course-card">
                        <div class="course-image">🎨</div>
                        <div class="course-content">
                            <div class="course-badge">DESAIN    BEGINNER</div>
                            <div class="course-title">Langit UI Desain: Plaster Visual</div>
                            <div class="course-description">Pelajari konsep dasar desain visual modern dengan praktik langsung menggunakan tools industri.</div>
                            <button class="btn-course">Lihat Belajar</button>
                        </div>
                    </div>

                    <!-- Course 2 -->
                    <div class="course-card">
                        <div class="course-image code">const data = await fetch('/api')
response.json()
console.log(data)</div>
                        <div class="course-content">
                            <div class="course-badge">BACKEND    SEMINAL</div>
                            <div class="course-title">Backend Fundamentals</div>
                            <div class="course-description">Belajar dasar-dasar backend development dengan fokus pada API design dan database management.</div>
                            <button class="btn-course">Lihat Belajar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Stress Section -->
            <div class="bottom-stress" style="margin-bottom: 3rem;">
                <div class="stress-card-small">
                    <div class="stress-icon">⚡</div>
                    <div class="stress-value-small">12</div>
                    <div class="stress-label-small">Hari</div>
                    <div class="stress-description">Stress Belajar</div>
                </div>
                <div style="background: white; border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                    <p style="color: #6b7280; font-size: 0.875rem; line-height: 1.5;">
                        <strong style="color: #1f2937;">Manageable levels of stress</strong> are actually beneficial for learning and performance. Your current stress level is in the optimal range for productivity. Keep maintaining this balance!
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="dashboard-footer">
                <div>
                    <div class="footer-logo">Intellecta</div>
                    <div style="font-size: 0.7rem; color: #9ca3af;">© 2024 Intellecta Indonesia, Learning Hub CPDI Sai Universitas Urbanus</div>
                </div>
                <div class="footer-links">
                    <a href="#">Kebijakan Privasi</a>
                    <a href="#">Syarat & Layanan</a>
                    <a href="#">Hubungi Dukungan</a>
                    <a href="#">Keselamatan</a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
