<aside class="sidebar">
    <div class="sidebar-logo">Intellecta</div>
    <div class="sidebar-subtitle">Teacher Panel</div>
    <ul class="sidebar-menu">
        <li class="sidebar-menu-item">
            <a href="{{ route('teacher.quizzes.index') }}" class="sidebar-menu-link {{ ($active ?? '') === 'quizzes' ? 'active' : '' }}">Kelola Kuis</a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('teacher.materi.index') }}" class="sidebar-menu-link {{ ($active ?? '') === 'materi' ? 'active' : '' }}">Upload Materi</a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('teacher.live-sessions.index') }}" class="sidebar-menu-link {{ ($active ?? '') === 'live-sessions' ? 'active' : '' }}">Kelas Live</a>
        </li>
        <li class="sidebar-menu-item">
            <a href="{{ route('teacher.feedbacks.index') }}" class="sidebar-menu-link {{ ($active ?? '') === 'feedbacks' ? 'active' : '' }}">Feedback</a>
        </li>
        <li class="sidebar-menu-item" style="margin-top: 2rem;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-menu-link" style="width: 100%; border: none; background: none; text-align: left; cursor: pointer; color: #ef4444;">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</aside>
