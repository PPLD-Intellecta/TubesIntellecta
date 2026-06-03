<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - {{ $quiz->title }}</title>
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
        .navbar-left { display: flex; align-items: center; gap: 2rem; }
        .navbar-logo { font-size: 1.4rem; font-weight: 800; color: #5b21b6; text-decoration: none; }
        .navbar-links { display: flex; gap: 2rem; align-items: center; }
        .navbar-links a { text-decoration: none; color: #6b7280; font-size: 0.9rem; font-weight: 500; transition: color 0.2s; }
        .navbar-links a.active { color: #5b21b6; border-bottom: 2px solid #5b21b6; padding-bottom: 2px; }
        .navbar-right { display: flex; align-items: center; gap: 1.5rem; }

        /* Timer */
        .timer {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: #1a1a2e;
        }
        .timer-icon {
            width: 32px; height: 32px;
            background: #5b21b6;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 0.8rem;
        }
        .timer-label { font-size: 0.65rem; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.08em; }

        /* Main Layout */
        .main {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 0 3rem;
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 2rem;
            align-items: start;
        }

        /* Header */
        .quiz-header { margin-bottom: 2rem; }
        .quiz-module-tag { font-size: 0.7rem; font-weight: 700; color: #7c3aed; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.5rem; background: #ede9fe; display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; }
        .quiz-main-title { font-size: 2rem; font-weight: 800; margin-bottom: 0.25rem; }
        .quiz-progress-bar-wrap { margin-top: 1.25rem; }
        .quiz-progress-info { display: flex; justify-content: space-between; font-size: 0.8rem; color: #6b7280; margin-bottom: 0.5rem; }
        .quiz-progress-info strong { color: #5b21b6; }
        .progress-bar { height: 6px; background: #e8e4ff; border-radius: 9999px; overflow: hidden; }
        .progress-fill { height: 100%; background: linear-gradient(90deg, #5b21b6, #a78bfa); border-radius: 9999px; transition: width 0.4s ease; }

        /* Question Card */
        .question-card {
            background: white;
            border-radius: 1.25rem;
            padding: 2rem;
            border: 1.5px solid #e8e4ff;
            margin-bottom: 1.5rem;
        }
        .question-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px; height: 36px;
            background: #5b21b6;
            color: white;
            border-radius: 0.5rem;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        .question-text { font-size: 1.1rem; font-weight: 600; line-height: 1.6; margin-bottom: 1.5rem; color: #1a1a2e; }

        /* Option */
        .option-label {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            border: 1.5px solid #e8e4ff;
            border-radius: 0.875rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .option-label:hover { border-color: #a78bfa; background: #faf5ff; }
        .option-label input[type="radio"] { display: none; }
        .option-label input[type="radio"]:checked + .option-letter { background: #5b21b6; color: white; border-color: #5b21b6; }
        .option-label:has(input:checked) { border-color: #5b21b6; background: #faf5ff; }
        .option-letter {
            width: 32px; height: 32px;
            border-radius: 50%;
            border: 1.5px solid #d1d5db;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
            font-size: 0.8rem;
            flex-shrink: 0;
            transition: all 0.2s;
            color: #6b7280;
        }
        .option-text { font-size: 0.9rem; color: #374151; }

        /* Navigation Buttons */
        .nav-buttons { display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; }
        .btn-prev {
            display: flex; align-items: center; gap: 0.5rem;
            background: white; border: 1.5px solid #e5e7eb;
            color: #374151; padding: 0.75rem 1.5rem;
            border-radius: 0.75rem; font-weight: 600;
            font-size: 0.875rem; cursor: pointer; font-family: inherit;
            transition: all 0.2s;
        }
        .btn-prev:hover { border-color: #5b21b6; color: #5b21b6; }
        .btn-next {
            display: flex; align-items: center; gap: 0.5rem;
            background: #5b21b6; color: white;
            border: none; padding: 0.75rem 1.75rem;
            border-radius: 0.75rem; font-weight: 600;
            font-size: 0.875rem; cursor: pointer; font-family: inherit;
            transition: background 0.2s;
        }
        .btn-next:hover { background: #4c1d95; }
        .btn-submit {
            display: flex; align-items: center; gap: 0.5rem;
            background: #059669; color: white;
            border: none; padding: 0.75rem 1.75rem;
            border-radius: 0.75rem; font-weight: 600;
            font-size: 0.875rem; cursor: pointer; font-family: inherit;
            transition: background 0.2s;
        }
        .btn-submit:hover { background: #047857; }

        /* Right Sidebar */
        .sidebar-right { position: sticky; top: 80px; }
        .navigator-card {
            background: white;
            border-radius: 1.25rem;
            padding: 1.5rem;
            border: 1.5px solid #e8e4ff;
            margin-bottom: 1.25rem;
        }
        .navigator-title { font-size: 0.9rem; font-weight: 700; margin-bottom: 1.25rem; color: #1a1a2e; }
        .navigator-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 0.5rem; margin-bottom: 1.25rem; }
        .nav-btn {
            width: 36px; height: 36px;
            border-radius: 0.5rem;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            border: none;
        }
        .nav-btn.answered { background: #5b21b6; color: white; }
        .nav-btn.current { background: #7c3aed; color: white; box-shadow: 0 0 0 3px #c4b5fd; }
        .nav-btn.flagged { background: #fbbf24; color: #1a1a2e; }
        .nav-btn.unanswered { background: #f3f4f6; color: #6b7280; }
        .nav-legend { display: flex; flex-direction: column; gap: 0.5rem; }
        .legend-item { display: flex; align-items: center; gap: 0.5rem; font-size: 0.75rem; color: #6b7280; }
        .legend-dot { width: 10px; height: 10px; border-radius: 50%; }
        .legend-dot.answered { background: #5b21b6; }
        .legend-dot.flagged { background: #fbbf24; }
        .legend-dot.unanswered { background: #d1d5db; }

        /* Help Card */
        .help-card {
            background: white;
            border-radius: 1.25rem;
            padding: 1.5rem;
            border: 1.5px solid #e8e4ff;
        }
        .help-title { font-size: 0.9rem; font-weight: 700; margin-bottom: 0.5rem; }
        .help-text { font-size: 0.8rem; color: #9ca3af; line-height: 1.6; margin-bottom: 1rem; }
        .btn-review { display: flex; align-items: center; gap: 0.5rem; color: #7c3aed; font-size: 0.8rem; font-weight: 600; text-decoration: none; }

        /* Footer */
        footer { text-align: center; padding: 2rem; font-size: 0.75rem; color: #9ca3af; margin-top: 2rem; border-top: 1px solid #e8e4ff; }
        .footer-links { display: flex; justify-content: center; gap: 2rem; margin-top: 0.5rem; }
        .footer-links a { color: #9ca3af; text-decoration: none; }

        /* Empty state */
        .empty-quiz { text-align: center; padding: 3rem; background: white; border-radius: 1.25rem; border: 1.5px solid #e8e4ff; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('dashboard') }}" class="navbar-logo">Intellecta</a>
            <div class="navbar-links">
                <a href="{{ route('student.quizzes.index') }}" class="active">My Courses</a>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('subscription.index') }}">Resources</a>
                <a href="{{ route('student.feedbacks.index') }}">Feedback</a>
            </div>
        </div>
        <div class="navbar-right">
            @if($quiz->questions->count() > 0)
            <div>
                <div class="timer-label">Time Remaining</div>
                <div class="timer">
                    <span id="timer-display">30:00</span>
                    <div class="timer-icon">⏱</div>
                </div>
            </div>
            @endif
        </div>
    </nav>

    @if($quiz->questions->count() > 0)
    <form action="{{ route('student.quizzes.submit', $quiz) }}" method="POST" id="quiz-form">
        @csrf
        <div class="main">
            <!-- Left: Questions -->
            <div>
                <div class="quiz-header">
                    <div class="quiz-module-tag">Kuis Evaluasi</div>
                    <h1 class="quiz-main-title">{{ $quiz->title }}</h1>
                    <div class="quiz-progress-bar-wrap">
                        <div class="quiz-progress-info">
                            <span>Question <strong id="current-q-label">1</strong> of {{ $quiz->questions->count() }}</span>
                            <strong id="percent-label">0% Complete</strong>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" id="progress-fill" style="width: {{ round(1 / $quiz->questions->count() * 100) }}%"></div>
                        </div>
                    </div>
                </div>

                @foreach($quiz->questions as $qIndex => $question)
                <div class="question-card" id="question-{{ $qIndex }}" style="{{ $qIndex > 0 ? 'display:none;' : '' }}">
                    <div class="question-number">{{ $qIndex + 1 }}</div>
                    <div class="question-text">{{ $question->question_text }}</div>
                    @php $letters = ['A', 'B', 'C', 'D', 'E']; @endphp
                    @foreach($question->options as $oIndex => $option)
                    <label class="option-label" for="opt-{{ $question->id }}-{{ $option->id }}">
                        <input type="radio" id="opt-{{ $question->id }}-{{ $option->id }}" name="answers[{{ $question->id }}]" value="{{ $option->id }}" onchange="markAnswered({{ $qIndex }})">
                        <div class="option-letter">{{ $letters[$oIndex] ?? $oIndex+1 }}</div>
                        <div class="option-text">{{ $option->option_text }}</div>
                    </label>
                    @endforeach
                </div>
                @endforeach

                <!-- Navigation Buttons -->
                <div class="nav-buttons">
                    <button type="button" class="btn-prev" id="btn-prev" onclick="prevQuestion()" style="visibility: hidden;">← Previous Question</button>
                    <button type="button" class="btn-next" id="btn-next" onclick="nextQuestion()">Save and Continue →</button>
                    <button type="submit" class="btn-submit" id="btn-submit" style="display:none;">Kumpulkan Jawaban ✓</button>
                </div>
            </div>

            <!-- Right: Navigator -->
            <div class="sidebar-right">
                <div class="navigator-card">
                    <div class="navigator-title">Question Navigator</div>
                    <div class="navigator-grid" id="navigator-grid">
                        @foreach($quiz->questions as $qIndex => $question)
                        <button type="button" class="nav-btn {{ $qIndex === 0 ? 'current' : 'unanswered' }}" id="nav-{{ $qIndex }}" onclick="goToQuestion({{ $qIndex }})">{{ $qIndex + 1 }}</button>
                        @endforeach
                    </div>
                    <div class="nav-legend">
                        <div class="legend-item"><div class="legend-dot answered"></div> Answered</div>
                        <div class="legend-dot flagged" style="display:none;"></div>
                        <div class="legend-item"><div class="legend-dot unanswered"></div> Unanswered</div>
                    </div>
                </div>
                <div class="help-card">
                    <div class="help-title">Need help?</div>
                    <div class="help-text">If you're stuck, you can revisit the course materials related to this topic.</div>
                    <a href="{{ route('student.quizzes.index') }}" class="btn-review">📚 Review Resources</a>
                </div>
            </div>
        </div>
    </form>
    @else
    <div class="main">
        <div class="empty-quiz">
            <div style="font-size: 3rem; margin-bottom: 1rem;">⚠️</div>
            <h3>Kuis Belum Ada Soal</h3>
            <p style="color:#9ca3af; margin-top: 0.5rem;">Pengajar belum menambahkan pertanyaan ke kuis ini.</p>
            <a href="{{ route('student.quizzes.index') }}" style="display:inline-block; margin-top: 1.5rem; background:#5b21b6; color:white; padding: 0.75rem 1.5rem; border-radius:0.75rem; text-decoration:none; font-weight:600;">← Kembali ke Daftar Kuis</a>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer>
        Intellecta © 2024 Intellecta Editorial Learning. All Rights Reserved.
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Accessibility</a>
            <a href="#">Contact Support</a>
        </div>
    </footer>

    <script>
        const totalQuestions = {{ $quiz->questions->count() }};
        let currentQuestion = 0;
        const answered = new Array(totalQuestions).fill(false);

        function showQuestion(index) {
            // Hide all
            for (let i = 0; i < totalQuestions; i++) {
                const el = document.getElementById('question-' + i);
                if (el) el.style.display = 'none';
                const nav = document.getElementById('nav-' + i);
                if (nav) {
                    if (answered[i]) { nav.className = 'nav-btn answered'; }
                    else { nav.className = 'nav-btn unanswered'; }
                }
            }

            // Show current
            const curr = document.getElementById('question-' + index);
            if (curr) curr.style.display = 'block';
            const currNav = document.getElementById('nav-' + index);
            if (currNav) currNav.className = 'nav-btn current';

            // Update progress
            const pct = Math.round((index + 1) / totalQuestions * 100);
            document.getElementById('current-q-label').textContent = index + 1;
            document.getElementById('percent-label').textContent = pct + '% Complete';
            document.getElementById('progress-fill').style.width = pct + '%';

            // Buttons
            document.getElementById('btn-prev').style.visibility = index === 0 ? 'hidden' : 'visible';
            if (index === totalQuestions - 1) {
                document.getElementById('btn-next').style.display = 'none';
                document.getElementById('btn-submit').style.display = 'flex';
            } else {
                document.getElementById('btn-next').style.display = 'flex';
                document.getElementById('btn-submit').style.display = 'none';
            }

            currentQuestion = index;
        }

        function nextQuestion() { if (currentQuestion < totalQuestions - 1) showQuestion(currentQuestion + 1); }
        function prevQuestion() { if (currentQuestion > 0) showQuestion(currentQuestion - 1); }
        function goToQuestion(index) { showQuestion(index); }
        function markAnswered(index) { answered[index] = true; }

        // Timer (30 minutes)
        let timeLeft = 30 * 60;
        const timerEl = document.getElementById('timer-display');
        if (timerEl) {
            const timerInterval = setInterval(() => {
                timeLeft--;
                const m = Math.floor(timeLeft / 60).toString().padStart(2, '0');
                const s = (timeLeft % 60).toString().padStart(2, '0');
                timerEl.textContent = m + ':' + s;
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById('quiz-form').submit();
                }
                if (timeLeft <= 300) timerEl.style.color = '#ef4444'; // red when < 5min
            }, 1000);
        }
    </script>
</body>
</html>
