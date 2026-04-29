<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Register</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div class="auth-container">
        <!-- Left Side - Purple Gradient -->
        <div class="auth-left active">
            <div class="auth-left-content">
                <!-- Logo -->
                <div class="auth-logo">
                    <div class="auth-logo-icon">i</div>
                    <div class="auth-logo-text">Intellecta</div>
                </div>

                <!-- Main Heading -->
                <h2 class="auth-heading">Mulailah Perjalanan<br>Kecerdasan Anda</h2>
                <p class="auth-description">
                    Bergabunglah dengan komunitas pembelajar cerdas dan akses ribuan materi edukatif berkualitas tinggi yang dirancang khusus untuk Anda.
                </p>
            </div>

            <!-- Image Section -->
            <div style="position: relative; z-index: 10; margin-bottom: 2rem;">
                <div style="background: rgba(255,255,255,0.1); border-radius: 0.5rem; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); height: 160px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 2rem;">👥 📊 📈</span>
                </div>
            </div>

            <!-- Footer -->
            <div class="auth-footer">
                <div class="auth-avatars">
                    <div class="auth-avatar">A</div>
                    <div class="auth-avatar">B</div>
                    <div class="auth-avatar">C</div>
                </div>
                <p class="auth-footer-text">Lihat Pengguna Aktif</p>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="auth-right">
            <div class="auth-form-wrapper">
                <!-- Welcome Text -->
                <h3 class="auth-form-title">Buat Akun Baru</h3>
                <p class="auth-form-subtitle">Selamat datang di Intellecta! Isi detail di bawah ini.</p>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="auth-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    <!-- Full Name -->
                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Nama lengkap Anda"
                                class="form-input"
                            />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                placeholder="contoh@gmail.com"
                                class="form-input"
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Kata Sandi</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="form-input"
                            />
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="••••••••"
                                class="form-input"
                            />
                        </div>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="btn btn-primary">
                        Lanjutkan →
                    </button>

                    <!-- Divider -->
                    <div class="form-divider">
                        <span class="form-divider-text">ATAU DAFTAR DENGAN</span>
                    </div>

                    <!-- Social Register -->
                    <div class="social-buttons full">
                        <button type="button" class="btn btn-social">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Google
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <p class="form-footer">
                    Sudah punya akun?
                    <a href="{{ route('login') }}">
                        Masuk
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
