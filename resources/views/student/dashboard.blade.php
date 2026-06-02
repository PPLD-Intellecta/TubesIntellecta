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
            <div class="sidebar-logo">
                Intellecta
            </div>
            <div class="sidebar-subtitle">Smart Learning</div>

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
                    <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.75rem; margin-bottom: 1rem;">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.75rem; margin-bottom: 1rem;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="greeting">
                    Halo, {{ auth()->user()->name ?? 'Student User' }} 👋
                    <span style="font-size: 0.875rem; padding: 0.25rem 0.6rem; background: {{ auth()->user()->package === 'premium' ? '#7c3aed' : '#9ca3af' }}; color: white; border-radius: 0.35rem; vertical-align: middle; margin-left: 0.5rem; font-weight: 700;">
                        {{ strtoupper(auth()->user()->package ?? 'FREE') }}
                    </span>
                </div>
                <div class="greeting-subtitle">Mari lanjutkan perjalanan belajarmu hari ini.</div>
            </div>

<<<<<<< HEAD
            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Left Column -->
                <div>
                    <!-- Stress Card -->
                    <div class="stress-card" style="margin-bottom: 2rem;">
                        <div class="stress-icon">⚡</div>
                        <div class="stress-value">12</div>
                        <div class="stress-label">HARI</div>
                        <div class="stress-description">Streak Belajar</div>
                    </div>
=======
            <!-- Layout Utama Fleksibel -->
            <div style="display: grid; grid-template-columns: minmax(0, 1fr) 320px; gap: 1.5rem; align-items: start;">
                <!-- Kolom Kiri -->
                <div style="display: flex; flex-direction: column; gap: 1.5rem; min-width: 0;">
                    <!-- Streak + Progress -->
                    <div style="display: grid; grid-template-columns: 260px minmax(0, 1fr); gap: 1.5rem; align-items: stretch;">
                        <!-- Streak Belajar -->
                        <div style="background: linear-gradient(180deg, #f5efff 0%, #fbf8ff 100%); border-radius: 1.5rem; padding: 1.5rem; box-shadow: 0 10px 28px rgba(124, 58, 237, 0.10); display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div style="display: flex; align-items: center; gap: 0.85rem; margin-bottom: 1.25rem;">
                                    <div style="width: 52px; height: 52px; border-radius: 1rem; background: #fde047; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; box-shadow: 0 8px 18px rgba(234, 179, 8, 0.25);">
                                        🔥
                                    </div>
