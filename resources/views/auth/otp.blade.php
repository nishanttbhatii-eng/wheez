<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OTP Login - LMS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-black: #0a0a0a;
            --brand-yellow: #f2e600;
            --brand-yellow-dark: #c8c400;
            --brand-gray: #2b2b2b;
            --brand-gray-light: #404040;
            --brand-white: #ffffff;
            --brand-text-muted: #9ca3af;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background:
                radial-gradient(ellipse 70% 45% at 50% -10%, rgba(242, 230, 0, 0.09), transparent 70%),
                radial-gradient(ellipse 50% 35% at 100% 100%, rgba(43, 43, 43, 0.35), transparent 70%),
                var(--brand-black);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
        }

        .login-wrap {
            width: 100%;
            max-width: 420px;
            background: #181818;
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45);
            overflow: hidden;
        }

        .login-logo-bar {
            background: var(--brand-black);
            padding: 24px 32px 20px;
            text-align: center;
            border-bottom: 3px solid var(--brand-yellow);
        }

        .logo-icon-wrap {
            height: 68px;
            overflow: hidden;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        .login-logo-bar img {
            max-width: 180px;
            width: 100%;
            height: auto;
            display: block;
        }

        .brand-name {
            margin-top: 10px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.18em;
            color: var(--brand-yellow);
        }

        .login-content {
            padding: 28px 28px 32px;
        }

        .login-content h2 {
            color: var(--brand-white);
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 6px;
            text-align: center;
        }

        .login-content .subtitle {
            color: var(--brand-text-muted);
            font-size: 14px;
            text-align: center;
            margin-bottom: 24px;
        }

        .form-label {
            font-weight: 600;
            color: #d1d5db;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .form-control {
            background-color: #111111 !important;
            border: 1px solid var(--brand-gray-light) !important;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
            color: var(--brand-white) !important;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control::placeholder {
            color: #6b7280;
        }

        .form-control:focus {
            background-color: #141414 !important;
            border-color: var(--brand-yellow) !important;
            box-shadow: 0 0 0 3px rgba(242, 230, 0, 0.12) !important;
            color: var(--brand-white) !important;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--brand-yellow) 0%, var(--brand-yellow-dark) 100%) !important;
            border: none !important;
            border-radius: 10px;
            padding: 13px;
            font-size: 15px;
            font-weight: 700;
            color: var(--brand-black) !important;
            width: 100%;
            box-shadow: 0 8px 20px rgba(242, 230, 0, 0.22);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover,
        .btn-login:focus {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(242, 230, 0, 0.3) !important;
            color: var(--brand-black) !important;
            background: linear-gradient(135deg, #f7eb1a 0%, #d4d000 100%) !important;
        }

        .alert {
            border-radius: 10px;
            border: none;
            font-size: 14px;
        }

        .otp-note {
            color: var(--brand-text-muted);
            margin-bottom: 18px;
            font-size: 13px;
            line-height: 1.5;
        }

        .otp-note strong {
            color: #e5e7eb;
        }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-logo-bar">
            <div class="logo-icon-wrap">
                <img src="{{ $logoUrl }}" alt="WhizSeed Logo">
            </div>
            <div class="brand-name">WHIZSEED.COM</div>
        </div>

        <div class="login-content">
            <h2>OTP Login</h2>
            <p class="subtitle">Enter the code sent to your email</p>

            @if(session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.verify') }}">
                @csrf
                <input type="hidden" name="email" value="{{ old('email', session('login_email')) }}">

                <div class="mb-4">
                    <label for="otp" class="form-label">One-Time Password</label>
                    <input type="text" name="otp" id="otp" class="form-control @error('otp') is-invalid @enderror" value="{{ old('otp') }}" placeholder="000000" maxlength="6" pattern="[0-9]{6}" inputmode="numeric" required autofocus style="text-align: center; font-size: 18px; font-weight: 600; letter-spacing: 0.5em;">
                    @error('otp')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class=" otp-note mb-4">
                    We emailed your login code to <strong>{{ old('email', session('login_email')) }}</strong>. It expires in 10 minutes.
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="fas fa-key me-2"></i>Verify OTP
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('otp').addEventListener('input', function(e) {
            // Remove any non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limit to 6 digits
            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6);
            }
        });
    </script>
</body>
</html>
