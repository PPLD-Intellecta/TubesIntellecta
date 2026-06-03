<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intellecta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .container {
            display: flex;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #1e293b;
            color: white;
            height: 100vh;
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #cbd5f5;
            padding: 10px;
            text-decoration: none;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background: #334155;
        }

        /* MAIN */
        .main {
            flex: 1;
            padding: 20px;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .search {
            padding: 8px;
            width: 250px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        /* CONTENT */
        .content {
            display: flex;
            gap: 20px;
        }

        .left {
            flex: 2;
        }

        .right {
            flex: 1;
        }

        /* CARD */
        .card {
            background: white;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .card h4 {
            margin: 0 0 10px;
        }

        .badge {
            background: #10b981;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .btn {
            background: #10b981;
            color: white;
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }

        .right .card {
            text-align: center;
        }

        /* LOGOUT BUTTON STYLE */
        .logout-btn {
            background: none;
            border: none;
            color: #cbd5f5;
            padding: 10px;
            width: 100%;
            text-align: left;
            cursor: pointer;
            border-radius: 8px;
        }

        .logout-btn:hover {
            background: #334155;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Intellecta</h2>

        <a href="#">Dashboard</a>
        <a href="#">Kursus</a>
        <a href="#">Tugas</a>
        <a href="#">Sumber Daya</a>
        <a href="/forum">Pesan</a>
        
        @if(auth()->check() && auth()->user()->role == 'admin')
            <a href="{{ route('admin.news.index') }}">Berita (Admin)</a>
        @endif
        @if(auth()->check() && auth()->user()->role == 'student')
            <a href="{{ route('student.news.index') }}">Berita & Pengumuman</a>
        @endif

        <hr>

        <a href="#">AI Tutor</a>
        <a href="#">Riset</a>
        <a href="#">Frontend</a>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- NAVBAR -->
        <div class="navbar">
            <input type="text" class="search" placeholder="Cari diskusi...">

            <!-- USER NAME -->
            <div>
                👤 
                @auth
                    {{ Auth::user()->name }}
                @else
                    Guest
                @endauth
            </div>
        </div>

        @yield('content')

    </div>

</div>

</body>
</html>