>>>>>>> origin/main

                                    <div>
                                        <div style="font-size: 1.05rem; font-weight: 800; color: #1f2937;">
                                            Streak Belajar
                                        </div>
                                        <div style="font-size: 0.8rem; color: #6b7280;">
                                            Fokus & Konsisten
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; align-items: flex-end; gap: 0.4rem; margin-top: 1rem;">
                                    <span style="font-size: 3rem; line-height: 1; font-weight: 900; color: #854d0e;">
                                        {{ $streakDays ?? 0 }}
                                    </span>
                                    <span style="font-size: 1.25rem; font-weight: 800; color: #4b5563; margin-bottom: 0.35rem;">
                                        HARI
                                    </span>
                                </div>

                                <div style="display: flex; gap: 0.45rem; margin: 1.2rem 0 0.85rem;">
                                    <div style="height: 6px; flex: 1; background: #854d0e; border-radius: 999px;"></div>
                                    <div style="height: 6px; flex: 1; background: #854d0e; border-radius: 999px;"></div>
                                    <div style="height: 6px; flex: 1; background: #854d0e; border-radius: 999px;"></div>
                                    <div style="height: 6px; flex: 1; background: #d6c99a; border-radius: 999px;"></div>
                                    <div style="height: 6px; flex: 1; background: #eadfbd; border-radius: 999px;"></div>
                                </div>

                                <div style="font-size: 0.8rem; color: #6b7280;">
                                    Peringkat #5 di kelasmu
                                </div>
                            </div>

                            <div style="background: rgba(255,255,255,0.72); border: 1px solid #f3e8ff; border-radius: 1rem; padding: 0.85rem; margin-top: 1.25rem;">
                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 0.75rem;">
                                    <div>
                                        <div style="font-size: 0.78rem; color: #6b7280; font-weight: 700;">
                                            Target Mingguan
                                        </div>
                                        <div style="font-size: 0.9rem; color: #1f2937; font-weight: 800; margin-top: 0.15rem;">
                                            {{ $streakDays ?? 0 }} dari 15 hari
                                        </div>
                                    </div>

                                    <div style="width: 42px; height: 42px; border-radius: 0.9rem; background: #fef3c7; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                                        🔥
                                    </div>
                                </div>

                                <div style="width: 100%; height: 7px; background: #eadfbd; border-radius: 999px; overflow: hidden; margin-top: 0.8rem;">
                                    <div style="width: {{ min((($streakDays ?? 0) / 15) * 100, 100) }}%; height: 100%; background: #854d0e; border-radius: 999px;"></div>
                                </div>

                                <div style="font-size: 0.72rem; color: #6b7280; margin-top: 0.55rem;">
                                    Sisa {{ max(15 - ($streakDays ?? 0), 0) }} hari menuju target mingguan.
                                </div>
                            </div>
                        </div>

                        <!-- Progress Mingguan + History Belajar -->
                        <div style="background: #ffffff; border-radius: 1.5rem; padding: 1.5rem; box-shadow: 0 10px 28px rgba(0,0,0,0.06);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                <div>
                                    <h3 style="font-size: 1.2rem; font-weight: 800; color: #1f2937; margin: 0;">
                                        Progres Belajar Mingguan
                                    </h3>
                                    <div style="font-size: 0.82rem; color: #6b7280; margin-top: 0.25rem;">
                                        Ringkasan aktivitas belajar minggu ini
                                    </div>
                                </div>

                                <span style="font-size: 0.82rem; color: #7c3aed; font-weight: 800;">
                                    ● Minggu Ini
                                </span>
                            </div>

                            <!-- Chart Bar Dinamis -->
                            <div style="display: flex; align-items: flex-end; justify-content: space-between; gap: 0.75rem; height: 175px; margin-top: 1rem;">
                                @foreach($weeklyProgress as $day)
                                    <div style="flex: 1; text-align: center;">
                                        <div title="{{ $day['total'] }} aktivitas"
                                            style="
                                                height: {{ $day['height'] }}px;
                                                background: {{ $day['is_active'] ? '#7c3aed' : '#e9ddfb' }};
                                                border-radius: 12px 12px 0 0;
                                                box-shadow: {{ $day['is_active'] ? '0 10px 22px rgba(124, 58, 237, 0.22)' : 'none' }};
                                                transition: 0.3s;
                                            ">
                                        </div>

                                        <div style="
                                            margin-top: 0.55rem;
                                            font-size: 0.75rem;
                                            color: {{ $day['is_active'] ? '#7c3aed' : '#6b7280' }};
                                            font-weight: {{ $day['is_active'] ? '800' : '500' }};
                                        ">
                                            {{ $day['label'] }}
                                        </div>

                                        <div style="font-size: 0.68rem; color: #9ca3af; margin-top: 0.15rem;">
                                            {{ $day['total'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- History Belajar Summary -->
                            <div style="margin-top: 1.5rem; background: linear-gradient(180deg, #fcfbff 0%, #f8f5ff 100%); border: 1px solid #efe7ff; border-radius: 1.25rem; padding: 1.25rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                                    <div>
                                        <div style="font-size: 1.05rem; font-weight: 800; color: #1f2937;">
                                            History Belajar
                                        </div>
                                        <div style="font-size: 0.8rem; color: #6b7280;">
                                            Berdasarkan quiz yang sudah dikerjakan
                                        </div>
                                    </div>

                                    <div style="background: #ede9fe; color: #7c3aed; padding: 0.5rem 0.85rem; border-radius: 999px; font-size: 0.82rem; font-weight: 800; white-space: nowrap;">
                                        Progress {{ $progressPercentage ?? 0 }}%
                                    </div>
                                </div>

                                <div style="width: 100%; height: 10px; background: #e9ddfb; border-radius: 999px; overflow: hidden; margin-bottom: 1rem;">
                                    <div style="width: {{ $progressPercentage ?? 0 }}%; height: 100%; background: linear-gradient(90deg, #7c3aed, #a855f7); border-radius: 999px;"></div>
                                </div>

                                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.85rem;">
                                    <div style="background: #ffffff; border: 1px solid #f0eaff; border-radius: 1rem; padding: 0.85rem; text-align: center;">
                                        <div style="font-size: 1.25rem; font-weight: 900; color: #1f2937;">
                                            {{ $completedQuizzes ?? 0 }}/{{ $totalQuizzes ?? 0 }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #6b7280;">
                                            Quiz Dikerjakan
                                        </div>
                                    </div>

                                    <div style="background: #ffffff; border: 1px solid #f0eaff; border-radius: 1rem; padding: 0.85rem; text-align: center;">
                                        <div style="font-size: 1.25rem; font-weight: 900; color: #1f2937;">
                                            {{ $averageScore ?? 0 }}%
                                        </div>
                                        <div style="font-size: 0.75rem; color: #6b7280;">
                                            Rata-rata Nilai
                                        </div>
                                    </div>

                                    <div style="background: #ffffff; border: 1px solid #f0eaff; border-radius: 1rem; padding: 0.85rem; text-align: center;">
                                        <div style="font-size: 1.25rem; font-weight: 900; color: #1f2937;">
                                            {{ isset($learningHistories) ? $learningHistories->count() : 0 }}
                                        </div>
                                        <div style="font-size: 0.75rem; color: #6b7280;">
                                            Aktivitas
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat Aktivitas -->
                    <div style="background: #ffffff; border-radius: 1.5rem; padding: 1.5rem; box-shadow: 0 10px 28px rgba(0,0,0,0.06);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                            <div>
                                <h3 style="font-size: 1.2rem; font-weight: 800; color: #1f2937; margin: 0;">
                                    Riwayat Aktivitas
                                </h3>
                                <div style="font-size: 0.85rem; color: #6b7280; margin-top: 0.25rem;">
                                    Aktivitas quiz terbaru siswa
                                </div>
                            </div>

                            <div style="background: #f3f0ff; color: #7c3aed; padding: 0.55rem 0.9rem; border-radius: 999px; font-size: 0.85rem; font-weight: 800;">
                                {{ isset($learningHistories) ? $learningHistories->count() : 0 }} Aktivitas
                            </div>
                        </div>

                        @if(isset($learningHistories) && $learningHistories->count() > 0)
                            <div style="display: flex; flex-direction: column; gap: 0.85rem;">
                                @foreach($learningHistories as $history)
                                    <div style="background: #faf7ff; border: 1px solid #ede9fe; border-radius: 1rem; padding: 1rem 1.1rem; display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                                        <div style="display: flex; align-items: center; gap: 0.85rem;">
                                            <div style="width: 44px; height: 44px; border-radius: 0.9rem; background: #ede9fe; display: flex; align-items: center; justify-content: center; font-size: 1.15rem; flex-shrink: 0;">
                                                📝
                                            </div>

                                            <div>
                                                <div style="font-size: 0.95rem; font-weight: 800; color: #1f2937;">
                                                    {{ $history->quiz->title ?? 'Quiz Tidak Ditemukan' }}
                                                </div>
                                                <div style="font-size: 0.78rem; color: #6b7280; margin-top: 0.2rem;">
                                                    Dikerjakan pada {{ $history->created_at->format('d M Y, H:i') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div style="background: #7c3aed; color: #ffffff; padding: 0.48rem 0.8rem; border-radius: 999px; font-size: 0.85rem; font-weight: 800; white-space: nowrap;">
                                            Nilai {{ $history->score }}%
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="background: #f9fafb; border-radius: 1.2rem; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 44px; height: 44px; border-radius: 0.9rem; background: #ede9fe; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                                    📭
                                </div>

                                <div>
                                    <div style="font-size: 0.95rem; font-weight: 800; color: #1f2937;">
                                        Belum ada riwayat belajar
                                    </div>
                                    <div style="font-size: 0.82rem; color: #6b7280; margin-top: 0.25rem;">
                                        Kerjakan quiz terlebih dahulu agar progress dan riwayat aktivitas belajar muncul.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Reward Belajar -->
                    <div style="background: #ffffff; border-radius: 1.5rem; padding: 1.5rem; box-shadow: 0 10px 28px rgba(0,0,0,0.06);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                            <div>
                                <h3 style="font-size: 1.2rem; font-weight: 800; color: #1f2937; margin: 0;">
                                    Reward Belajar
                                </h3>
                                <div style="font-size: 0.85rem; color: #6b7280; margin-top: 0.25rem;">
                                    Penghargaan berdasarkan pencapaian belajar siswa
                                </div>
                            </div>

                            <div style="background: #fef3c7; color: #92400e; padding: 0.55rem 0.9rem; border-radius: 999px; font-size: 0.85rem; font-weight: 800;">
                                {{ isset($rewards) ? count($rewards) : 0 }} Reward
                            </div>
                        </div>

                        @if(isset($rewards) && count($rewards) > 0)
                            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem;">
                                @foreach($rewards as $reward)
                                    <div style="background: linear-gradient(135deg, #fff7ed, #faf7ff); border: 1px solid #f3e8ff; border-radius: 1.2rem; padding: 1rem; display: flex; align-items: center; gap: 1rem;">
                                        <div style="width: 52px; height: 52px; border-radius: 1rem; background: #fef3c7; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0;">
                                            {{ $reward['icon'] }}
                                        </div>

                                        <div>
                                            <div style="font-size: 0.95rem; font-weight: 800; color: #1f2937;">
                                                {{ $reward['title'] }}
                                            </div>
                                            <div style="font-size: 0.78rem; color: #6b7280; margin-top: 0.25rem;">
                                                {{ $reward['description'] }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div style="background: #f9fafb; border-radius: 1.2rem; padding: 1rem 1.25rem; display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 44px; height: 44px; border-radius: 0.9rem; background: #fef3c7; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0;">
                                    🎁
                                </div>

                                <div>
                                    <div style="font-size: 0.95rem; font-weight: 800; color: #1f2937;">
                                        Belum ada reward
                                    </div>
                                    <div style="font-size: 0.82rem; color: #6b7280; margin-top: 0.25rem;">
                                        Selesaikan quiz atau capai target belajar untuk mendapatkan reward.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Courses Section -->
                    <div class="courses-section">
                        <div class="section-title">Kursus Rekomendasi</div>

                        <div class="courses-grid">
                            <div class="course-card">
                                <div class="course-image">
                                    🎨
                                </div>
                                <div class="course-content">
                                    <div class="course-badge">DESAIN BEGINNER</div>
                                    <div class="course-title">Langit UI Desain: Plaster Visual</div>
                                    <div class="course-description">
                                        Pelajari konsep dasar desain visual modern dengan praktik langsung menggunakan tools industri.
                                    </div>
                                    <a href="#" class="course-button">Lihat Belajar</a>
                                </div>
                            </div>

                            <div class="course-card">
                                <div class="course-image" style="background: #1f2937; color: #10b981; font-family: monospace; font-size: 0.875rem;">
                                    const data = await fetch('/api')
                                    response.json()
                                </div>
                                <div class="course-content">
                                    <div class="course-badge">BACKEND SEMINAL</div>
                                    <div class="course-title">Backend Fundamentals</div>
                                    <div class="course-description">
                                        Belajar dasar-dasar backend development dengan fokus pada API design dan database management.
                                    </div>
                                    <a href="#" class="course-button">Lihat Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
            </div>
            
            <!-- History Belajar -->
            <div class="courses-section">
                <div class="section-title">Pencapaian & Riwayat Belajar</div>

                <div class="courses-grid">
                    <!-- History Belajar + Progress Tracking Card -->
                    <div class="course-card">
                        <div class="course-content">
                            <div class="course-badge">HISTORY BELAJAR</div>
                            <div class="course-title">Progress Belajar Siswa</div>
                            <div class="course-description">
                                Sistem menampilkan riwayat aktivitas dan persentase progres belajar siswa berdasarkan aktivitas pembelajaran.
                            </div>

                            <!-- Progress Percentage -->
                            <div style="margin-top: 1.25rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <span style="font-size: 0.875rem; color: #6b7280; font-weight: 600;">Progress Keseluruhan</span>
                                    <span style="font-size: 1.5rem; color: #7c3aed; font-weight: 800;">68%</span>
                                </div>

                                <div style="width: 100%; height: 12px; background: #ede9fe; border-radius: 999px; overflow: hidden;">
                                    <div style="width: 68%; height: 100%; background: linear-gradient(90deg, #7c3aed, #a855f7); border-radius: 999px;"></div>
                                </div>
                            </div>

                            <!-- Progress Summary -->
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; margin-top: 1rem;">
                                <div style="background: #faf7ff; padding: 0.875rem; border-radius: 0.875rem; text-align: center;">
                                    <div style="font-size: 1.125rem; font-weight: 800; color: #1f2937;">8/12</div>
                                    <div style="font-size: 0.75rem; color: #6b7280;">Materi Selesai</div>
                                </div>

                                <div style="background: #faf7ff; padding: 0.875rem; border-radius: 0.875rem; text-align: center;">
                                    <div style="font-size: 1.125rem; font-weight: 800; color: #1f2937;">5/7</div>
                                    <div style="font-size: 0.75rem; color: #6b7280;">Quiz Selesai</div>
                                </div>

                                <div style="background: #faf7ff; padding: 0.875rem; border-radius: 0.875rem; text-align: center;">
                                    <div style="font-size: 1.125rem; font-weight: 800; color: #1f2937;">3</div>
                                    <div style="font-size: 0.75rem; color: #6b7280;">Reward</div>
                                </div>
                            </div>

                            <!-- History List -->
                            <div style="margin-top: 1.5rem;">
                                <div style="font-size: 0.95rem; font-weight: 700; color: #1f2937; margin-bottom: 0.875rem;">
                                    Riwayat Aktivitas Terbaru
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                    <div style="display: flex; justify-content: space-between; gap: 1rem; padding: 0.875rem; background: #ffffff; border: 1px solid #ede9fe; border-left: 4px solid #8b5cf6; border-radius: 0.875rem;">
                                        <div>
                                            <div style="font-size: 0.875rem; font-weight: 700; color: #1f2937;">Menonton Materi</div>
                                            <div style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">Aktivitas belajar hari ini berhasil dicatat.</div>
                                        </div>
                                        <strong style="font-size: 0.8rem; color: #7c3aed; white-space: nowrap;">Selesai</strong>
                                    </div>

                                    <div style="display: flex; justify-content: space-between; gap: 1rem; padding: 0.875rem; background: #ffffff; border: 1px solid #ede9fe; border-left: 4px solid #8b5cf6; border-radius: 0.875rem;">
                                        <div>
                                            <div style="font-size: 0.875rem; font-weight: 700; color: #1f2937;">Mengerjakan Quiz</div>
                                            <div style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">Nilai quiz memperbarui persentase progress belajar.</div>
                                        </div>
                                        <strong style="font-size: 0.8rem; color: #7c3aed; white-space: nowrap;">80%</strong>
                                    </div>

                                    <div style="display: flex; justify-content: space-between; gap: 1rem; padding: 0.875rem; background: #ffffff; border: 1px solid #ede9fe; border-left: 4px solid #8b5cf6; border-radius: 0.875rem;">
                                        <div>
                                            <div style="font-size: 0.875rem; font-weight: 700; color: #1f2937;">Menyelesaikan Modul</div>
                                            <div style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">Progress penyelesaian materi bertambah.</div>
                                        </div>
                                        <strong style="font-size: 0.8rem; color: #7c3aed; white-space: nowrap;">100%</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Streak + Reward Card -->
                    <div class="course-card">
                        <div class="course-content">
                            <div class="course-badge">STREAK & REWARD</div>
                            <div class="course-title">Gamifikasi Belajar</div>
                            <div class="course-description">
                                Sistem mencatat konsistensi harian dan memberikan reward ketika siswa mencapai target belajar tertentu.
                            </div>

                            <!-- Streak Box -->
                            <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); padding: 1.25rem; border-radius: 1rem; text-align: center; margin-top: 1.25rem;">
                                <div style="font-size: 2rem;">⚡</div>
                                <div style="font-size: 2rem; font-weight: 800; color: #1f2937;">7</div>
                                <div style="font-size: 0.85rem; color: #92400e; font-weight: 600;">Hari Streak belajar</div>
                            </div>

                            <!-- Reward List -->
                            <div style="margin-top: 1.5rem;">
                                <div style="font-size: 0.95rem; font-weight: 700; color: #1f2937; margin-bottom: 0.875rem;">
                                    Reward yang Didapat
                                </div>

                                <div style="display: grid; grid-template-columns: 1fr; gap: 0.75rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem; background: #fef3c7; padding: 0.875rem; border-radius: 0.875rem;">
                                        <div style="font-size: 1.5rem;">🏅</div>
                                        <div>
                                            <div style="font-size: 0.875rem; font-weight: 700; color: #1f2937;">Streak 7 Hari</div>
                                            <div style="font-size: 0.75rem; color: #6b7280;">Didapat setelah belajar 7 hari berturut-turut.</div>
                                        </div>
                                    </div>

                                    <div style="display: flex; align-items: center; gap: 0.75rem; background: #ede9fe; padding: 0.875rem; border-radius: 0.875rem;">
                                        <div style="font-size: 1.5rem;">🎯</div>
                                        <div>
                                            <div style="font-size: 0.875rem; font-weight: 700; color: #1f2937;">Target Tercapai</div>
                                            <div style="font-size: 0.75rem; color: #6b7280;">Didapat setelah progress belajar mencapai target.</div>
                                        </div>
                                    </div>

                                    <div style="display: flex; align-items: center; gap: 0.75rem; background: #dcfce7; padding: 0.875rem; border-radius: 0.875rem;">
                                        <div style="font-size: 1.5rem;">⭐</div>
                                        <div>
                                            <div style="font-size: 0.875rem; font-weight: 700; color: #1f2937;">Quiz Selesai</div>
                                            <div style="font-size: 0.75rem; color: #6b7280;">Didapat setelah menyelesaikan quiz pembelajaran.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 1.25rem; padding: 0.875rem; background: #f9fafb; border-radius: 0.875rem; font-size: 0.8rem; color: #6b7280; line-height: 1.5;">
                                Reward diberikan setelah sistem memvalidasi pencapaian siswa, seperti menyelesaikan quiz dengan nilai baik atau menjaga streak belajar.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
=======
>>>>>>> origin/main

                <!-- Kolom Kanan -->
                <aside style="position: sticky; top: 1.5rem;">
                    <!-- Ringkasan Keahlian -->
                    <div style="background: linear-gradient(180deg, #7c3aed 0%, #8b5cf6 100%); border-radius: 1.5rem; padding: 1.5rem; color: #ffffff; box-shadow: 0 10px 28px rgba(124, 58, 237, 0.20);">
                        <h3 style="font-size: 1.2rem; font-weight: 800; margin: 0 0 1.5rem;">
                            Ringkasan Keahlian
                        </h3>

                        <div style="margin-bottom: 1.2rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 0.45rem;">
                                <span>UI/UX Design</span>
                                <span>85%</span>
                            </div>
                            <div style="height: 8px; background: rgba(255,255,255,0.22); border-radius: 999px;">
                                <div style="width: 85%; height: 100%; background: #67e8f9; border-radius: 999px;"></div>
                            </div>
                        </div>

                        <div style="margin-bottom: 1.2rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 0.45rem;">
                                <span>Front-End Dev</span>
                                <span>60%</span>
                            </div>
                            <div style="height: 8px; background: rgba(255,255,255,0.22); border-radius: 999px;">
                                <div style="width: 60%; height: 100%; background: #67e8f9; border-radius: 999px;"></div>
                            </div>
                        </div>

                        <div style="margin-bottom: 1.4rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 0.45rem;">
                                <span>Product Mgmt</span>
                                <span>40%</span>
                            </div>
                            <div style="height: 8px; background: rgba(255,255,255,0.22); border-radius: 999px;">
                                <div style="width: 40%; height: 100%; background: #67e8f9; border-radius: 999px;"></div>
                            </div>
                        </div>

                        <!-- Deadline Mendatang -->
                        <div style="margin-top: 1.5rem; padding-top: 1.4rem; border-top: 1px solid rgba(255,255,255,0.22);">
                            <div style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.18); border-radius: 1.25rem; padding: 1rem;">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.75rem; margin-bottom: 1rem;">
                                    <div>
                                        <div style="font-size: 1rem; font-weight: 800; color: #ffffff;">
                                            Deadline Mendatang
                                        </div>
                                        <div style="font-size: 0.75rem; color: rgba(255,255,255,0.75); margin-top: 0.25rem;">
                                            Jadwal tugas terdekat
                                        </div>
                                    </div>

                                    <div style="background: rgba(255,255,255,0.16); color: #ffffff; font-size: 0.72rem; font-weight: 800; padding: 0.35rem 0.65rem; border-radius: 999px; white-space: nowrap;">
                                        3 Deadline
                                    </div>
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem; background: rgba(255,255,255,0.11); border-radius: 1rem; padding: 0.75rem;">
                                        <div style="width: 42px; height: 42px; border-radius: 0.85rem; background: #fde2e2; color: #dc2626; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: 900; line-height: 1;">
                                            <span style="font-size: 0.9rem;">24</span>
                                            <span style="font-size: 0.58rem; margin-top: 0.15rem;">OKT</span>
                                        </div>

                                        <div>
                                            <div style="font-weight: 800; font-size: 0.85rem; color: #ffffff;">
                                                Final Case Study
                                            </div>
                                            <div style="font-size: 0.72rem; color: rgba(255,255,255,0.75); margin-top: 0.15rem;">
                                                UI Design • 23:59 WIB
                                            </div>
                                        </div>
                                    </div>

                                    <div style="display: flex; align-items: center; gap: 0.75rem; background: rgba(255,255,255,0.11); border-radius: 1rem; padding: 0.75rem;">
                                        <div style="width: 42px; height: 42px; border-radius: 0.85rem; background: #efe7ff; color: #7c3aed; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: 900; line-height: 1;">
                                            <span style="font-size: 0.9rem;">28</span>
                                            <span style="font-size: 0.58rem; margin-top: 0.15rem;">OKT</span>
                                        </div>

                                        <div>
                                            <div style="font-weight: 800; font-size: 0.85rem; color: #ffffff;">
                                                Quiz API Rest
                                            </div>
                                            <div style="font-size: 0.72rem; color: rgba(255,255,255,0.75); margin-top: 0.15rem;">
                                                Backend Fundamentals
                                            </div>
                                        </div>
                                    </div>

                                    <div style="display: flex; align-items: center; gap: 0.75rem; background: rgba(255,255,255,0.11); border-radius: 1rem; padding: 0.75rem;">
                                        <div style="width: 42px; height: 42px; border-radius: 0.85rem; background: #f1eafd; color: #8b5cf6; display: flex; flex-direction: column; align-items: center; justify-content: center; font-weight: 900; line-height: 1;">
                                            <span style="font-size: 0.9rem;">30</span>
                                            <span style="font-size: 0.58rem; margin-top: 0.15rem;">OKT</span>
                                        </div>

                                        <div>
                                            <div style="font-weight: 800; font-size: 0.85rem; color: #ffffff;">
                                                Refleksi Belajar
                                            </div>
                                            <div style="font-size: 0.72rem; color: rgba(255,255,255,0.75); margin-top: 0.15rem;">
                                                Self Development
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD

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
                    <div class="stress-description">Streak Belajar</div>
                </div>
                <div style="background: white; border-radius: 0.75rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                    <p style="color: #6b7280; font-size: 0.875rem; line-height: 1.5;">
                        <strong style="color: #1f2937;">Manageable levels of stress</strong> are actually beneficial for learning and performance. Your current stress level is in the optimal range for productivity. Keep maintaining this balance!
                    </p>
                </div>
=======
                </aside>
>>>>>>> origin/main
            </div>

            <!-- Footer -->
            <footer class="dashboard-footer" style="margin-top: 2rem;">
                <div>
                    <div class="footer-brand">Intellecta</div>
                    <div class="footer-copyright">© 2024 Intellecta Indonesia, Learning Hub CPDI Sai Universitas Urbanus</div>
                </div>
                <div class="footer-links">
                    <a href="#" class="footer-link">Kebijakan Privasi</a>
                    <a href="#" class="footer-link">Syarat & Layanan</a>
                    <a href="#" class="footer-link">Hubungi Dukungan</a>
                    <a href="#" class="footer-link">Keselamatan</a>
                </div>
            </footer>
        </main>
    </div>
</body>
</html>