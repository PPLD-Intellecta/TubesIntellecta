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
                    <a href="#" class="sidebar-menu-link active">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54h5.01L11.31 8.5"/>
                        </svg>
                        Tugas
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                        Sumber Daya
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                        </svg>
                        Pesan
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="content-header">
                <div class="greeting">Halo, Aluna 👋</div>
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
