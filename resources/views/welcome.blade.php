<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in — {{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg:        #0f172a;
            --surface:   #1e293b;
            --surface-2: #334155;
            --border:    #334155;
            --border-hover: #475569;
            --red:       #6366f1;
            --red-glow:  rgba(99, 102, 241, 0.18);
            --red-dim:   #4f46e5;
            --orange:    #3b82f6;
            --text:      #f8fafc;
            --text-muted:#94a3b8;
            --text-dim:  #64748b;
            --input-bg:  #0f172a;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
        }

        /* ── Ambient background ── */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .bg-canvas::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 80% 20%, rgba(99,102,241,0.15) 0%, transparent 60%),
                radial-gradient(ellipse 40% 60% at 10% 80%, rgba(59,130,246,0.1) 0%, transparent 60%);
        }

        /* subtle grid */
        .bg-canvas::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 30%, transparent 100%);
        }

        /* ── Layout ── */
        .page {
            position: relative;
            z-index: 1;
            width: min(480px, 95vw);
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.04) inset,
                0 40px 100px rgba(0,0,0,0.8),
                0 0 80px var(--red-glow);
            animation: rise 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(28px) scale(0.97); }
            to   { opacity: 1; transform: translateY(0)    scale(1); }
        }

        /* ── Left panel — form ── */
        .form-panel {
            background: var(--surface);
            padding: 56px 52px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0;
        }

        /* ── Logo ── */
        .logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
            text-decoration: none;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            color: var(--red);
            flex-shrink: 0;
        }

        .logo-text {
            font-family: 'DM Sans', sans-serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .heading {
            font-family: 'DM Sans', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            line-height: 1.2;
            color: var(--text);
            margin-bottom: 8px;
        }

        .subheading {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 300;
            margin-bottom: 36px;
        }

        /* ── Form elements ── */
        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-bottom: 20px;
        }

        .field-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        label {
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .forgot-link {
            font-size: 0.75rem;
            color: var(--red);
            text-decoration: none;
            font-weight: 400;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--orange);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 13px 16px;
            background: var(--input-bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            -webkit-appearance: none;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 3px var(--red-glow);
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: var(--text-dim);
        }

        /* ── Remember me ── */
        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 28px;
            cursor: pointer;
            user-select: none;
        }

        .remember input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 17px;
            height: 17px;
            border: 1px solid var(--border-hover);
            border-radius: 4px;
            background: var(--input-bg);
            cursor: pointer;
            flex-shrink: 0;
            position: relative;
            transition: border-color 0.2s, background 0.2s;
        }

        .remember input[type="checkbox"]:checked {
            background: var(--red);
            border-color: var(--red);
        }

        .remember input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 10'%3E%3Cpolyline points='1.5,5 4.5,8 10.5,2' fill='none' stroke='white' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
        }

        .remember span {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        /* ── Submit button ── */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--red);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.02em;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: background 0.2s, box-shadow 0.2s, transform 0.15s;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%);
            pointer-events: none;
        }

        .btn-login:hover {
            background: var(--red-dim);
            box-shadow: 0 4px 24px rgba(99,102,241,0.4);
            transform: translateY(-1px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* ── Sign up ── */
        .signup-row {
            text-align: center;
            margin-top: 24px;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .signup-row a {
            color: var(--red);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .signup-row a:hover {
            color: var(--orange);
        }

        /* Error messages */
        .error-msg {
            font-size: 0.75rem;
            color: var(--red);
            margin-top: 4px;
        }

        /* Session errors */
        .alert {
            background: rgba(99,102,241,0.1);
            border: 1px solid rgba(99,102,241,0.3);
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 0.8rem;
            color: var(--red);
            margin-bottom: 20px;
        }

        /* ── Responsive ── */
        @media (max-width: 480px) {
            .form-panel {
                padding: 44px 28px;
            }
        }
    </style>
</head>
<body>

<div class="bg-canvas"></div>

<div class="page">

    {{-- ── Left: Form panel ── --}}
    <div class="form-panel">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="logo" style="display:flex; align-items:center; gap:14px; margin-bottom:40px; text-decoration:none;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:50px; height:50px; object-fit:contain;">
            <span class="logo-text" style="font-family:'Outfit', sans-serif; font-size:26px; font-weight:700; letter-spacing:-0.5px; display:flex;">
                <span style="color:#818cf8;">Gudang</span><span style="color:#f9b300;">Buku</span>
            </span>
        </a>

        {{-- Heading --}}
        <h1 class="heading">Welcome back.</h1>
        <p class="subheading">Enter your credentials to access your account.</p>

        {{-- Session status --}}
        @if (session('status'))
            <div class="alert">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Username --}}
            <div class="field">
                <label for="username">Username</label>
                <input
                    id="username"
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="username"
                    required
                    autofocus
                    autocomplete="username"
                >
                @error('username')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="field">
                <div class="field-header">
                    <label for="password">Password</label>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="••••••••••"
                    required
                    autocomplete="current-password"
                >
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            {{-- Remember me --}}
            <label class="remember">
                <input type="checkbox" name="remember" id="remember_me">
                <span>Remember me</span>
            </label>

            {{-- Submit --}}
            <button type="submit" class="btn-login">Log in</button>

        </form>



    </div>

</div>

</body>
</html>