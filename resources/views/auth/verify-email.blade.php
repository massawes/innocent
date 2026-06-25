<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email | ATC Attendance Portal</title>

    <link rel="preload" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"></noscript>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="auth-shell auth-shell-modal">
        <div class="container px-3 py-4 py-md-5">
            <div class="auth-modal-wrap">
                <div class="auth-modal-card auth-modal-card-sm">

                    <div class="auth-modal-header">
                        <div>
                            <div class="auth-modal-brand">ATC Attendance Portal</div>
                            <h1 class="auth-modal-title mb-0">Verify Email</h1>
                        </div>
                    </div>

                    <div class="auth-modal-divider"></div>
                    <p class="auth-modal-copy">
                        Thanks for signing up! Please verify your email address by clicking the link we sent you.
                        If you didn't receive the email, we can send another one.
                    </p>

                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                            A new verification link has been sent to your email address.
                        </div>
                    @endif

                    <div class="auth-modal-form" style="display:flex;flex-direction:column;gap:.75rem">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn auth-modal-submit w-100">
                                <i class='bx bx-envelope me-1'></i> Resend Verification Email
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary w-100 rounded-pill">
                                <i class='bx bx-log-out me-1'></i> Log Out
                            </button>
                        </form>
                    </div>

                    <div class="auth-modal-footer">
                        <p class="mb-1">&copy; {{ date('Y') }} ATC Attendance Portal</p>
                        <p class="mb-0">Secure biometric attendance access</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
