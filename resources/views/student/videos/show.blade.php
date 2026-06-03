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
    $durationSeconds = ($min * 60) + $sec;
    
    // Instructor Name
    $instructors = [
        [
            'name' => 'Alex Rivera', 
            'role' => 'Lead UI/UX Designer', 
            'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&h=150&q=80',
            'bio' => 'Mantan Lead Designer di Tokopedia dengan pengalaman lebih dari 8 tahun merancang antarmuka aplikasi berskala jutaan pengguna harian.'
        ],
        [
            'name' => 'Sophia Chen', 
            'role' => 'Senior Frontend Dev', 
            'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&h=150&q=80',
            'bio' => 'Software Engineer antusias dengan spesialisasi React, Vue, dan Web Performance. Suka berbagi ilmu seputar clean code & arsitektur modern.'
        ],
        [
            'name' => 'Marcus Thorne', 
            'role' => 'Principal Backend Engineer', 
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&h=150&q=80',
            'bio' => 'Fokus pada backend scalability, arsitektur microservices, dan database tuning. Berpengalaman merancang API aman & responsif di industri fintech.'
        ],
        [
            'name' => 'Aisha Rahman', 
            'role' => 'Senior Product Manager', 
            'avatar' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&h=150&q=80',
            'bio' => 'Product Leader yang telah meluncurkan berbagai produk digital sukses. Ahli dalam strategi MVP, analisis riset pengguna, dan agile framework.'
        ],
        [
            'name' => 'Diana Prince', 
            'role' => 'Habit & Growth Coach', 
            'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&h=150&q=80',
            'bio' => 'Psikolog perilaku yang berfokus membantu developer profesional menghindari burnout, membangun rutinitas produktif, dan memaksimalkan potensi diri.'
        ]
    ];
    $instructorIndex = $id % count($instructors);
    
    // Progress
    $progress = 0;
    if ($id % 3 === 0) {
        $progress = (($id * 23) % 75) + 15; // 15% to 90%
    }
    
    // Thumbnail based on category
    $thumbnails = [
        'UI/UX Design' => 'https://images.unsplash.com/photo-1561070791-26c113006238?auto=format&fit=crop&w=600&h=340&q=80', 
        'Front-End Development' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&h=340&q=80', 
        'Back-End Development' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=600&h=340&q=80', 
        'Product Management' => 'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=600&h=340&q=80', 
        'Self Development' => 'https://images.unsplash.com/photo-1506784983877-45594efa4cbe?auto=format&fit=crop&w=600&h=340&q=80' 
    ];
    
    $thumbnail = $thumbnails[$category] ?? $thumbnails['Front-End Development'];
    
    return (object)[
        'id' => $id,
        'title' => $title,
        'description' => $desc,
        'url_video' => $video->url_video,
        'embedUrl' => $video->embed_url,
        'category' => $category,
        'difficulty' => $difficulty,
        'duration' => $duration,
        'durationSeconds' => $durationSeconds,
        'instructor' => (object)$instructors[$instructorIndex],
        'progress' => $progress,
        'thumbnail' => $thumbnail
    ];
}

