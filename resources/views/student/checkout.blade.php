<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intellecta - Checkout</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f3ff; color: #1a1a2e; min-height: 100vh; display: flex; flex-direction: column; }

        /* Navbar */
        .navbar {
            background: white;
            border-bottom: 1px solid #e8e4ff;
            padding: 0 3rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 64px;
        }
        .navbar-logo { font-size: 1.4rem; font-weight: 800; color: #5b21b6; text-decoration: none; }
        .navbar-links { display: flex; gap: 2rem; }
        .navbar-links a { text-decoration: none; color: #6b7280; font-size: 0.9rem; font-weight: 500; }
        .navbar-links a.active { color: #5b21b6; border-bottom: 2px solid #5b21b6; padding-bottom: 4px; }
        .navbar-right { display: flex; align-items: center; gap: 1rem; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #5b21b6, #a78bfa); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.875rem; }

        /* Main layout */
        .main {
            flex: 1;
            max-width: 1100px;
            margin: 3rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 3rem;
            align-items: start;
            width: 100%;
        }

        /* Left: Form */
        .checkout-title { font-size: 2rem; font-weight: 800; margin-bottom: 0.25rem; }
        .checkout-sub { color: #6b7280; font-size: 0.9rem; margin-bottom: 2rem; }

        /* Payment method tabs */
        .payment-tabs { display: flex; background: #f3f0ff; border-radius: 2rem; padding: 4px; gap: 4px; margin-bottom: 2rem; width: fit-content; }
        .payment-tab {
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            border: none;
            background: transparent;
            color: #6b7280;
            font-family: inherit;
            transition: all 0.2s;
        }
        .payment-tab.active { background: white; color: #1a1a2e; font-weight: 600; box-shadow: 0 1px 4px rgba(0,0,0,0.1); }

        /* Form sections */
        .form-section { margin-bottom: 1.75rem; }
        .form-label { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #9ca3af; margin-bottom: 0.75rem; display: block; }
        .form-group { background: white; border-radius: 0.875rem; border: 1.5px solid #e8e4ff; overflow: hidden; }
        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: none;
            font-family: inherit;
            font-size: 0.9rem;
            color: #374151;
            outline: none;
            background: transparent;
        }
        .form-input::placeholder { color: #d1d5db; }
        .form-input-row { display: grid; grid-template-columns: 1fr 1fr; }
        .form-input-row .form-input:first-child { border-right: 1.5px solid #e8e4ff; }
        .form-input-icon { display: flex; align-items: center; padding: 0 1rem; gap: 0.5rem; }
        .form-input-icon .icon { color: #d1d5db; }
        .form-divider { height: 1.5px; background: #e8e4ff; }

        /* Bank options */
        .bank-option {
            display: flex; align-items: center; gap: 1rem;
            padding: 1rem 1.25rem;
            cursor: pointer;
        }
        .bank-option + .bank-option { border-top: 1.5px solid #e8e4ff; }
        .bank-radio { width: 18px; height: 18px; accent-color: #5b21b6; }
        .bank-logo { font-size: 1.25rem; }
        .bank-name { font-size: 0.9rem; font-weight: 600; }
        .bank-number { font-size: 0.8rem; color: #6b7280; }
        .bank-copy { margin-left: auto; font-size: 0.75rem; color: #5b21b6; font-weight: 600; cursor: pointer; }

        /* Submit button */
        .btn-pay {
            width: 100%;
            background: linear-gradient(135deg, #5b21b6, #7c3aed);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 0.875rem;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            transition: opacity 0.2s;
            margin-top: 1.5rem;
        }
        .btn-pay:hover { opacity: 0.9; }

        /* Trust badges */
        .trust-badges { display: flex; gap: 2rem; justify-content: center; margin-top: 1.25rem; }
        .trust-badge { display: flex; align-items: center; gap: 0.4rem; font-size: 0.72rem; color: #9ca3af; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em; }

        /* Right: Order Summary */
        .order-card { background: white; border-radius: 1.25rem; border: 1.5px solid #e8e4ff; overflow: hidden; }
        .order-thumb {
            height: 180px;
            background: linear-gradient(135deg, #0d9488 0%, #5b21b6 100%);
            display: flex; align-items: center; justify-content: center;
            font-size: 3rem;
            position: relative;
        }
        .order-thumb-text {
            position: absolute;
            top: 1.25rem; left: 1.25rem;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            color: white;
            font-weight: 800;
            font-size: 1.1rem;
            letter-spacing: 0.05em;
        }
        .order-body { padding: 1.5rem; }
        .order-badge { display: inline-block; background: #ede9fe; color: #5b21b6; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.75rem; }
        .order-price { font-size: 1.75rem; font-weight: 800; color: #5b21b6; float: right; }
        .order-name { font-size: 1.1rem; font-weight: 700; margin-bottom: 1.25rem; }
        .order-features { list-style: none; margin-bottom: 1.5rem; display: flex; flex-direction: column; gap: 0.75rem; }
        .order-features li { display: flex; align-items: flex-start; gap: 0.75rem; font-size: 0.875rem; }
        .order-feature-icon { width: 32px; height: 32px; border-radius: 0.5rem; background: #f3f0ff; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0; }
        .order-feature-text strong { display: block; font-weight: 600; color: #1a1a2e; }
        .order-feature-text span { font-size: 0.75rem; color: #9ca3af; }
        .order-divider { height: 1px; background: #f3f4f6; margin: 1.25rem 0; }
        .order-row { display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 0.5rem; }
        .order-row span:first-child { color: #6b7280; }
        .order-row.discount span:last-child { color: #10b981; font-weight: 600; }
        .order-total { display: flex; justify-content: space-between; font-weight: 700; font-size: 1rem; margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1.5px solid #e8e4ff; }

        /* Testimonial */
        .testimonial-card {
            background: #f5f3ff;
            border-radius: 1.25rem;
            padding: 1.5rem;
            margin-top: 1.25rem;
            border: 1.5px solid #e8e4ff;
        }
        .testimonial-text { font-size: 0.875rem; color: #374151; font-style: italic; line-height: 1.6; margin-bottom: 1rem; }
        .testimonial-author { display: flex; align-items: center; gap: 0.75rem; }
        .testimonial-avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, #5b21b6, #a78bfa); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.8rem; }
        .testimonial-name { font-size: 0.875rem; font-weight: 600; }
        .testimonial-role { font-size: 0.75rem; color: #9ca3af; }

        /* Tab content */
        .tab-content { display: none; }
        .tab-content.active { display: block; }

        /* Footer */
        footer { text-align: center; padding: 1.5rem; font-size: 0.75rem; color: #9ca3af; border-top: 1px solid #e8e4ff; background: white; margin-top: 3rem; }
        .footer-links { display: flex; justify-content: center; gap: 2rem; margin-top: 0.5rem; }
        .footer-links a { color: #9ca3af; text-decoration: none; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.05em; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="navbar-logo">Intellecta</a>
        <div class="navbar-links">
            <a href="{{ route('student.quizzes.index') }}">Courses</a>
            <a href="{{ route('subscription.index') }}">Resources</a>
            <a href="{{ route('student.feedbacks.index') }}">Feedback</a>
            <a href="{{ route('subscription.checkout') }}" class="active">Checkout</a>
        </div>
        <div class="navbar-right">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        </div>
    </nav>

    <div class="main">
        <!-- Left: Checkout Form -->
        <div>
            <h1 class="checkout-title">Complete Your Enrollment</h1>
            <p class="checkout-sub">Secure your spot in the Professional Learning Track.</p>

            <!-- Payment Tabs -->
            <div class="payment-tabs">
                <button class="payment-tab active" onclick="switchTab('credit')">💳 Credit Card</button>
                <button class="payment-tab" onclick="switchTab('wallet')">📱 Digital Wallet</button>
                <button class="payment-tab" onclick="switchTab('bank')">🏦 Bank Transfer</button>
            </div>

            <!-- Credit Card Form -->
            <form action="{{ route('subscription.upgrade') }}" method="POST" id="credit-form">
                @csrf

                <!-- Credit Card Tab -->
                <div class="tab-content active" id="tab-credit">
                    <div class="form-section">
                        <label class="form-label">Card Information</label>
                        <div class="form-group">
                            <div class="form-input-icon">
                                <span class="icon">💳</span>
                                <input type="text" class="form-input" placeholder="0000 0000 0000 0000" maxlength="19" oninput="formatCard(this)">
                            </div>
                            <div class="form-divider"></div>
                            <div class="form-input-row">
                                <div class="form-input-icon">
                                    <span class="icon">📅</span>
                                    <input type="text" class="form-input" placeholder="MM / YY" maxlength="5" oninput="formatExpiry(this)">
                                </div>
                                <div class="form-input-icon">
                                    <span class="icon">🔒</span>
                                    <input type="text" class="form-input" placeholder="CVV" maxlength="3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <label class="form-label">Cardholder Name</label>
                        <div class="form-group">
                            <div class="form-input-icon">
                                <span class="icon">👤</span>
                                <input type="text" class="form-input" placeholder="{{ auth()->user()->name }}" value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Digital Wallet Tab -->
                <div class="tab-content" id="tab-wallet">
                    <div class="form-section">
                        <label class="form-label">Pilih E-Wallet</label>
                        <div class="form-group">
                            <label class="bank-option">
                                <input type="radio" class="bank-radio" name="wallet" value="gopay" checked>
                                <span class="bank-logo">🟢</span>
                                <div>
                                    <div class="bank-name">GoPay</div>
                                    <div class="bank-number">Bayar via GoPay</div>
                                </div>
                            </label>
                            <label class="bank-option">
                                <input type="radio" class="bank-radio" name="wallet" value="ovo">
                                <span class="bank-logo">🟣</span>
                                <div>
                                    <div class="bank-name">OVO</div>
                                    <div class="bank-number">Bayar via OVO</div>
                                </div>
                            </label>
                            <label class="bank-option">
                                <input type="radio" class="bank-radio" name="wallet" value="dana">
                                <span class="bank-logo">🔵</span>
                                <div>
                                    <div class="bank-name">DANA</div>
                                    <div class="bank-number">Bayar via DANA</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Bank Transfer Tab -->
                <div class="tab-content" id="tab-bank">
                    <div class="form-section">
                        <label class="form-label">Transfer ke Rekening</label>
                        <div class="form-group">
                            <div class="bank-option">
                                <span class="bank-logo">🏦</span>
                                <div>
                                    <div class="bank-name">BCA</div>
                                    <div class="bank-number">1234 5678 9012 — a/n Intellecta Indonesia</div>
                                </div>
                                <span class="bank-copy" onclick="copyText('1234567890012')">Salin</span>
                            </div>
                            <div class="bank-option">
                                <span class="bank-logo">🏛️</span>
                                <div>
                                    <div class="bank-name">Mandiri</div>
                                    <div class="bank-number">9876 5432 1098 — a/n Intellecta Indonesia</div>
                                </div>
                                <span class="bank-copy" onclick="copyText('9876543210098')">Salin</span>
                            </div>
                        </div>
                        <p style="margin-top: 0.75rem; font-size: 0.8rem; color: #9ca3af;">Setelah transfer, klik tombol di bawah untuk konfirmasi pembayaran simulasi.</p>
                    </div>
                </div>

                <button type="submit" class="btn-pay">
                    🔒 Bayar Rp49.000 Securely
                </button>
            </form>

            <!-- Trust Badges -->
            <div class="trust-badges">
                <div class="trust-badge">🔒 SSL Secured</div>
                <div class="trust-badge">✅ PCI Compliant</div>
                <div class="trust-badge">💰 Money Back Guarantee</div>
            </div>
        </div>

        <!-- Right: Order Summary -->
        <div>
            <div class="order-card">
                <div class="order-thumb">
                    <div class="order-thumb-text">INTELLECTA</div>
                    🚀
                </div>
                <div class="order-body">
                    <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom: 0.75rem;">
                        <span class="order-badge">PREMIUM PLAN</span>
                        <span class="order-price">Rp49k<small style="font-size:0.875rem; font-weight:400; color:#9ca3af;">/bln</small></span>
                    </div>
                    <div class="order-name">Intellecta Pro</div>

                    <ul class="order-features">
                        <li>
                            <div class="order-feature-icon">📚</div>
                            <div class="order-feature-text">
                                <strong>Unlimited Course Access</strong>
                                <span>Akses semua modul & workshop</span>
                            </div>
                        </li>
                        <li>
                            <div class="order-feature-icon">🎯</div>
                            <div class="order-feature-text">
                                <strong>Live Teaching</strong>
                                <span>Kelas langsung bersama pengajar</span>
                            </div>
                        </li>
                        <li>
                            <div class="order-feature-icon">📅</div>
                            <div class="order-feature-text">
                                <strong>Study Planner Premium</strong>
                                <span>Rencanakan jadwal belajarmu</span>
                            </div>
                        </li>
                    </ul>

                    <div class="order-divider"></div>

                    <div class="order-row">
                        <span>Subtotal</span>
                        <span>Rp57.650</span>
                    </div>
                    <div class="order-row discount">
                        <span>Diskon Promo (15%)</span>
                        <span>-Rp8.650</span>
                    </div>
                    <div class="order-total">
                        <span>Total to Pay</span>
                        <span>Rp49.000</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial -->
            <div class="testimonial-card">
                <div class="testimonial-text">
                    "Intellecta tidak hanya mengajarkan skill, tapi mengubah seluruh pendekatan belajarku. ROI-nya langsung terasa."
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">MC</div>
                    <div>
                        <div class="testimonial-name">Marcus Chen</div>
                        <div class="testimonial-role">Senior Designer at Flow State</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div>Intellecta © 2024 Intellecta Editorial Learning. All Rights Reserved.</div>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Accessibility</a>
            <a href="#">Contact Support</a>
        </div>
    </footer>

    <script>
        function switchTab(tab) {
            // Update tab buttons
            document.querySelectorAll('.payment-tab').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Update content
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
            document.getElementById('tab-' + tab).classList.add('active');
        }

        function formatCard(input) {
            let val = input.value.replace(/\D/g, '').substring(0, 16);
            input.value = val.replace(/(\d{4})(?=\d)/g, '$1 ');
        }

        function formatExpiry(input) {
            let val = input.value.replace(/\D/g, '').substring(0, 4);
            if (val.length >= 2) val = val.substring(0,2) + ' / ' + val.substring(2);
            input.value = val;
        }

        function copyText(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Nomor rekening disalin: ' + text);
            });
        }
    </script>
</body>
</html>
