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

                <li class="sidebar-menu-item">
                    <a href="{{ route('student.live-schedule.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Kelas Live
                    </a>
                </li>

                <li class="sidebar-menu-item">
                    <a href="{{ route('student.planner.index') }}" class="sidebar-menu-link">
                        <svg class="sidebar-menu-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Study Planner
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

            <!-- Layout Utama Fleksibel -->
            <div style="display: grid; grid-template-columns: minmax(0, 1fr) 360px; gap: 1.5rem; align-items: start; max-width: 100%;">
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

                   <div style="display: flex; flex-direction: column; gap: 1rem;">

    @if($learningHistories->count() > 0)
        <div style="background:#faf7ff; border:1px solid #ede9fe; border-radius:1.25rem; padding:1rem;">
            <div style="margin-bottom:0.85rem;">
                <div style="font-size:1rem; font-weight:800; color:#1f2937;">
                    Riwayat Kuis
                </div>
                <div style="font-size:0.78rem; color:#6b7280; margin-top:0.2rem;">
                    Hasil evaluasi yang telah dikerjakan
                </div>
            </div>

            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                @foreach($learningHistories as $history)
                    <div style="background:#ffffff; border:1px solid #ede9fe; border-radius:1rem; padding:1rem 1.1rem; display:flex; justify-content:space-between; align-items:center; gap:1rem;">
                        <div style="display:flex; align-items:center; gap:0.85rem;">
                            <div style="width:44px; height:44px; border-radius:0.9rem; background:#ede9fe; display:flex; align-items:center; justify-content:center; font-size:1.15rem;">
                                📝
                            </div>

                            <div>
                                <div style="font-size:0.95rem; font-weight:800; color:#1f2937;">
                                    {{ $history->quiz->title ?? 'Quiz Tidak Ditemukan' }}
                                </div>
                                <div style="font-size:0.78rem; color:#6b7280; margin-top:0.2rem;">
                                    Dikerjakan pada {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>

                        <div style="background:#7c3aed; color:white; padding:0.48rem 0.8rem; border-radius:999px; font-size:0.85rem; font-weight:800;">
                            Nilai {{ $history->score }}%
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if($videoHistories->count() > 0)
        <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:1.25rem; padding:1rem;">
            <div style="margin-bottom:0.85rem;">
                <div style="font-size:1rem; font-weight:800; color:#1f2937;">
                    Riwayat Materi Video
                </div>
                <div style="font-size:0.78rem; color:#6b7280; margin-top:0.2rem;">
                    Materi yang telah diselesaikan
                </div>
            </div>

            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                @foreach($videoHistories as $videoHistory)
                    <div style="background:#ffffff; border:1px solid #bbf7d0; border-radius:1rem; padding:1rem 1.1rem; display:flex; justify-content:space-between; align-items:center; gap:1rem;">
                        <div style="display:flex; align-items:center; gap:0.85rem;">
                            <div style="width:44px; height:44px; border-radius:0.9rem; background:#dcfce7; display:flex; align-items:center; justify-content:center; font-size:1.15rem;">
                                🎥
                            </div>

                            <div>
                                <div style="font-size:0.95rem; font-weight:800; color:#1f2937;">
                                    {{ $videoHistory->video->title ?? 'Materi Video Tidak Ditemukan' }}
                                </div>
                                <div style="font-size:0.78rem; color:#6b7280; margin-top:0.2rem;">
                                    Diselesaikan pada {{ $videoHistory->completed_at 
                                        ? \Carbon\Carbon::parse($videoHistory->completed_at)->format('d M Y, H:i') 
                                        : \Carbon\Carbon::parse($videoHistory->updated_at)->format('d M Y, H:i') 
                                    }}
                                </div>
                            </div>
                        </div>

                        <div style="background:#16a34a; color:white; padding:0.48rem 0.8rem; border-radius:999px; font-size:0.85rem; font-weight:800;">
                            Selesai
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
                    
                    <!-- Reward Belajar -->
<div style="background:#ffffff; border-radius:1.5rem; padding:1.5rem; box-shadow:0 10px 28px rgba(0,0,0,0.06);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem;">
        <div>
            <h3 style="font-size:1.2rem; font-weight:800; color:#1f2937; margin:0;">
                Reward Belajar
            </h3>
            <div style="font-size:0.85rem; color:#6b7280; margin-top:0.25rem;">
                Badge dan pencapaian berdasarkan aktivitas belajar siswa
            </div>
        </div>

        <div style="background:#fef3c7; color:#92400e; padding:0.55rem 0.9rem; border-radius:999px; font-size:0.85rem; font-weight:800;">
            {{ isset($rewards) ? count($rewards) : 0 }} Reward
        </div>
    </div>

    <!-- Reward Utama -->
    <div style="background:linear-gradient(135deg,#faf7ff,#fff7ed); border:1px solid #f3e8ff; border-radius:1.25rem; padding:1.25rem; margin-bottom:1.25rem;">
        <div style="display:flex; align-items:center; gap:1rem;">
            <div style="width:64px; height:64px; border-radius:1.2rem; background:#fef3c7; display:flex; align-items:center; justify-content:center; font-size:2rem;">
                🏆
            </div>

            <div style="flex:1;">
                <div style="font-size:1.05rem; font-weight:900; color:#1f2937;">
                    Champion Learner
                </div>
                <div style="font-size:0.82rem; color:#6b7280; margin-top:0.25rem;">
                    Diperoleh dari progres belajar dan penyelesaian kuis.
                </div>

                <div style="margin-top:0.85rem;">
                    <div style="display:flex; justify-content:space-between; font-size:0.78rem; color:#6b7280; margin-bottom:0.35rem;">
                        <span>Progress Belajar</span>
                        <span>{{ $progressPercentage ?? 0 }}%</span>
                    </div>
                    <div style="height:8px; background:#e9ddfb; border-radius:999px; overflow:hidden;">
                        <div style="width:{{ $progressPercentage ?? 0 }}%; height:100%; background:linear-gradient(90deg,#7c3aed,#a855f7); border-radius:999px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Koleksi Badge -->
    <div style="margin-bottom:1.25rem;">
        <div style="font-size:0.95rem; font-weight:800; color:#1f2937; margin-bottom:0.75rem;">
            Koleksi Badge
        </div>

        <div style="display:grid; grid-template-columns:repeat(4, minmax(0,1fr)); gap:0.75rem;">
            @forelse($rewards as $reward)
                <div style="background:#faf7ff; border:1px solid #f3e8ff; border-radius:1rem; padding:0.85rem; text-align:center;">
                    <div style="font-size:1.6rem; margin-bottom:0.45rem;">
                        {{ $reward['icon'] }}
                    </div>
                    <div style="font-size:0.78rem; font-weight:800; color:#1f2937;">
                        {{ $reward['title'] }}
                    </div>
                    <div style="font-size:0.68rem; color:#6b7280; margin-top:0.25rem;">
                        {{ $reward['description'] }}
                    </div>
                </div>
            @empty
                <div style="grid-column:1/-1; background:#f9fafb; border-radius:1rem; padding:1rem; color:#6b7280; font-size:0.85rem;">
                    Belum ada reward. Kerjakan kuis atau selesaikan materi video terlebih dahulu.
                </div>
            @endforelse
        </div>
    </div>

                    <!-- Target Berikutnya -->
<div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:1.25rem; padding:1rem;">
    <div style="font-size:0.95rem; font-weight:800; color:#1f2937; margin-bottom:0.85rem;">
        Target Berikutnya
    </div>

    <div style="display:flex; flex-direction:column; gap:0.85rem;">
        @foreach($nextTargets as $target)
            <div style="background:#ffffff; border:1px solid #e5e7eb; border-radius:1rem; padding:0.9rem;">
                <div style="display:flex; justify-content:space-between; align-items:center; gap:1rem;">
                    <div>
                        <div style="font-size:0.9rem; font-weight:800; color:#1f2937;">
                            {{ $target['icon'] }} {{ $target['title'] }}
                        </div>
                        <div style="font-size:0.78rem; color:#6b7280; margin-top:0.2rem;">
                            {{ $target['description'] }}
                        </div>
                    </div>

                    <div style="font-size:0.78rem; font-weight:800; color:{{ $target['is_completed'] ? '#16a34a' : '#7c3aed' }}; white-space:nowrap;">
                        {{ $target['is_completed'] ? 'Tercapai' : $target['current'].'/'.$target['target'].' '.$target['unit'] }}
                    </div>
                </div>

                <div style="height:8px; background:#e9ddfb; border-radius:999px; overflow:hidden; margin-top:0.75rem;">
                    <div style="width:{{ min(($target['current'] / $target['target']) * 100, 100) }}%; height:100%; background:{{ $target['is_completed'] ? '#16a34a' : '#7c3aed' }}; border-radius:999px;"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
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

                <!-- Kolom Kanan -->
<aside style="position: sticky; top: 1.5rem; width: 360px; max-width: 360px;">
    <!-- Ringkasan Keahlian -->
    <div style="background: linear-gradient(180deg, #7c3aed 0%, #8b5cf6 100%); border-radius: 1.5rem; padding: 1.5rem; color: #ffffff; box-shadow: 0 10px 28px rgba(124, 58, 237, 0.20);">
        <h3 style="font-size: 1.2rem; font-weight: 800; margin: 0 0 1.5rem;">
            Ringkasan Keahlian
        </h3>

        @if(isset($skillSummary) && collect($skillSummary)->sum() > 0)

    @foreach($skillSummary as $skill => $score)

        @if($score > 0)
            <div style="margin-bottom: 1.2rem;">
                <div style="display: flex; justify-content: space-between; font-size: 0.85rem; margin-bottom: 0.45rem;">
                    <span>{{ $skill }}</span>
                    <span>{{ $score }}%</span>
                </div>

                <div style="height: 8px; background: rgba(255,255,255,0.22); border-radius: 999px;">
                    <div style="width: {{ $score }}%; height: 100%; background: #67e8f9; border-radius: 999px;"></div>
                </div>
            </div>
        @endif

    @endforeach

@else
    <div style="font-size: 0.85rem; color: rgba(255,255,255,0.8); margin-bottom: 1.4rem;">
        Belum ada data keahlian. Kerjakan quiz terlebih dahulu.
    </div>
@endif

        <!-- Deadline Mendatang -->
<div style="margin-top: 1.5rem; padding-top: 1.4rem; border-top: 1px solid rgba(255,255,255,0.22);">
    <div style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.18); border-radius: 1.25rem; padding: 1rem;">
        <div style="font-size: 1rem; font-weight: 800; color: #ffffff;">
            Deadline Mendatang
        </div>
        <div style="font-size: 0.75rem; color: rgba(255,255,255,0.75); margin-top: 0.25rem;">
            Jadwal tugas terdekat
        </div>

        @if(isset($upcomingDeadlines) && $upcomingDeadlines->count() > 0)
    <div style="display:flex; flex-direction:column; gap:0.75rem; margin-top:1rem;">
        @foreach($upcomingDeadlines as $quiz)
            <div style="background:rgba(255,255,255,0.14); border-radius:0.85rem; padding:0.8rem;">
                <div style="font-size:0.85rem; font-weight:800; color:#ffffff;">
                    {{ $quiz->title }}
                </div>
                <div style="font-size:0.75rem; color:rgba(255,255,255,0.78); margin-top:0.25rem;">
                    Deadline: {{ \Carbon\Carbon::parse($quiz->deadline)->format('d M Y, H:i') }}
                </div>
            </div>
        @endforeach
    </div>
@else
    <div style="text-align:center; padding:1.25rem 0.5rem; margin-top: 1rem;">
        <div style="font-size:2rem;">📅</div>
        <div style="font-weight:800; margin-top:0.5rem; color:#ffffff;">
            Belum ada deadline
        </div>
        <div style="font-size:0.8rem; color:rgba(255,255,255,0.75); margin-top:0.35rem;">
            Deadline akan muncul setelah guru membuat tugas atau quiz.
        </div>
    </div>
@endif
    </div>
</div>
    </div>
</aside>
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