$enrichedVideo = enrichVideo($video);
$allVideos = \App\Models\Video::all();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - {{ $enrichedVideo->title }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Modern Video Workspace Grid Layout styling */
        .workspace-grid {
            display: grid;
            grid-template-columns: minmax(0, 2.3fr) 1fr;
            gap: 1.5rem;
            align-items: start;
        }

        @media (max-width: 1100px) {
            .workspace-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Breadcrumbs */
        .breadcrumb-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            color: #6b7280;
            margin-bottom: 1.25rem;
        }

        .breadcrumb-link {
            color: #7c3aed;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .breadcrumb-link:hover {
            color: #6d28d9;
        }

        .breadcrumb-separator {
            font-size: 0.75rem;
            color: #d1d5db;
        }

        /* Video Stage (16:9 Aspect Ratio) */
        .video-stage {
            background: #090514;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(124, 58, 237, 0.15);
            border: 1px solid #e9d5ff;
            position: relative;
            margin-bottom: 1.5rem;
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
        }

        .video-wrapper iframe, 
        .video-wrapper video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Custom Video Controller styling overlay */
        .custom-controls-bar {
            background: linear-gradient(180deg, #1f1a30 0%, #151022 100%);
            padding: 0.85rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #e9d5ff;
            gap: 1.25rem;
            border-top: 1px solid rgba(124, 58, 237, 0.2);
            flex-wrap: wrap;
        }

        .control-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .control-btn {
            background: none;
            border: none;
            color: #c4b5fd;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .control-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
            transform: scale(1.08);
        }

        .control-btn.active {
            color: #a855f7;
            background: rgba(168, 85, 247, 0.15);
        }

        .time-display {
            font-size: 0.82rem;
            font-family: monospace;
            color: #a78bfa;
            font-weight: 600;
        }

        .timeline-slider-container {
            flex: 1;
            display: flex;
            align-items: center;
            min-width: 150px;
        }

        .timeline-slider {
            width: 100%;
            height: 5px;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 999px;
            cursor: pointer;
            outline: none;
            accent-color: #a855f7;
            transition: height 0.2s;
        }

        .timeline-slider:hover {
            height: 8px;
        }

        .speed-dropdown {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(124, 58, 237, 0.3);
            color: #e9d5ff;
            font-family: inherit;
            font-size: 0.8rem;
            padding: 0.25rem 0.6rem;
            border-radius: 0.5rem;
            outline: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .speed-dropdown:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #a855f7;
            color: white;
        }

        .speed-dropdown option {
            background: #1f1a30;
            color: #e9d5ff;
        }

        /* simulated quality badge selector */
        .quality-select-wrapper {
            position: relative;
        }

        /* Large Video Info Header & Actions */
        .video-meta-block {
            background: white;
            border-radius: 1.25rem;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(124, 58, 237, 0.03);
            border: 1px solid #f3e8ff;
            margin-bottom: 1.5rem;
        }

        .video-heading-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .title-badges {
            flex: 1;
            min-width: 250px;
        }

        .meta-badges-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .stage-title {
            font-size: 1.45rem;
            font-weight: 900;
            color: #1f2937;
            line-height: 1.3;
        }

        /* Quick Action buttons */
        .action-buttons-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .action-pill-btn {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.55rem 0.95rem;
            border-radius: 0.75rem;
            border: 1px solid #e9d5ff;
            background: #faf7ff;
            color: #6b21a8;
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .action-pill-btn:hover {
            background: #f3e8ff;
            border-color: #a855f7;
            color: #7c3aed;
            transform: translateY(-1px);
        }

        .action-pill-btn.liked {
            background: #fdf2f8;
            border-color: #fbcfe8;
            color: #db2777;
        }

        .action-pill-btn.saved {
            background: #ecfdf5;
            border-color: #a7f3d0;
            color: #059669;
        }

        .action-pill-btn.completed {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-color: #059669;
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .action-pill-btn.completed:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
        }

        /* Enriched Instructor Info Block */
        .instructor-card-stage {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            background: #faf7ff;
            border: 1px solid #efe7ff;
            border-radius: 1rem;
            padding: 1.25rem;
            margin-top: 1.25rem;
        }

        .instructor-avatar-stage {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #a855f7;
            flex-shrink: 0;
        }

        .instructor-details-stage {
            flex: 1;
        }

        .instructor-name-stage {
            font-size: 0.95rem;
            font-weight: 800;
            color: #1f2937;
        }

        .instructor-role-stage {
            font-size: 0.72rem;
            color: #7c3aed;
            font-weight: 700;
            margin-bottom: 0.35rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .instructor-bio-stage {
            font-size: 0.8rem;
            color: #6b7280;
            line-height: 1.5;
        }

        /* Workspace Tabs styling */
        .workspace-tabs {
            background: white;
            border-radius: 1.25rem;
            border: 1px solid #efe7ff;
            box-shadow: 0 4px 20px rgba(124, 58, 237, 0.02);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .tabs-header-stage {
            display: flex;
            border-bottom: 1px solid #efe7ff;
            background: #fbfaff;
        }

        .tab-trigger-stage {
            flex: 1;
            padding: 1rem;
            text-align: center;
            border: none;
            background: none;
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: 700;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .tab-trigger-stage:hover {
            color: #7c3aed;
            background: #faf7ff;
        }

        .tab-trigger-stage.active {
            color: #7c3aed;
            background: white;
        }

        .tab-trigger-stage.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #7c3aed;
        }

        .tab-content-stage {
            padding: 1.5rem;
            display: none;
        }

        .tab-content-stage.active {
            display: block;
            animation: tabFadeIn 0.3s ease-out;
        }

        @keyframes tabFadeIn {
            from { opacity: 0; transform: translateY(3px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Overview Tab */
        .learning-objectives-list {
            margin-top: 1rem;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .objective-item {
            font-size: 0.85rem;
            color: #4b5563;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .objective-icon {
            color: #10b981;
            margin-top: 2px;
            flex-shrink: 0;
        }

        /* Resources Tab */
        .resources-list {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .resource-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #faf7ff;
            border: 1px solid #efe7ff;
            border-radius: 0.75rem;
            padding: 0.95rem 1.15rem;
            transition: all 0.2s;
        }

        .resource-card:hover {
            border-color: #c084fc;
            background: #f5efff;
        }

        .resource-icon-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .resource-file-icon {
            font-size: 1.5rem;
            color: #7c3aed;
        }

        .resource-name {
            font-size: 0.88rem;
            font-weight: 800;
            color: #1f2937;
        }

        .resource-meta {
            font-size: 0.72rem;
            color: #9ca3af;
            margin-top: 0.15rem;
        }

        .btn-download-resource {
            background: none;
            border: 1px solid #7c3aed;
            color: #7c3aed;
            padding: 0.4rem 0.9rem;
            border-radius: 0.5rem;
            font-size: 0.78rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-download-resource:hover {
            background: #7c3aed;
            color: white;
        }

        /* Discussion Tab */
        .comments-thread {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            margin-top: 1.25rem;
        }

        .comment-node {
            display: flex;
            gap: 0.85rem;
            border-bottom: 1px solid #f3efff;
            padding-bottom: 1rem;
        }

        .comment-node:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .comment-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid #e9d5ff;
        }

        .comment-body {
            flex: 1;
        }

        .comment-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.25rem;
        }

        .commenter-name {
            font-size: 0.85rem;
            font-weight: 800;
            color: #374151;
        }

        .comment-time {
            font-size: 0.72rem;
            color: #9ca3af;
        }

        .comment-text {
            font-size: 0.82rem;
            color: #4b5563;
            line-height: 1.45;
        }

        .comment-input-box {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            background: #faf7ff;
            border: 1px solid #efe7ff;
            border-radius: 0.85rem;
            padding: 1rem;
            margin-bottom: 1.25rem;
        }

        .comment-textarea {
            width: 100%;
            height: 70px;
            border: 1px solid #e9d5ff;
            border-radius: 0.6rem;
            padding: 0.6rem 0.8rem;
            font-family: inherit;
            font-size: 0.85rem;
            color: #1f2937;
            resize: none;
            background: white;
            outline: none;
            transition: all 0.2s;
        }

        .comment-textarea:focus {
            border-color: #a855f7;
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
        }

        .btn-comment-submit {
            align-self: flex-end;
            background: #7c3aed;
            color: white;
            border: none;
            padding: 0.45rem 1.15rem;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-comment-submit:hover {
            background: #6d28d9;
        }

        /* Notepad Tab */
        .notes-stage {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .note-input-row {
            display: flex;
            gap: 0.75rem;
        }

        .note-input {
            flex: 1;
            border: 1px solid #e9d5ff;
            border-radius: 0.65rem;
            padding: 0.65rem 0.85rem;
            font-family: inherit;
            font-size: 0.85rem;
            outline: none;
            transition: all 0.2s;
        }

        .note-input:focus {
            border-color: #a855f7;
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
        }

        .btn-add-note {
            background: #7c3aed;
            color: white;
            border: none;
            padding: 0.65rem 1.2rem;
            border-radius: 0.65rem;
            font-size: 0.85rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            white-space: nowrap;
        }

        .btn-add-note:hover {
            background: #6d28d9;
        }

        .saved-notes-list {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            max-height: 250px;
            overflow-y: auto;
            padding-right: 0.25rem;
        }

        .note-item {
            background: #faf7ff;
            border: 1px solid #efe7ff;
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            animation: notePop 0.25s ease-out;
        }

        @keyframes notePop {
            from { opacity: 0; transform: scale(0.97); }
            to { opacity: 1; transform: scale(1); }
        }

        .note-stamp-text {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
        }

        .timestamp-badge {
            background: #ede9fe;
            color: #7c3aed;
            font-family: monospace;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 0.25rem 0.5rem;
            border-radius: 0.35rem;
            border: 1px solid #ddd6fe;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .timestamp-badge:hover {
            background: #7c3aed;
            color: white;
            border-color: #7c3aed;
        }

        .note-content-string {
            font-size: 0.82rem;
            color: #4b5563;
        }

        .btn-delete-note {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            transition: color 0.2s;
            font-size: 0.85rem;
        }

        .btn-delete-note:hover {
            color: #ef4444;
        }

        /* Right Column Playlist Sidebar */
        .playlist-sidebar-box {
            background: white;
            border-radius: 1.25rem;
            border: 1px solid #efe7ff;
            box-shadow: 0 4px 20px rgba(124, 58, 237, 0.04);
            padding: 1.25rem;
            position: sticky;
            top: 1.5rem;
        }

        .playlist-progress-header {
            margin-bottom: 1.25rem;
            background: linear-gradient(135deg, #f5efff 0%, #fbf8ff 100%);
            border-radius: 1rem;
            padding: 1rem;
            border: 1px solid #f3e8ff;
        }

        .playlist-progress-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            font-weight: 800;
            color: #6b21a8;
            margin-bottom: 0.5rem;
        }

        .playlist-progress-track {
            width: 100%;
            height: 8px;
            background: #e9ddfb;
            border-radius: 999px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .playlist-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #7c3aed, #a855f7);
            border-radius: 999px;
            transition: width 0.4s ease;
        }

        .autoplay-toggle-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid rgba(124, 58, 237, 0.12);
        }

        .autoplay-label {
            font-size: 0.78rem;
            color: #6b7280;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        /* Toggle Switch */
        .switch-toggle {
            position: relative;
            display: inline-block;
            width: 36px;
            height: 20px;
        }

        .switch-toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: #d1d5db;
            transition: .3s;
            border-radius: 999px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }

        input:checked + .toggle-slider {
            background-color: #7c3aed;
        }

        input:checked + .toggle-slider:before {
            transform: translateX(16px);
        }

        /* Course series item list */
        .playlist-items-list {
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            max-height: 400px;
            overflow-y: auto;
        }

        .playlist-item-card {
            background: #ffffff;
            border: 1px solid #f3efff;
            border-radius: 0.75rem;
            padding: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }

        .playlist-item-card:hover {
            background: #faf7ff;
            border-color: #ddd6fe;
        }

        .playlist-item-card.active {
            background: #f5efff;
            border-color: #c084fc;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.06);
        }

        .playlist-item-checkbox {
            width: 17px;
            height: 17px;
            accent-color: #10b981;
            cursor: pointer;
            flex-shrink: 0;
        }

        .playlist-item-details {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
        }

        .playlist-item-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #374151;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .playlist-item-card.active .playlist-item-title {
            color: #7c3aed;
        }

        .playlist-item-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.7rem;
            color: #9ca3af;
        }

        .playlist-item-card.active .playlist-item-meta {
            color: #a78bfa;
        }

        /* Glassmorphic Toast Notification Container */
        .toast-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            z-index: 9999;
        }

        .glass-toast {
            background: rgba(31, 26, 48, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            color: #ffffff;
            padding: 0.8rem 1.4rem;
            border-radius: 0.85rem;
            font-size: 0.82rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            transform: translateY(15px) scale(0.95);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .glass-toast.show {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        
        /* Simulated captions overlay */
        .captions-overlay {
            position: absolute;
            bottom: 1.5rem;
            left: 2rem;
            right: 2rem;
            background: rgba(15, 10, 25, 0.85);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            color: #ffffff;
            padding: 0.6rem 1.2rem;
            border-radius: 0.5rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.15);
            pointer-events: none;
            display: none;
            animation: captionFade 0.2s ease-out;
        }
        
        @keyframes captionFade {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
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
            <!-- Breadcrumbs -->
            <div class="breadcrumb-container">
                <a href="{{ route('student.videos.index') }}" class="breadcrumb-link">Materi Video</a>
                <span class="breadcrumb-separator"><i class="fa-solid fa-chevron-right"></i></span>
                <span>{{ $enrichedVideo->title }}</span>
            </div>

            <!-- Two-Column Workspace Layout -->
            <div class="workspace-grid">
                <!-- Left Column (70%): Video and Workspace Detail Tabs -->
                <div style="min-width: 0;">
                    <!-- Video Stage -->
                    <div class="video-stage">
                        <div class="video-wrapper" id="player-mount-wrapper">
                            @php
                                $isYouTube = (str_contains($enrichedVideo->url_video, 'youtube.com') || str_contains($enrichedVideo->url_video, 'youtu.be') || str_contains($enrichedVideo->url_video, 'embed'));
                            @endphp

                            @if ($isYouTube)
                                <iframe id="main-video-player" src="{{ $enrichedVideo->embedUrl }}?enablejsapi=1&rel=0&modestbranding=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @else
                                <video id="main-video-player" controls preload="metadata">
                                    <source src="{{ $enrichedVideo->url_video }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                        
                        <!-- Dynamic Captions Overlay -->
                        <div class="captions-overlay" id="captions-overlay-box">
                            [Transkrip aktif] Membahas konsep inti pembelajaran...
                        </div>

                        <!-- Custom Controls Bar -->
                        <div class="custom-controls-bar">
                            <div class="control-group">
                                <button class="control-btn" id="play-pause-btn" title="Play/Pause (Space)">
                                    <i class="fa-solid fa-play" id="play-icon"></i>
                                </button>
                                <button class="control-btn" id="skip-back-btn" title="Mundur 5s (←)">
                                    <i class="fa-solid fa-backward"></i>
                                </button>
                                <button class="control-btn" id="skip-forward-btn" title="Maju 5s (→)">
                                    <i class="fa-solid fa-forward"></i>
                                </button>
                            </div>

                            <div class="timeline-slider-container">
                                <input type="range" id="seek-timeline" class="timeline-slider" min="0" max="100" value="0">
                            </div>

                            <div class="control-group">
                                <span class="time-display" id="time-counter">00:00 / 00:00</span>
                                
                                <select id="speed-selector" class="speed-dropdown" title="Kecepatan Putar">
                                    <option value="0.5">0.5x</option>
                                    <option value="1" selected>1.0x (Normal)</option>
                                    <option value="1.25">1.25x</option>
                                    <option value="1.5">1.5x</option>
                                    <option value="2">2.0x</option>
                                </select>

                                <select id="quality-selector" class="speed-dropdown" title="Kualitas Video">
                                    <option value="1080">1080p HD</option>
                                    <option value="720" selected>720p Auto</option>
                                    <option value="480">480p</option>
                                </select>

                                <button class="control-btn" id="cc-btn" title="Toggle Transkrip">
                                    <i class="fa-solid fa-closed-captioning"></i>
                                </button>

                                <button class="control-btn" id="fullscreen-btn" title="Fullscreen (F)">
                                    <i class="fa-solid fa-expand"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Video Meta block and Action Items -->
                    <div class="video-meta-block">
                        <div class="video-heading-section">
                            <div class="title-badges">
                                <div class="meta-badges-row">
                                    @php
                                        $catColorClass = 'cat-default';
                                        if ($enrichedVideo->category === 'UI/UX Design') $catColorClass = 'cat-ui-ux';
                                        elseif ($enrichedVideo->category === 'Front-End Development') $catColorClass = 'cat-frontend';
                                        elseif ($enrichedVideo->category === 'Back-End Development') $catColorClass = 'cat-backend';
                                        elseif ($enrichedVideo->category === 'Product Management') $catColorClass = 'cat-product';
                                        elseif ($enrichedVideo->category === 'Self Development') $catColorClass = 'cat-self';
                                        
                                        $diffColorClass = 'diff-intermediate';
                                        if ($enrichedVideo->difficulty === 'Beginner') $diffColorClass = 'diff-beginner';
                                        elseif ($enrichedVideo->difficulty === 'Advanced') $diffColorClass = 'diff-advanced';
                                    @endphp
                                    <span class="category-badge {{ $catColorClass }}">{{ $enrichedVideo->category }}</span>
                                    <span class="difficulty-badge {{ $diffColorClass }}">● {{ $enrichedVideo->difficulty }}</span>
                                </div>
                                <h1 class="stage-title">{{ $enrichedVideo->title }}</h1>
                            </div>

                            <!-- Actions (Like, Playlist, Share, Download) -->
                            <div class="action-buttons-row">
                                <button class="action-pill-btn" id="like-btn">
                                    <i class="fa-regular fa-thumbs-up" id="like-icon"></i>
                                    <span id="like-text">Suka</span> 
                                    <span style="color: #a78bfa; font-weight: 500; font-size: 0.75rem;" id="like-count">12</span>
                                </button>

                                <button class="action-pill-btn" id="playlist-btn">
                                    <i class="fa-regular fa-folder-open" id="playlist-icon"></i>
                                    <span id="playlist-text">Simpan</span>
                                </button>

                                <button class="action-pill-btn" id="share-btn">
                                    <i class="fa-regular fa-share-from-square"></i>
                                    <span>Bagikan</span>
                                </button>

                                <button class="action-pill-btn" id="download-btn">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                    <span>Download</span>
                                </button>
                                
                                <button class="action-pill-btn" id="stage-complete-btn" style="border: none;">
                                    <i class="fa-regular fa-circle-check" id="complete-icon"></i>
                                    <span id="complete-text">Selesai Belajar</span>
                                </button>
                            </div>
                        </div>

                        <!-- Instructor Bio Info -->
                        <div class="instructor-card-stage">
                            <img src="{{ $enrichedVideo->instructor->avatar }}" alt="{{ $enrichedVideo->instructor->name }}" class="instructor-avatar-stage">
                            <div class="instructor-details-stage">
                                <div class="instructor-name-stage">{{ $enrichedVideo->instructor->name }}</div>
                                <div class="instructor-role-stage">{{ $enrichedVideo->instructor->role }}</div>
                                <div class="instructor-bio-stage">{{ $enrichedVideo->instructor->bio }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Workspace Tabs section -->
                    <div class="workspace-tabs">
                        <div class="tabs-header-stage" id="tab-triggers-bar">
                            <button class="tab-trigger-stage active" data-target="tab-overview">Overview</button>
                            <button class="tab-trigger-stage" data-target="tab-resources">Resources</button>
                            <button class="tab-trigger-stage" data-target="tab-discussion">Discussion</button>
                            <button class="tab-trigger-stage" data-target="tab-notes">Notes & Timestamps</button>
                        </div>

                        <!-- Overview Content -->
                        <div class="tab-content-stage active" id="tab-overview">
                            <h3 style="font-size: 1rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Tentang Kelas</h3>
                            <p style="font-size: 0.85rem; color: #4b5563; line-height: 1.6; margin-bottom: 1.25rem;">
                                {{ $enrichedVideo->description }} Kelas ini dibimbing secara komprehensif oleh instruktur berpengalaman, menyeimbangkan teori esensial dan demo praktis yang dapat langsung diterapkan dalam alur kerja development harian Anda.
                            </p>

                            <h3 style="font-size: 1rem; font-weight: 800; color: #1f2937; margin-bottom: 0.5rem;">Capaian Pembelajaran (Objectives)</h3>
                            <ul class="learning-objectives-list">
                                <li class="objective-item">
                                    <span class="objective-icon"><i class="fa-solid fa-circle-check"></i></span>
                                    <span>Memahami prinsip dan konsep fundamental dari topik {{ $enrichedVideo->category }}.</span>
                                </li>
                                <li class="objective-item">
                                    <span class="objective-icon"><i class="fa-solid fa-circle-check"></i></span>
                                    <span>Menguasai implementasi best practices serta studi kasus dunia nyata industri.</span>
                                </li>
                                <li class="objective-item">
                                    <span class="objective-icon"><i class="fa-solid fa-circle-check"></i></span>
                                    <span>Menyelesaikan project tantangan akhir modul dengan standard penulisan berkualitas tinggi.</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Resources Content -->
                        <div class="tab-content-stage" id="tab-resources">
                            <h3 style="font-size: 1rem; font-weight: 800; color: #1f2937; margin-bottom: 1rem;">Bahan Ajar & Dokumen Pendukung</h3>
                            <div class="resources-list">
                                <div class="resource-card">
                                    <div class="resource-icon-info">
                                        <div class="resource-file-icon"><i class="fa-solid fa-file-pdf"></i></div>
                                        <div>
                                            <div class="resource-name">Slide Presentasi & Ringkasan Materi.pdf</div>
                                            <div class="resource-meta">PDF File • 4.8 MB</div>
                                        </div>
                                    </div>
                                    <button class="btn-download-resource" onclick="triggerDownload('Slide Presentasi')">Unduh PDF</button>
                                </div>

                                <div class="resource-card">
                                    <div class="resource-icon-info">
                                        <div class="resource-file-icon" style="color: #10b981;"><i class="fa-solid fa-file-zipper"></i></div>
                                        <div>
                                            <div class="resource-name">Source Code Latihan Mandiri.zip</div>
                                            <div class="resource-meta">ZIP Archive • 12.4 MB</div>
                                        </div>
                                    </div>
                                    <button class="btn-download-resource" onclick="triggerDownload('Source Code Latihan')">Unduh Kode</button>
                                </div>

                                <div class="resource-card">
                                    <div class="resource-icon-info">
                                        <div class="resource-file-icon" style="color: #3b82f6;"><i class="fa-solid fa-link"></i></div>
                                        <div>
                                            <div class="resource-name">Tautan Dokumentasi Resmi Tambahan</div>
                                            <div class="resource-meta">Website External Link</div>
                                        </div>
                                    </div>
                                    <a href="https://google.com" target="_blank" class="btn-download-resource" style="text-decoration: none; display: inline-block;">Kunjungi</a>
                                </div>
                            </div>
                        </div>

                        <!-- Discussion Content -->
                        <div class="tab-content-stage" id="tab-discussion">
                            <!-- Comment Input -->
                            <div class="comment-input-box">
                                <h3 style="font-size: 0.9rem; font-weight: 800; color: #1f2937; margin: 0;">Ajukan Pertanyaan Baru</h3>
                                <textarea id="comment-text-area" class="comment-textarea" placeholder="Tanyakan hal yang membingungkan seputar materi video ini..."></textarea>
                                <button class="btn-comment-submit" id="btn-submit-comment">Kirim Pertanyaan</button>
                            </div>

                            <!-- Comment Thread -->
                            <div class="comments-thread" id="comments-thread-container">
                                <!-- Comment 1 -->
                                <div class="comment-node">
                                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=80&h=80&q=80" alt="Budi" class="comment-avatar">
                                    <div class="comment-body">
                                        <div class="comment-header-row">
                                            <span class="commenter-name">Budi Santoso</span>
                                            <span class="comment-time">3 jam yang lalu</span>
                                        </div>
                                        <div class="comment-text">Apakah ada tips khusus untuk mempercepat loading component ini di production? Saya merasa render component agak lambat saat datanya bertambah banyak.</div>
                                    </div>
                                </div>

                                <!-- Comment 2 -->
                                <div class="comment-node">
                                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=80&h=80&q=80" alt="Siti" class="comment-avatar">
                                    <div class="comment-body">
                                        <div class="comment-header-row">
                                            <span class="commenter-name">Siti Aminah</span>
                                            <span class="comment-time">Kemarin</span>
                                        </div>
                                        <div class="comment-text">Penjelasannya sangat terstruktur dan detail! Sangat membantu untuk pemula seperti saya yang baru berpindah haluan ke developer. Terima kasih mentor!</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes & Timestamps Content -->
                        <div class="tab-content-stage" id="tab-notes">
                            <div class="notes-stage">
                                <div class="comment-input-box" style="background: #faf7ff; margin-bottom: 0.5rem;">
                                    <h3 style="font-size: 0.9rem; font-weight: 800; color: #1f2937; margin: 0 0 0.25rem 0;">Buat Catatan Timestamp Belajar</h3>
                                    <p style="font-size: 0.72rem; color: #6b7280; margin-bottom: 0.75rem;">Simpan poin penting belajar. Klik timestamp pada daftar catatan untuk melompat kembali ke detik tersebut!</p>
                                    <div class="note-input-row">
                                        <input type="text" id="note-input-field" class="note-input" placeholder="Tulis catatan penting Anda di sini...">
                                        <button class="btn-add-note" id="btn-save-note">
                                            <i class="fa-solid fa-bookmark"></i> Simpan Catatan
                                        </button>
                                    </div>
                                </div>

                                <div class="saved-notes-list" id="saved-notes-box">
                                    <!-- Dynamic notes loaded here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column (30%): Playlist Sidebar -->
                <aside class="playlist-sidebar-box">
                    <div class="playlist-progress-header">
                        <div class="playlist-progress-info">
                            <span>PROGRES MATERI</span>
                            <span id="playlist-progress-percentage">0% Selesai</span>
                        </div>
                        <div class="playlist-progress-track">
                            <div class="playlist-progress-fill" id="playlist-progress-fill-bar" style="width: 0%;"></div>
                        </div>
                        
                        <!-- Autoplay toggle -->
                        <div class="autoplay-toggle-wrapper">
                            <span class="autoplay-label">
                                <i class="fa-solid fa-circle-play"></i> Auto-Play Video Berikutnya
                            </span>
                            <label class="switch-toggle">
                                <input type="checkbox" id="autoplay-checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <!-- List of videos in series -->
                    <div style="font-size: 0.85rem; font-weight: 800; color: #1f2937; margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: space-between;">
                        <span>Daftar Putar Seri</span>
                        <span style="font-size: 0.75rem; color: #a855f7; font-weight: 500;">{{ count($allVideos) }} Video</span>
                    </div>

                    <div class="playlist-items-list" id="playlist-items-wrapper">
                        @foreach ($allVideos as $item)
                            @php
                                $playItem = enrichVideo($item);
                                $isActive = ($playItem->id == $enrichedVideo->id);
                            @endphp
                            
                            <div class="playlist-item-card {{ $isActive ? 'active' : '' }}" data-id="{{ $playItem->id }}" data-url="{{ route('student.videos.show', $playItem->id) }}">
                                <input type="checkbox" class="playlist-item-checkbox" data-id="{{ $playItem->id }}" title="Tandai Selesai">
                                <div class="playlist-item-details">
                                    <div class="playlist-item-title">{{ $playItem->title }}</div>
                                    <div class="playlist-item-meta">
                                        <span>⏱️ {{ $playItem->duration }}</span>
                                        <span>•</span>
                                        <span style="text-transform: uppercase;">{{ $playItem->difficulty }}</span>
                                    </div>
                                </div>
                                @if ($isActive)
                                    <span style="color: #7c3aed; font-size: 0.95rem; margin-left: 0.25rem;"><i class="fa-solid fa-volume-high"></i></span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>
        </main>
    </div>

    <!-- Glassmorphic Toast Notification Container -->
    <div class="toast-container" id="toast-container-box"></div>

    <!-- Client-Side Video Workspace JavaScript -->
    <script>
        // Data passed from backend PHP
        const videoId = {{ $enrichedVideo->id }};
        const videoDurationTotal = {{ $enrichedVideo->durationSeconds }};
        
        // Playlist list elements for auto-play logic
        const playlistOrder = [
            @foreach($allVideos as $item)
                {{ $item->id }},
            @endforeach
        ];

        document.addEventListener('DOMContentLoaded', () => {
            // DOM Elements
            const playPauseBtn = document.getElementById('play-pause-btn');
            const playIcon = document.getElementById('play-icon');
            const seekTimeline = document.getElementById('seek-timeline');
            const timeCounter = document.getElementById('time-counter');
            const speedSelector = document.getElementById('speed-selector');
            const qualitySelector = document.getElementById('quality-selector');
            const ccBtn = document.getElementById('cc-btn');
            const captionsOverlay = document.getElementById('captions-overlay-box');
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            const playerWrapper = document.getElementById('player-mount-wrapper');
            const videoElement = document.getElementById('main-video-player');
            
            // Actions DOM Elements
            const likeBtn = document.getElementById('like-btn');
            const likeIcon = document.getElementById('like-icon');
            const likeCount = document.getElementById('like-count');
            const playlistBtn = document.getElementById('playlist-btn');
            const playlistIcon = document.getElementById('playlist-icon');
            const shareBtn = document.getElementById('share-btn');
            const downloadBtn = document.getElementById('download-btn');
            const stageCompleteBtn = document.getElementById('stage-complete-btn');
            const completeIcon = document.getElementById('complete-icon');
            const completeText = document.getElementById('complete-text');

            // Tabs DOM Elements
            const tabTriggers = document.querySelectorAll('#tab-triggers-bar .tab-trigger-stage');
            const tabContents = document.querySelectorAll('.tab-content-stage');

            // Discussion & Comments DOM Elements
            const commentTextArea = document.getElementById('comment-text-area');
            const submitCommentBtn = document.getElementById('btn-submit-comment');
            const commentsContainer = document.getElementById('comments-thread-container');

            // Notes DOM Elements
            const noteInputField = document.getElementById('note-input-field');
            const saveNoteBtn = document.getElementById('btn-save-note');
            const notesContainer = document.getElementById('saved-notes-box');

            // Playlist DOM Elements
            const playlistProgressPercentage = document.getElementById('playlist-progress-percentage');
            const playlistProgressFillBar = document.getElementById('playlist-progress-fill-bar');
            const autoplayCheckbox = document.getElementById('autoplay-checkbox');
            const playlistCheckboxes = document.querySelectorAll('.playlist-item-checkbox');
            const playlistCards = document.querySelectorAll('.playlist-item-card');

            // Local state variables
            let isVideoPlaying = false;
            let currentPlaybackTime = 0; // seconds
            let durationSeconds = videoDurationTotal || 900; // fallback 15 mins
            let isCaptionsActive = false;
            let isLiked = false;
            let isSaved = false;
            let isStageCompleted = false;

            // YouTube Player object initialization check
            let ytPlayer = null;
            const isYouTube = @json($isYouTube);

            // Resuming watching state from localStorage
            const savedTimeKey = `intellecta_progress_video_${videoId}`;
            const resumeTime = parseFloat(localStorage.getItem(savedTimeKey)) || 0;

            // 1. DUAL PLAYER DETECTION & YT PLAYER API
            if (isYouTube) {
                // Load YT IFrame API script dynamically if not present
                if (!window.YT) {
                    const tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe-api";
                    const firstScriptTag = document.getElementsByTagName('script')[0];
                    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
                }

                // Callback called when YT API is fully loaded
                window.onYouTubeIframeAPIReady = function() {
                    initYouTubePlayer();
                };

                // In case the API script loaded faster than our script ran, double-check window
                if (window.YT && window.YT.Player) {
                    initYouTubePlayer();
                }
            } else {
                // Initialize standard HTML5 <video> listeners
                initHTML5Player();
            }

            function initYouTubePlayer() {
                ytPlayer = new YT.Player('main-video-player', {
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            }

            function onPlayerReady(event) {
                durationSeconds = ytPlayer.getDuration() || videoDurationTotal;
                updateTimeTrackerDisplay(resumeTime, durationSeconds);
                
                // If there was a saved resume point, seek to it
                if (resumeTime > 2) {
                    ytPlayer.seekTo(resumeTime, true);
                    showToast("▶️ Melanjutkan tontonan dari " + formatTime(resumeTime));
                }

                // Sync timeline slider max value
                seekTimeline.max = durationSeconds;

                // Sync timeline tick timer
                setInterval(() => {
                    if (ytPlayer && typeof ytPlayer.getCurrentTime === 'function') {
                        currentPlaybackTime = ytPlayer.getCurrentTime();
                        seekTimeline.value = currentPlaybackTime;
                        updateTimeTrackerDisplay(currentPlaybackTime, durationSeconds);
                        
                        // Auto-save watch position every 2 seconds
                        localStorage.setItem(savedTimeKey, currentPlaybackTime);
                        
                        // Simulated captions display update
                        updateCaptionsDisplay(currentPlaybackTime);
                    }
                }, 1000);
            }

            function onPlayerStateChange(event) {
                // States: -1 (unstarted), 0 (ended), 1 (playing), 2 (paused), 3 (buffering), 5 (video cued)
                if (event.data === YT.PlayerState.PLAYING) {
                    isVideoPlaying = true;
                    playIcon.className = "fa-solid fa-pause";
                } else if (event.data === YT.PlayerState.PAUSED) {
                    isVideoPlaying = false;
                    playIcon.className = "fa-solid fa-play";
                } else if (event.data === YT.PlayerState.ENDED) {
                    isVideoPlaying = false;
                    playIcon.className = "fa-solid fa-play";
                    handleVideoEnded();
                }
            }

            function initHTML5Player() {
                if (!videoElement) return;

                videoElement.addEventListener('loadedmetadata', () => {
                    durationSeconds = videoElement.duration;
                    seekTimeline.max = durationSeconds;
                    updateTimeTrackerDisplay(resumeTime, durationSeconds);
                    
                    if (resumeTime > 2) {
                        videoElement.currentTime = resumeTime;
                        showToast("▶️ Melanjutkan tontonan dari " + formatTime(resumeTime));
                    }
                });

                videoElement.addEventListener('timeupdate', () => {
                    currentPlaybackTime = videoElement.currentTime;
                    seekTimeline.value = currentPlaybackTime;
                    updateTimeTrackerDisplay(currentPlaybackTime, durationSeconds);
                    localStorage.setItem(savedTimeKey, currentPlaybackTime);
                    updateCaptionsDisplay(currentPlaybackTime);
                });

                videoElement.addEventListener('play', () => {
                    isVideoPlaying = true;
                    playIcon.className = "fa-solid fa-pause";
                });

                videoElement.addEventListener('pause', () => {
                    isVideoPlaying = false;
                    playIcon.className = "fa-solid fa-play";
                });

                videoElement.addEventListener('ended', () => {
                    isVideoPlaying = false;
                    playIcon.className = "fa-solid fa-play";
                    handleVideoEnded();
                });
            }

            // Play/Pause Action
            playPauseBtn.addEventListener('click', toggleVideoPlayback);

            function toggleVideoPlayback() {
                if (isYouTube && ytPlayer) {
                    if (isVideoPlaying) {
                        ytPlayer.pauseVideo();
                    } else {
                        ytPlayer.playVideo();
                    }
                } else if (videoElement) {
                    if (isVideoPlaying) {
                        videoElement.pause();
                    } else {
                        videoElement.play();
                    }
                }
            }

            // Skip Forward/Backward (Seek)
            document.getElementById('skip-forward-btn').addEventListener('click', () => seekRelative(5));
            document.getElementById('skip-back-btn').addEventListener('click', () => seekRelative(-5));

            function seekRelative(seconds) {
                let targetTime = currentPlaybackTime + seconds;
                if (targetTime < 0) targetTime = 0;
                if (targetTime > durationSeconds) targetTime = durationSeconds;
                
                seekToTime(targetTime);
            }

            function seekToTime(seconds) {
                if (isYouTube && ytPlayer && typeof ytPlayer.seekTo === 'function') {
                    ytPlayer.seekTo(seconds, true);
                } else if (videoElement) {
                    videoElement.currentTime = seconds;
                }
                currentPlaybackTime = seconds;
                seekTimeline.value = seconds;
                updateTimeTrackerDisplay(seconds, durationSeconds);
            }

            // Timeline slider changes
            seekTimeline.addEventListener('input', (e) => {
                const seconds = parseFloat(e.target.value);
                seekToTime(seconds);
            });

            // Playback Speed control
            speedSelector.addEventListener('change', (e) => {
                const speed = parseFloat(e.target.value);
                if (isYouTube && ytPlayer && typeof ytPlayer.setPlaybackRate === 'function') {
                    ytPlayer.setPlaybackRate(speed);
                    showToast("⚡ Kecepatan putar diatur ke " + speed + "x");
                } else if (videoElement) {
                    videoElement.playbackRate = speed;
                    showToast("⚡ Kecepatan putar diatur ke " + speed + "x");
                }
            });

            // Quality Badge event simulation
            qualitySelector.addEventListener('change', (e) => {
                const q = e.target.value;
                showToast("⚙️ Kualitas disesuaikan ke " + q + "p HD (Otomatis)");
            });

            // Fullscreen Mode
            fullscreenBtn.addEventListener('click', toggleFullscreen);

            function toggleFullscreen() {
                if (!document.fullscreenElement) {
                    if (playerWrapper.requestFullscreen) {
                        playerWrapper.requestFullscreen();
                    } else if (playerWrapper.webkitRequestFullscreen) {
                        playerWrapper.webkitRequestFullscreen();
                    } else if (playerWrapper.msRequestFullscreen) {
                        playerWrapper.msRequestFullscreen();
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                }
            }

            // Keyboard Shortcuts
            document.addEventListener('keydown', (e) => {
                // Ignore keyboard shortcuts if the user is typing in forms
                if (document.activeElement.tagName === 'INPUT' || document.activeElement.tagName === 'TEXTAREA') {
                    return;
                }

                if (e.code === 'Space') {
                    e.preventDefault();
                    toggleVideoPlayback();
                } else if (e.code === 'ArrowRight') {
                    e.preventDefault();
                    seekRelative(5);
                } else if (e.code === 'ArrowLeft') {
                    e.preventDefault();
                    seekRelative(-5);
                } else if (e.code === 'KeyF') {
                    e.preventDefault();
                    toggleFullscreen();
                }
            });

            // Captions display
            ccBtn.addEventListener('click', () => {
                isCaptionsActive = !isCaptionsActive;
                if (isCaptionsActive) {
                    ccBtn.classList.add('active');
                    captionsOverlay.style.display = 'block';
                    showToast("💬 Transkrip teks diaktifkan");
                } else {
                    ccBtn.classList.remove('active');
                    captionsOverlay.style.display = 'none';
                    showToast("💬 Transkrip teks dimatikan");
                }
            });

            // Auto Scrolling simulated captions text list based on seconds
            const captionTimeline = [
                { time: 0, text: "Selamat datang di Intellecta Smart Learning!" },
                { time: 5, text: "Dalam modul ini, kita akan menjelajahi konsep " + @json($enrichedVideo->category) },
                { time: 15, text: "Mari perhatikan diagram arsitektur fundamental di atas." },
                { time: 30, text: "Penting sekali untuk memisahkan domain logika komponen." },
                { time: 60, text: "Silakan buka source code latihan Anda di folder resource." },
                { time: 120, text: "Lakukan demonstrasi langsung dan coba modifikasi state-nya." },
                { time: 240, text: "Jika Anda mengalami error, ajukan pertanyaan di tab Discussion." }
            ];

            function updateCaptionsDisplay(seconds) {
                if (!isCaptionsActive) return;
                
                let activeCaption = "Menonton video...";
                for (let i = 0; i < captionTimeline.length; i++) {
                    if (seconds >= captionTimeline[i].time) {
                        activeCaption = captionTimeline[i].text;
                    }
                }
                captionsOverlay.innerText = activeCaption;
            }

            // 2. VIDEO ENDED & AUTOPLAY NEXT VIDEO
            function handleVideoEnded() {
                localStorage.removeItem(savedTimeKey); // Clear progress
                markActiveVideoAsCompletedLocally(videoId);
                
                showToast("🏆 Video selesai! Menambahkan progres.");
                
                if (autoplayCheckbox.checked) {
                    const currentIndex = playlistOrder.indexOf(videoId);
                    if (currentIndex !== -1 && currentIndex < playlistOrder.length - 1) {
                        const nextId = playlistOrder[currentIndex + 1];
                        showToast("⏭️ Auto-Play: Membuka video berikutnya dalam 3 detik...");
                        setTimeout(() => {
                            const nextCard = document.querySelector(`.playlist-item-card[data-id="${nextId}"]`);
                            if (nextCard) {
                                window.location.href = nextCard.getAttribute('data-url');
                            }
                        }, 3000);
                    } else {
                        showToast("🏁 Anda telah menyelesaikan playlist seri pembelajaran ini!");
                    }
                }
            }

            // 3. QUICK ACTIONS (LIKE, SAVE, SHARE, DOWNLOAD, COMPLETE)
            likeBtn.addEventListener('click', () => {
                isLiked = !isLiked;
                let countVal = parseInt(likeCount.innerText);
                if (isLiked) {
                    likeBtn.classList.add('liked');
                    likeIcon.className = "fa-solid fa-thumbs-up";
                    likeCount.innerText = countVal + 1;
                    showToast("💖 Menyukai video materi ini!");
                } else {
                    likeBtn.classList.remove('liked');
                    likeIcon.className = "fa-regular fa-thumbs-up";
                    likeCount.innerText = countVal - 1;
                }
            });

            playlistBtn.addEventListener('click', () => {
                isSaved = !isSaved;
                if (isSaved) {
                    playlistBtn.classList.add('saved');
                    playlistIcon.className = "fa-solid fa-folder-open";
                    showToast("📂 Disimpan ke Daftar Belajar Anda!");
                } else {
                    playlistBtn.classList.remove('saved');
                    playlistIcon.className = "fa-regular fa-folder-open";
                    showToast("📂 Dihapus dari Daftar Belajar Anda");
                }
            });

            shareBtn.addEventListener('click', () => {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    showToast("🔗 Tautan share berhasil disalin ke Clipboard!");
                }).catch(() => {
                    showToast("❌ Gagal menyalin link.");
                });
            });

            downloadBtn.addEventListener('click', () => {
                showToast("📥 Menyiapkan download materi kualitas HD untuk luring...");
            });

            stageCompleteBtn.addEventListener('click', () => {
                isStageCompleted = !isStageCompleted;
                toggleCompleteButtonState(isStageCompleted);
                
                // Toggle playlist item checkbox
                const checkbox = document.querySelector(`.playlist-item-checkbox[data-id="${videoId}"]`);
                if (checkbox) {
                    checkbox.checked = isStageCompleted;
                    handleCheckboxChange(videoId, isStageCompleted);
                }
            });

            function toggleCompleteButtonState(completed) {
                if (completed) {
                    stageCompleteBtn.classList.add('completed');
                    completeIcon.className = "fa-solid fa-circle-check";
                    completeText.innerText = "✓ Sudah Selesai";
                    showToast("🎉 Selamat! Selesai menonton materi ini.");
                } else {
                    stageCompleteBtn.classList.remove('completed');
                    completeIcon.className = "fa-regular fa-circle-check";
                    completeText.innerText = "Selesai Belajar";
                }
            }

            function markActiveVideoAsCompletedLocally(id) {
                isStageCompleted = true;
                toggleCompleteButtonState(true);
                const checkbox = document.querySelector(`.playlist-item-checkbox[data-id="${id}"]`);
                if (checkbox) {
                    checkbox.checked = true;
                    handleCheckboxChange(id, true);
                }
            }

            // 4. INTERACTIVE TABS CLICK STATE
            tabTriggers.forEach(trigger => {
                trigger.addEventListener('click', () => {
                    tabTriggers.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));

                    trigger.classList.add('active');
                    const targetId = trigger.getAttribute('data-target');
                    document.getElementById(targetId).classList.add('active');
                });
            });

            // 5. DISCUSSION QUESTIONS POSTING
            submitCommentBtn.addEventListener('click', () => {
                const commentText = commentTextArea.value.trim();
                if (commentText === '') {
                    showToast("⚠️ Silakan tulis pertanyaan terlebih dahulu.");
                    return;
                }

                // Append comment to thread
                const commentNode = document.createElement('div');
                commentNode.className = 'comment-node';
                commentNode.innerHTML = `
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Student') }}&background=7c3aed&color=fff" alt="User Avatar" class="comment-avatar">
                    <div class="comment-body">
                        <div class="comment-header-row">
                            <span class="commenter-name">{{ auth()->user()->name ?? 'Student User' }}</span>
                            <span class="comment-time">Baru saja</span>
                        </div>
                        <div class="comment-text">${escapeHtml(commentText)}</div>
                    </div>
                `;

                commentsContainer.insertBefore(commentNode, commentsContainer.firstChild);
                commentTextArea.value = '';
                showToast("💬 Pertanyaan terkirim ke forum diskusi!");
            });

            function escapeHtml(text) {
                return text
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            // 6. TIMESTAMPED NOTE NOTEPAD JUMP FUNCTION
            const notesStorageKey = `intellecta_notes_video_${videoId}`;
            let notesList = JSON.parse(localStorage.getItem(notesStorageKey)) || [];

            // Load saved notes on startup
            renderNotesList();

            saveNoteBtn.addEventListener('click', () => {
                const noteText = noteInputField.value.trim();
                if (noteText === '') {
                    showToast("⚠️ Catatan tidak boleh kosong.");
                    return;
                }

                // Capture current video timestamp
                const stampSeconds = Math.floor(currentPlaybackTime);
                const newNote = {
                    id: Date.now(),
                    timestamp: stampSeconds,
                    timestampStr: formatTime(stampSeconds),
                    text: noteText
                };

                notesList.push(newNote);
                // Sort notes by timestamp ascending
                notesList.sort((a, b) => a.timestamp - b.timestamp);
                
                localStorage.setItem(notesStorageKey, JSON.stringify(notesList));
                noteInputField.value = '';
                
                renderNotesList();
                showToast("📝 Catatan tersimpan pada menit " + newNote.timestampStr);
            });

            function renderNotesList() {
                notesContainer.innerHTML = '';
                
                if (notesList.length === 0) {
                    notesContainer.innerHTML = `
                        <div style="text-align: center; color: #9ca3af; font-size: 0.8rem; padding: 2rem 1rem;">
                            <i class="fa-regular fa-clipboard" style="font-size: 1.5rem; margin-bottom: 0.5rem; display: block;"></i>
                            Belum ada catatan timestamp. Tulis poin penting saat video berputar!
                        </div>
                    `;
                    return;
                }

                notesList.forEach(note => {
                    const noteItem = document.createElement('div');
                    noteItem.className = 'note-item';
                    noteItem.innerHTML = `
                        <div class="note-stamp-text">
                            <span class="timestamp-badge" data-time="${note.timestamp}">
                                <i class="fa-solid fa-play" style="font-size: 0.65rem;"></i> ${note.timestampStr}
                            </span>
                            <span class="note-content-string">${escapeHtml(note.text)}</span>
                        </div>
                        <button class="btn-delete-note" data-id="${note.id}" title="Hapus Catatan">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    `;
                    notesContainer.appendChild(noteItem);
                });

                // Attach click listeners to timestamps to jump the player
                const timestampBadges = notesContainer.querySelectorAll('.timestamp-badge');
                timestampBadges.forEach(badge => {
                    badge.addEventListener('click', (e) => {
                        const targetSeconds = parseFloat(badge.getAttribute('data-time'));
                        seekToTime(targetSeconds);
                        
                        // Force playing
                        if (isYouTube && ytPlayer && typeof ytPlayer.playVideo === 'function') {
                            ytPlayer.playVideo();
                        } else if (videoElement) {
                            videoElement.play();
                        }
                        
                        showToast("🕒 Melompat ke menit " + formatTime(targetSeconds));
                    });
                });

                // Attach click listeners to delete notes
                const deleteButtons = notesContainer.querySelectorAll('.btn-delete-note');
                deleteButtons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const noteId = parseFloat(btn.getAttribute('data-id'));
                        notesList = notesList.filter(n => n.id !== noteId);
                        localStorage.setItem(notesStorageKey, JSON.stringify(notesList));
                        renderNotesList();
                        showToast("🗑️ Catatan berhasil dihapus.");
                    });
                });
            }

            // 7. PLAYLIST SIDEBAR COMPLETE & PROGRESS AUTO-UPDATE
            const playlistStorageKey = 'intellecta_completed_videos_series';
            let completedPlaylistIds = JSON.parse(localStorage.getItem(playlistStorageKey)) || [];

            // Initialize checkboxes on load
            playlistCheckboxes.forEach(box => {
                const id = parseInt(box.getAttribute('data-id'));
                const isCompleted = completedPlaylistIds.includes(id);
                box.checked = isCompleted;
                
                if (id === videoId) {
                    isStageCompleted = isCompleted;
                    toggleCompleteButtonState(isStageCompleted);
                }

                box.addEventListener('change', (e) => {
                    handleCheckboxChange(id, e.target.checked);
                    if (id === videoId) {
                        isStageCompleted = e.target.checked;
                        toggleCompleteButtonState(isStageCompleted);
                    }
                });
            });

            function handleCheckboxChange(id, checked) {
                if (checked) {
                    if (!completedPlaylistIds.includes(id)) {
                        completedPlaylistIds.push(id);
                    }
                } else {
                    completedPlaylistIds = completedPlaylistIds.filter(item => item !== id);
                }
                localStorage.setItem(playlistStorageKey, JSON.stringify(completedPlaylistIds));
                updatePlaylistProgressBar();
            }

            function updatePlaylistProgressBar() {
                const totalItems = playlistCheckboxes.length;
                if (totalItems === 0) return;
                
                const completedCount = completedPlaylistIds.length;
                const percentage = Math.round((completedCount / totalItems) * 100);
                
                playlistProgressPercentage.innerText = `${completedCount} dari ${totalItems} Selesai (${percentage}%)`;
                playlistProgressFillBar.style.width = `${percentage}%`;
            }

            // Initialize progress bar on load
            updatePlaylistProgressBar();

            // Clicking playlist cards to navigate between videos
            playlistCards.forEach(card => {
                card.addEventListener('click', (e) => {
                    // Prevent navigation click if clicking the checkbox input directly
                    if (e.target.tagName === 'INPUT') return;
                    
                    window.location.href = card.getAttribute('data-url');
                });
            });

            // Helpers: formatting time (seconds -> MM:SS)
            function formatTime(seconds) {
                const m = Math.floor(seconds / 60);
                const s = Math.floor(seconds % 60);
                return `${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
            }

            function updateTimeTrackerDisplay(current, total) {
                timeCounter.innerText = `${formatTime(current)} / ${formatTime(total)}`;
            }
        });

        // 8. TOAST SYSTEM
        function showToast(message) {
            const container = document.getElementById('toast-container-box');
            
            const toast = document.createElement('div');
            toast.className = 'glass-toast';
            toast.innerHTML = `<i class="fa-solid fa-circle-info" style="color: #c4b5fd;"></i> ${message}`;
            
            container.appendChild(toast);
            
            // Trigger animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 10);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 3000);
        }

        // Global simulation downloader
        function triggerDownload(itemName) {
            showToast(`📥 Mengunduh ${itemName}...`);
        }
    </script>
</body>
</html>
