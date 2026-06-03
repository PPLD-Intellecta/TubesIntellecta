@php
function enrichVideo($video) {
    $id = $video->id ?? 1;
    $title = $video->title;
    $desc = $video->description ?? '';
    
    // Category mapping based on title/desc keywords
    $category = 'Front-End Development';
    $titleLower = strtolower($title);
    $descLower = strtolower($desc);
    
    if (
        str_contains($titleLower, 'ui/') || 
        str_contains($titleLower, 'ux') || 
        str_contains($titleLower, 'figma') || 
        str_contains($titleLower, 'design') || 
        str_contains($titleLower, 'desain') || 
        str_contains($descLower, 'ui/ux') || 
        str_contains($descLower, 'design')
    ) {
        $category = 'UI/UX Design';
    } elseif (
        str_contains($titleLower, 'react') || 
        str_contains($titleLower, 'hooks') || 
        str_contains($titleLower, 'html') || 
        str_contains($titleLower, 'css') || 
        str_contains($titleLower, 'front') || 
        str_contains($titleLower, 'vue') || 
        str_contains($titleLower, 'tailwind') || 
        str_contains($descLower, 'frontend') || 
        str_contains($descLower, 'html')
    ) {
        $category = 'Front-End Development';
    } elseif (
        str_contains($titleLower, 'laravel') || 
        str_contains($titleLower, 'node') || 
        str_contains($titleLower, 'express') || 
        str_contains($titleLower, 'backend') || 
        str_contains($titleLower, 'api') || 
        str_contains($titleLower, 'database') || 
        str_contains($titleLower, 'php') || 
        str_contains($descLower, 'backend') || 
        str_contains($descLower, 'database')
    ) {
        $category = 'Back-End Development';
    } elseif (
        str_contains($titleLower, 'product') || 
        str_contains($titleLower, 'agile') || 
        str_contains($titleLower, 'scrum') || 
        str_contains($titleLower, 'management') || 
        str_contains($descLower, 'product manager') || 
        str_contains($descLower, 'scrum')
    ) {
        $category = 'Product Management';
    } elseif (
        str_contains($titleLower, 'self') || 
        str_contains($titleLower, 'habit') || 
        str_contains($titleLower, 'mindset') || 
        str_contains($titleLower, 'motivation') || 
        str_contains($titleLower, 'growth') || 
        str_contains($descLower, 'self development') || 
        str_contains($descLower, 'mindset')
    ) {
        $category = 'Self Development';
    } else {
        // Fallback using deterministic hash
        $categories = ['UI/UX Design', 'Front-End Development', 'Back-End Development', 'Product Management', 'Self Development'];
        $category = $categories[$id % count($categories)];
    }
    
    // Difficulty mapping
    $difficulty = 'Intermediate';
    if (
        str_contains($titleLower, 'beginner') || 
        str_contains($titleLower, 'dasar') || 
        str_contains($titleLower, 'intro') || 
        str_contains($descLower, 'pemula')
    ) {
        $difficulty = 'Beginner';
    } elseif (
        str_contains($titleLower, 'advanced') || 
        str_contains($titleLower, 'expert') || 
        str_contains($titleLower, 'lanjutan') || 
        str_contains($descLower, 'advanced')
    ) {
        $difficulty = 'Advanced';
    } else {
        $difficulties = ['Beginner', 'Intermediate', 'Advanced'];
        $difficulty = $difficulties[($id + 1) % count($difficulties)];
    }
    
    // Duration
    $min = (($id * 7) % 35) + 10; // 10 to 45 mins
    $sec = (($id * 13) % 60);
    $duration = sprintf("%02d:%02d", $min, $sec);
    
    // Instructor Name
    $instructors = [
        ['name' => 'Alex Rivera', 'role' => 'Lead UI/UX Designer', 'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&h=150&q=80'],
        ['name' => 'Sophia Chen', 'role' => 'Senior Frontend Dev', 'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&h=150&q=80'],
        ['name' => 'Marcus Thorne', 'role' => 'Principal Backend Engineer', 'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&h=150&q=80'],
        ['name' => 'Aisha Rahman', 'role' => 'Senior Product Manager', 'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&h=150&q=80'],
        ['name' => 'Diana Prince', 'role' => 'Habit & Growth Coach', 'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&h=150&q=80']
    ];
    $instructorIndex = $id % count($instructors);
    
    // Progress
    $progress = 0;
    if ($id % 3 === 0) {
        $progress = (($id * 23) % 75) + 15; // 15% to 90%
    }
    
    // Thumbnail based on category
    $thumbnails = [
        'UI/UX Design' => 'https://images.unsplash.com/photo-1561070791-26c113006238?auto=format&fit=crop&w=600&h=340&q=80', // Figma/Design UI
        'Front-End Development' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&h=340&q=80', // Laptop/Code
        'Back-End Development' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=600&h=340&q=80', // Server/Tech Code
        'Product Management' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=600&h=340&q=80', // Agile Board
        'Self Development' => 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?auto=format&fit=crop&w=600&h=340&q=80' // Notebook/Coffee/Growth
    ];
    
    $thumbnail = $thumbnails[$category] ?? $thumbnails['Front-End Development'];
    
    return (object)[
        'id' => $id,
        'title' => $title,
        'description' => $desc,
        'url_video' => $video->url_video,
        'category' => $category,
        'difficulty' => $difficulty,
        'duration' => $duration,
        'instructor' => (object)$instructors[$instructorIndex],
        'progress' => $progress,
        'thumbnail' => $thumbnail
    ];
}
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Materi Video</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    <style>
        /* Custom video index page specific styling */
        .video-search-container {
            background: white;
            border-radius: 1rem;
            padding: 1.25rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
            align-items: center;
            border: 1px solid #f3e8ff;
        }

        .search-wrapper {
            position: relative;
            flex: 1;
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border-radius: 0.75rem;
            border: 1px solid #e9d5ff;
            font-family: inherit;
            font-size: 0.9rem;
            color: #1f2937;
            background-color: #faf7ff;
            transition: all 0.2s ease-in-out;
        }

        .search-input:focus {
            outline: none;
            border-color: #a855f7;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.12);
        }

        .search-icon-svg {
            position: absolute;
            left: 0.95rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1.15rem;
            height: 1.15rem;
            color: #a78bfa;
            pointer-events: none;
        }

        .filter-select {
            padding: 0.75rem 2rem 0.75rem 1rem;
            border-radius: 0.75rem;
            border: 1px solid #e9d5ff;
            font-family: inherit;
            font-size: 0.9rem;
            color: #6b21a8;
            background-color: #fcfaff;
            cursor: pointer;
            transition: all 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%238b5cf6' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            min-width: 180px;
        }

        .filter-select:focus {
            outline: none;
            border-color: #a855f7;
            box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.12);
        }

        /* Tabs filter */
        .tabs-container {
            display: flex;
            gap: 0.65rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #e9d5ff transparent;
        }

        .tabs-container::-webkit-scrollbar {
            height: 4px;
        }

        .tabs-container::-webkit-scrollbar-thumb {
            background: #e9d5ff;
            border-radius: 4px;
        }

        .tab-btn {
            padding: 0.65rem 1.25rem;
            border-radius: 9999px;
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            background-color: #f3e8ff;
            color: #6b21a8;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
        }

        .tab-btn:hover {
            background-color: #e9d5ff;
        }

        .tab-btn.active {
            background-color: #7c3aed;
            color: white;
            box-shadow: 0 4px 14px rgba(124, 58, 237, 0.3);
        }

        /* Responsive Video Grid */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        @media (max-width: 1200px) {
            .video-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .video-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
            .video-search-container {
                flex-direction: column;
                align-items: stretch;
            }
            .filter-select {
                width: 100%;
            }
        }

        /* Video Card styling */
        .video-card {
            background: white;
            border-radius: 1.25rem;
            overflow: hidden;
            border: 1px solid #efe7ff;
            box-shadow: 0 4px 18px rgba(124, 58, 237, 0.04);
            display: flex;
            flex-direction: column;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .video-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 28px rgba(124, 58, 237, 0.12);
            border-color: #e2d5f8;
        }

        .thumbnail-container {
            position: relative;
            aspect-ratio: 16/9;
            width: 100%;
            overflow: hidden;
            background: #faf5ff;
        }

        .thumbnail-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .video-card:hover .thumbnail-img {
            transform: scale(1.06);
        }

        /* Play Button Overlay styling */
        .play-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.9;
            transition: all 0.3s;
        }

        .play-btn-circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .play-icon-triangle {
            width: 0;
            height: 0;
            border-top: 9px solid transparent;
            border-bottom: 9px solid transparent;
            border-left: 15px solid white;
            margin-left: 4px;
        }

        .video-card:hover .play-btn-circle {
            transform: scale(1.15);
            background: #7c3aed;
            border-color: #7c3aed;
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
        }

        .duration-badge {
            position: absolute;
            bottom: 0.75rem;
            right: 0.75rem;
            background: rgba(15, 10, 25, 0.75);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 0.35rem;
            font-size: 0.75rem;
            font-weight: 700;
        }

        /* Card Content styling */
        .video-card-content {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .card-badges {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            gap: 0.5rem;
        }

        .category-badge {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 0.25rem 0.6rem;
            border-radius: 0.35rem;
        }

        /* Categorized badge coloring */
        .cat-ui-ux { background-color: #faf5ff; color: #7c3aed; }
        .cat-frontend { background-color: #eff6ff; color: #3b82f6; }
        .cat-backend { background-color: #ecfdf5; color: #10b981; }
        .cat-product { background-color: #fffbeb; color: #d97706; }
        .cat-self { background-color: #fdf2f8; color: #db2777; }
        .cat-default { background-color: #f3f4f6; color: #4b5563; }

        .difficulty-badge {
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.2rem 0.5rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .diff-beginner { background-color: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .diff-intermediate { background-color: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
        .diff-advanced { background-color: #fff1f2; color: #b91c1c; border: 1px solid #fecdd3; }

        .video-title {
            font-size: 1.05rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 0.65rem;
            line-height: 1.4;
            height: 2.8rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Instructor styling */
        .instructor-info {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            margin-bottom: 1rem;
            border-top: 1px solid #f5efff;
            padding-top: 0.75rem;
        }

        .instructor-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #e9d5ff;
        }

        .instructor-name-title {
            display: flex;
            flex-direction: column;
        }

        .instructor-name {
            font-size: 0.82rem;
            font-weight: 700;
            color: #374151;
        }

        .instructor-role {
            font-size: 0.68rem;
            color: #9ca3af;
        }

        /* Progress Bar styling */
        .card-progress-container {
            margin-bottom: 1.1rem;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .progress-bar-label {
            display: flex;
            justify-content: space-between;
            font-size: 0.72rem;
            color: #7c3aed;
            font-weight: 700;
        }

        .progress-track {
            width: 100%;
            height: 6px;
            background-color: #f3e8ff;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #7c3aed, #a855f7);
            border-radius: 999px;
            transition: width 0.4s ease;
        }

        .btn-watch {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);
            color: white;
            font-size: 0.88rem;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.15);
        }

        .btn-watch:hover {
            background: linear-gradient(135deg, #6d28d9 0%, #7c3aed 100%);
            box-shadow: 0 6px 18px rgba(124, 58, 237, 0.3);
            transform: translateY(-1px);
        }

        .btn-watch:active {
            transform: translateY(0);
        }

        /* Empty state styling */
        .empty-state-card {
            background: white;
            border-radius: 1.5rem;
            padding: 4rem 2rem;
            text-align: center;
            border: 1px dashed #c084fc;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02);
            color: #6b7280;
            max-width: 600px;
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1.25rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }

        .empty-state-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .empty-state-desc {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
            max-width: 420px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                Intellecta
            </div>
            <div class="sidebar-subtitle">Smart Learning</div>

            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-menu-link">
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
                    <a href="{{ route('student.videos.index') }}" class="sidebar-menu-link active">
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

        <!-- Main Content Area -->
        <main class="main-content">
            <!-- Header Section -->
            <div class="content-header">
                @if(session('success'))
                    <div style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.75rem; margin-bottom: 1.5rem; font-weight: 500; border: 1px solid #bbf7d0;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="greeting" id="main-title">Materi Video</div>
                <div class="greeting-subtitle">Pelajari berbagai topik development melalui video pembelajaran berkualitas tinggi.</div>
            </div>

            <!-- Search bar with filter options -->
            <div class="video-search-container">
                <div class="search-wrapper">
                    <svg class="search-icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="video-search-input" class="search-input" placeholder="Cari materi video, topik, atau kata kunci..." autocomplete="off">
                </div>

                <select id="video-difficulty-select" class="filter-select">
                    <option value="all">Semua Level</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

            <!-- Category Filter Tabs -->
            <div class="tabs-container" id="video-tabs-container">
                <button class="tab-btn active" data-category="all">All Videos</button>
                <button class="tab-btn" data-category="UI/UX Design">UI/UX Design</button>
                <button class="tab-btn" data-category="Front-End Development">Front-End Development</button>
                <button class="tab-btn" data-category="Back-End Development">Back-End Development</button>
                <button class="tab-btn" data-category="Product Management">Product Management</button>
                <button class="tab-btn" data-category="Self Development">Self Development</button>
            </div>

            <!-- Video Grid Layout -->
            <div class="video-grid" id="video-grid-layout">
                @forelse ($videos as $rawVideo)
                    @php
                        $video = enrichVideo($rawVideo);
                    @endphp
                    
                    <div class="video-card" 
                         data-title="{{ strtolower($video->title) }}" 
                         data-desc="{{ strtolower($video->description) }}"
                         data-category="{{ $video->category }}" 
                         data-difficulty="{{ $video->difficulty }}">
                         
                        <!-- Thumbnail -->
                        <div class="thumbnail-container">
                            <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="thumbnail-img" loading="lazy">
                            <div class="play-overlay">
                                <div class="play-btn-circle">
                                    <div class="play-icon-triangle"></div>
                                </div>
                            </div>
                            <span class="duration-badge">⏱️ {{ $video->duration }}</span>
                        </div>

                        <!-- Content -->
                        <div class="video-card-content">
                            <div class="card-badges">
                                @php
                                    $catClass = 'cat-default';
                                    if ($video->category === 'UI/UX Design') $catClass = 'cat-ui-ux';
                                    elseif ($video->category === 'Front-End Development') $catClass = 'cat-frontend';
                                    elseif ($video->category === 'Back-End Development') $catClass = 'cat-backend';
                                    elseif ($video->category === 'Product Management') $catClass = 'cat-product';
                                    elseif ($video->category === 'Self Development') $catClass = 'cat-self';
                                    
                                    $diffClass = 'diff-intermediate';
                                    if ($video->difficulty === 'Beginner') $diffClass = 'diff-beginner';
                                    elseif ($video->difficulty === 'Advanced') $diffClass = 'diff-advanced';
                                @endphp
                                
                                <span class="category-badge {{ $catClass }}">{{ $video->category }}</span>
                                <span class="difficulty-badge {{ $diffClass }}">
                                    ● {{ $video->difficulty }}
                                </span>
                            </div>

                            <h3 class="video-title" title="{{ $video->title }}">{{ $video->title }}</h3>

                            <!-- Instructor Info -->
                            <div class="instructor-info">
                                <img src="{{ $video->instructor->avatar }}" alt="{{ $video->instructor->name }}" class="instructor-avatar">
                                <div class="instructor-name-title">
                                    <span class="instructor-name">{{ $video->instructor->name }}</span>
                                    <span class="instructor-role">{{ $video->instructor->role }}</span>
                                </div>
                            </div>

                            <!-- Progress Bar (If started) -->
                            @if ($video->progress > 0)
                                <div class="card-progress-container">
                                    <div class="progress-bar-label">
                                        <span>Progres Belajar</span>
                                        <span>{{ $video->progress }}%</span>
                                    </div>
                                    <div class="progress-track">
                                        <div class="progress-fill" style="width: {{ $video->progress }}%;"></div>
                                    </div>
                                </div>
                            @endif

                            <div style="margin-top: auto;">
                                <a href="{{ route('student.videos.show', $video->id) }}" class="btn-watch">Tonton Sekarang</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Fallback if database is completely empty (no seeded videos) -->
                    <div class="empty-state-card" style="grid-column: 1 / -1;" id="db-empty-state">
                        <div class="empty-state-icon">📭</div>
                        <div class="empty-state-title">Belum Ada Video</div>
                        <div class="empty-state-desc">Materi video belajar sedang dipersiapkan oleh instruktur. Silakan periksa kembali beberapa saat lagi!</div>
                    </div>
                @endforelse
                
                <!-- Client-Side No Results Found placeholder -->
                <div class="empty-state-card" style="grid-column: 1 / -1; display: none;" id="search-empty-state">
                    <div class="empty-state-icon">🔍</div>
                    <div class="empty-state-title">Materi Tidak Ditemukan</div>
                    <div class="empty-state-desc">Tidak ada materi video yang cocok dengan kata kunci atau filter pencarian Anda. Coba kata kunci yang lain!</div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="dashboard-footer">
                <div>
                    <div class="footer-brand" style="font-weight: 700; color: #1f2937; margin-bottom: 0.25rem; font-size: 0.85rem;">Intellecta</div>
                    <div class="footer-copyright">© 2024 Intellecta Indonesia, Learning Hub CPDI Sai Universitas Urbanus</div>
                </div>
                <div class="footer-links">
                    <a href="#" class="footer-link">Kebijakan Privasi</a>
                    <a href="#" class="footer-link">Syarat & Layanan</a>
                    <a href="#" class="footer-link">Hubungi Dukungan</a>
                </div>
            </footer>
        </main>
    </div>

    <!-- Client-Side Interactive Search & Filtering Javascript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('video-search-input');
            const difficultySelect = document.getElementById('video-difficulty-select');
            const tabButtons = document.querySelectorAll('#video-tabs-container .tab-btn');
            const videoCards = document.querySelectorAll('#video-grid-layout .video-card');
            const searchEmptyState = document.getElementById('search-empty-state');
            const dbEmptyState = document.getElementById('db-empty-state');

            let activeCategory = 'all';
            let activeDifficulty = 'all';
            let searchQuery = '';

            // Handle Category Tab click
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    activeCategory = button.getAttribute('data-category');
                    filterVideos();
                });
            });

            // Handle Difficulty Select change
            difficultySelect.addEventListener('change', (e) => {
                activeDifficulty = e.target.value;
                filterVideos();
            });

            // Handle Search Input keyup/change
            searchInput.addEventListener('input', (e) => {
                searchQuery = e.target.value.toLowerCase().trim();
                filterVideos();
            });

            // Filtering core logic
            function filterVideos() {
                let visibleCount = 0;

                videoCards.forEach(card => {
                    const title = card.getAttribute('data-title');
                    const desc = card.getAttribute('data-desc');
                    const category = card.getAttribute('data-category');
                    const difficulty = card.getAttribute('data-difficulty');

                    // Filter match criteria
                    const matchesCategory = (activeCategory === 'all' || category === activeCategory);
                    const matchesDifficulty = (activeDifficulty === 'all' || difficulty === activeDifficulty);
                    const matchesSearch = (searchQuery === '' || title.includes(searchQuery) || desc.includes(searchQuery));

                    if (matchesCategory && matchesDifficulty && matchesSearch) {
                        card.style.display = 'flex';
                        visibleCount++;
                        
                        // Add a tiny animation fade-in
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.98) translateY(2px)';
                        setTimeout(() => {
                            card.style.transition = 'opacity 0.25s ease, transform 0.25s ease, box-shadow 0.3s ease, border-color 0.3s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1) translateY(0)';
                        }, 20);
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Show/hide empty state if no matching videos found
                if (videoCards.length > 0) {
                    if (visibleCount === 0) {
                        searchEmptyState.style.display = 'flex';
                    } else {
                        searchEmptyState.style.display = 'none';
                    }
                }
            }
        });
    </script>
</body>
</html>
