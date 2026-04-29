<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Partner Register | GymHai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/@tabler/icons/iconfont/tabler-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --text: #0f172a;
            --text-light: #64748b;
            --border: #e2e8f0;
            --bg-light: #f8fafc;
        }

        * {
            font-family: 'Outfit', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background-color: #fff;
            color: var(--text);
            display: flex;
        }

        .auth-wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        /* --- Left Side (Marketing) --- */
        .auth-banner {
            width: 50%;
            background: linear-gradient(135deg, #0f172a 0%, #312e81 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px 60px;
            color: #fff;
        }

        .auth-banner::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -20%;
            width: 800px;
            height: 800px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.4) 0%, rgba(0, 0, 0, 0) 70%);
            z-index: 1;
        }

        .auth-banner::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.3) 0%, rgba(0, 0, 0, 0) 70%);
            z-index: 1;
        }

        .auth-banner-content {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
        }

        .auth-logo {
            position: absolute;
            top: 40px;
            left: 60px;
            z-index: 2;
        }

        .auth-logo img {
            height: 48px;
        }

        .trial-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            border-radius: 99px;
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 24px;
            margin-top: 45px;
            /* Space for absolute logo */
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
            animation: pulseTrial 2s infinite;
        }

        @keyframes pulseTrial {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.6);
            }

            70% {
                box-shadow: 0 0 0 14px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        .auth-title {
            font-size: 52px;
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .auth-title span {
            color: #a5b4fc;
        }

        .auth-subtitle {
            font-size: 18px;
            color: #cbd5e1;
            line-height: 1.6;
            margin-bottom: 36px;
        }

        .auth-features {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .a-feature {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: rgba(255, 255, 255, 0.06);
            padding: 16px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .a-feature i {
            color: #a5b4fc;
            font-size: 28px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px;
            border-radius: 12px;
        }

        .a-feature-text h6 {
            margin: 0 0 4px 0;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
        }

        .a-feature-text p {
            margin: 0;
            font-size: 14px;
            color: #cbd5e1;
            line-height: 1.4;
        }

        /* --- Right Side (Form) --- */
        .auth-form-side {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            padding: 40px;
        }

        .auth-form-wrap {
            width: 100%;
            max-width: 540px;
        }

        /* Mobile Header Row */
        .mobile-header-row {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .auth-logo-mobile {
            display: none; /* hidden by default, shown via media query or bootstrap */
        }

        @media (max-width: 992px) {
            .auth-wrapper {
                flex-direction: column;
                padding-bottom: 85px; /* Prevent overlap with bottom nav */
            }

            .auth-banner {
                width: 100%;
                padding: 40px 24px;
                min-height: auto;
            }

            .auth-form-side {
                width: 100%;
                padding: 40px 24px;
            }

            .mobile-header-row {
                justify-content: space-between;
                gap: 12px;
            }

            .auth-logo-mobile {
                display: block;
            }
            .auth-logo-mobile img {
                height: 32px; /* Fit nicely beside badge */
            }

            .auth-logo-desktop {
                display: none !important;
            }

            .trial-badge {
                margin-top: 0;
                margin-bottom: 0;
                padding: 6px 12px;
                font-size: 11px;
            }

            .auth-title {
                font-size: 40px;
            }
        }

        .auth-form-head {
            margin-bottom: 32px;
        }

        .auth-form-head h2 {
            font-size: 32px;
            font-weight: 800;
            color: var(--text);
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .auth-form-head p {
            color: var(--text-light);
            font-size: 15px;
            margin: 0;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #334155;
            margin-bottom: 6px;
        }

        .input-group-text {
            background: #fff;
            border: 1px solid var(--border);
            border-right: none;
            color: #94a3b8;
            border-radius: 12px 0 0 12px;
        }

        .form-control,
        .form-select {
            height: 48px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background: #fff;
            font-size: 15px;
            color: var(--text);
        }

        .input-group .form-control {
            border-radius: 0 12px 12px 0;
            border-left: none;
            padding-left: 0;
        }

        .input-group .form-control:focus {
            border-color: var(--border);
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }

        .input-group:focus-within {
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
            border-radius: 12px;
        }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control {
            border-color: var(--primary);
        }

        .btn-primary {
            height: 50px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 16px;
            border: none;
            background: var(--primary);
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.4);
        }

        .alert {
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
        }

        .is-invalid {
            border-color: #ef4444 !important;
        }

        .invalid-feedback {
            font-size: 12px;
            margin-top: 4px;
        }

        .form-helper {
            font-size: 12px;
            margin-top: 6px;
            color: #94a3b8;
        }

        .form-helper.ok {
            color: #10b981;
        }

        .form-helper.bad {
            color: #ef4444;
        }

        .auth-footer {
            margin-top: 32px;
            text-align: center;
            font-size: 15px;
            color: var(--text-light);
            font-weight: 500;
        }

        .auth-footer a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }

        .auth-footer a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row .mb-4 {
            flex: 1;
        }

        @media (max-width: 576px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }

        /* --- Mobile Bottom Nav (Sleek App Design) --- */
        .mobile-bottom-nav {
            display: none;
        }

        @media (max-width: 992px) {
            .auth-wrapper {
                padding-bottom: 85px; /* Prevent overlap with the form */
            }
            .mobile-bottom-nav {
                display: flex;
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.06);
                z-index: 9999;
                justify-content: space-around;
                align-items: center;
                height: 65px;
                border-top: 1px solid rgba(0,0,0,0.05);
            }
            .nav-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                color: #64748b;
                font-size: 11px;
                font-weight: 600;
                transition: all 0.2s ease;
                flex: 1;
                height: 100%;
            }
            .nav-item svg {
                width: 22px;
                height: 22px;
                margin-bottom: 4px;
                stroke: currentColor;
                transition: all 0.2s ease;
            }
            .nav-item:hover, .nav-item.active {
                color: var(--primary);
            }
            .nav-item.active svg {
                transform: translateY(-2px);
                stroke-width: 2.5;
            }
            
            /* The floating center button (Brought down, no text) */
            .nav-item.center-pop {
                flex: 1;
                justify-content: center;
                padding-bottom: 0;
            }
            .nav-item.center-pop .icon-wrapper {
                background: linear-gradient(135deg, var(--primary) 0%, #4338ca 100%);
                width: 48px;
                height: 48px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
                transition: transform 0.2s ease;
            }
            .nav-item.center-pop:active .icon-wrapper {
                transform: scale(0.92);
            }
            .nav-item.center-pop .icon-wrapper svg {
                width: 22px;
                height: 22px;
                color: #fff;
                stroke: #fff;
                margin: 0;
            }
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">

        <!-- LEFT: Marketing Banner -->
        <div class="auth-banner">
            <div class="auth-logo auth-logo-desktop">
                <a href="/"><img src="../images/logo2.png" alt="GymHai"></a>
            </div>

            <div class="auth-banner-content">
                <div class="mobile-header-row">
                    <div class="auth-logo-mobile">
                        <a href="/"><img src="../images/logo2.png" alt="GymHai"></a>
                    </div>
                    <div class="trial-badge">
                        <i class="ti ti-star-filled"></i> Claim Your 1 Month Free Trial
                    </div>
                </div>

                <h1 class="auth-title">List your gym.<br><span>Get more members.</span></h1>
                <p class="auth-subtitle">
                    Thousands of fitness businesses grow with GymHai. Register your gym in minutes and start converting
                    searches into footfalls.
                </p>

                <div class="auth-features">
                    <div class="a-feature">
                        <i class="ti ti-building-store"></i>
                        <div class="a-feature-text">
                            <h6>List Your Gym Online</h6>
                            <p>Reach customers searching for fitness centers locally.</p>
                        </div>
                    </div>
                    <div class="a-feature">
                        <i class="ti ti-users"></i>
                        <div class="a-feature-text">
                            <h6>Smart User Management</h6>
                            <p>Track leads, manage memberships and control access easily.</p>
                        </div>
                    </div>
                    <div class="a-feature">
                        <i class="ti ti-dashboard"></i>
                        <div class="a-feature-text">
                            <h6>All-in-one Dashboard</h6>
                            <p>Control pricing, plans and monitor growth securely.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Placeholder to keep space at bottom -->
            <div></div>
        </div>

        <!-- RIGHT: Registration Form -->
        <div class="auth-form-side">
            <div class="auth-form-wrap">
                <div class="auth-form-head">
                    <h2>Create Account</h2>
                    <p>Start your <strong>1 Month Free Trial</strong> today.</p>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="ti ti-circle-check"></i> {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="ti ti-alert-triangle"></i> {{ session('error') }}
                    </div>
                @endif

                <form method="POST" id="registerForm" novalidate>
                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-user"></i></span>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Enter full name"
                                value="{{ old('name') }}" required>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-helper" id="nameMsg"></div>
                    </div>

                    <div class="form-row">
                        <div class="mb-4">
                            <label class="form-label">Mobile Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-phone"></i></span>
                                <input type="text" name="mobile" id="mobile" maxlength="10"
                                    class="form-control @error('mobile') is-invalid @enderror"
                                    placeholder="10-digit number" value="{{ old('mobile') }}" required>
                            </div>
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-helper" id="mobileMsg"></div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-mail"></i></span>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Enter email"
                                    value="{{ old('email') }}" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-helper" id="emailMsg"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="mb-4">
                            <label class="form-label">State</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-map"></i></span>
                                <select name="state" id="state"
                                    class="form-select @error('state') is-invalid @enderror" required
                                    style="border-left:none;">
                                    <option value="">Select State</option>
                                    @php
                                        $states = [
                                            'Andhra Pradesh',
                                            'Arunachal Pradesh',
                                            'Assam',
                                            'Bihar',
                                            'Chhattisgarh',
                                            'Goa',
                                            'Gujarat',
                                            'Haryana',
                                            'Himachal Pradesh',
                                            'Jharkhand',
                                            'Karnataka',
                                            'Kerala',
                                            'Madhya Pradesh',
                                            'Maharashtra',
                                            'Manipur',
                                            'Meghalaya',
                                            'Mizoram',
                                            'Nagaland',
                                            'Odisha',
                                            'Punjab',
                                            'Rajasthan',
                                            'Sikkim',
                                            'Tamil Nadu',
                                            'Telangana',
                                            'Tripura',
                                            'Uttar Pradesh',
                                            'Uttarakhand',
                                            'West Bengal',
                                            'Delhi',
                                        ];
                                    @endphp
                                    @foreach ($states as $st)
                                        <option value="{{ $st }}" {{ old('state') == $st ? 'selected' : '' }}>
                                            {{ $st }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">City</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-map-pin"></i></span>
                                <input type="text" name="city" id="city"
                                    class="form-control @error('city') is-invalid @enderror" placeholder="Enter city"
                                    value="{{ old('city') }}" required>
                            </div>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Create Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-lock"></i></span>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Create password" required>
                            <span class="input-group-text" id="togglePassword"
                                style="border-radius:0 12px 12px 0; border-left:none; cursor:pointer;">
                                <i class="ti ti-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-helper" id="passMsg"></div>
                    </div>

                    <div class="d-grid mt-2">
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <span class="btnText">Start Free Trial</span>
                            <span class="spinner-border spinner-border-sm ms-2 d-none" id="btnLoader"></span>
                        </button>
                    </div>

                    <div class="auth-footer">
                        Already have an account? <a href="/partner/login">Log In</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="mobile-bottom-nav">
        <a href="/partner/register" class="nav-item active">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <line x1="19" y1="8" x2="19" y2="14"></line>
                <line x1="22" y1="11" x2="16" y2="11"></line>
            </svg>
            <span>Register</span>
        </a>
        <a href="/" class="nav-item center-pop">
            <div class="icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
            </div>
        </a>
        <a href="/partner/login" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                <polyline points="10 17 15 12 10 7"></polyline>
                <line x1="15" y1="12" x2="3" y2="12"></line>
            </svg>
            <span>Login</span>
        </a>
    </div>

    <script>
        (function() {
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            const btnLoader = document.getElementById('btnLoader');

            const name = document.getElementById('name');
            const nameMsg = document.getElementById('nameMsg');

            const mobile = document.getElementById('mobile');
            const mobileMsg = document.getElementById('mobileMsg');

            const email = document.getElementById('email');
            const emailMsg = document.getElementById('emailMsg');

            const password = document.getElementById('password');
            const passMsg = document.getElementById('passMsg');

            const togglePassword = document.getElementById('togglePassword');

            function setMsg(el, msg, type) {
                if (!el) return;
                el.innerText = msg || '';
                if (type === 'ok') el.className = 'form-helper ok';
                else if (type === 'bad') el.className = 'form-helper bad';
                else el.className = 'form-helper';
            }

            function mark(el, ok) {
                if (!el) return;
                el.classList.toggle('is-valid', !!ok);
                el.classList.toggle('is-invalid', ok === false);
            }

            name?.addEventListener('input', function() {
                const v = this.value.trim();
                if (v.length === 0) setMsg(nameMsg, '', '');
                else if (v.length < 2) {
                    mark(this, false);
                    setMsg(nameMsg, 'Please enter at least 2 characters.', 'bad');
                } else {
                    mark(this, true);
                    setMsg(nameMsg, 'Looks good.', 'ok');
                }
            });

            mobile?.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                const v = this.value.trim();
                if (v.length === 0) setMsg(mobileMsg, '', '');
                else if (v.length !== 10) {
                    mark(this, false);
                    setMsg(mobileMsg, 'Mobile must be exactly 10 digits.', 'bad');
                } else {
                    mark(this, true);
                    setMsg(mobileMsg, 'Valid mobile number.', 'ok');
                }
            });

            email?.addEventListener('input', function() {
                const v = this.value.trim();
                const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (v.length === 0) setMsg(emailMsg, '', '');
                else if (!pattern.test(v)) {
                    mark(this, false);
                    setMsg(emailMsg, 'Please enter a valid email address.', 'bad');
                } else {
                    mark(this, true);
                    setMsg(emailMsg, 'Email looks good.', 'ok');
                }
            });

            password?.addEventListener('input', function() {
                const v = this.value;
                if (v.length === 0) setMsg(passMsg, '', '');
                else if (v.length < 6) {
                    mark(this, false);
                    setMsg(passMsg, 'Use at least 6 characters.', 'bad');
                } else {
                    mark(this, true);
                    setMsg(passMsg, 'Strong enough.', 'ok');
                }
            });

            togglePassword?.addEventListener('click', function() {
                const isPass = password.type === 'password';
                password.type = isPass ? 'text' : 'password';
                this.innerHTML = isPass ? '<i class="ti ti-eye-off"></i>' : '<i class="ti ti-eye"></i>';
            });

            form?.addEventListener('submit', function() {
                submitBtn.disabled = true;
                btnLoader.classList.remove('d-none');
            });
        })();
    </script>
</body>

</html>
