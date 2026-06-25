<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password | ATC Attendance Portal</title>

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
                            <h1 class="auth-modal-title mb-0">Forgot Password</h1>
                        </div>
                        <a href="{{ route('home') }}" class="auth-modal-close" aria-label="Close">
                            <i class='bx bx-x'></i>
                        </a>
                    </div>

                    <div class="auth-modal-divider"></div>
                    <p class="auth-modal-copy">Enter the email linked to your account and we'll send you a password reset link.</p>

                    @if (session('status'))
                        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                            Please check the email address and try again.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="auth-modal-form">
                        @csrf

                        <div class="auth-modal-field">
                            <label for="email" class="visually-hidden">Email address</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="form-control auth-modal-control @error('email') is-invalid @enderror"
                                    placeholder="Email"
                                    required
                                    autofocus
                                >
                                <span class="auth-modal-icon" aria-hidden="true">
                                    <i class='bx bxs-envelope'></i>
                                </span>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn auth-modal-submit w-100">
                            <i class='bx bx-send me-1'></i> Send Reset Link
                        </button>
                    </form>

                    <div class="auth-modal-support">
                        <span>Remembered your password?</span>
                        <a href="{{ route('login') }}" class="auth-modal-link ms-1">Back to Login</a>
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
