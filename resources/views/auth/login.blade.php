<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | ATC Attendance Portal</title>

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
                            <h1 class="auth-modal-title mb-0">Login</h1>
                        </div>
                        <a href="{{ route('home') }}" class="auth-modal-close" aria-label="Close login page">
                            <i class='bx bx-x'></i>
                        </a>
                    </div>

                    <div class="auth-modal-divider"></div>
                    <p class="auth-modal-copy">Use your existing account details to access the portal.</p>

                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-info border-0 shadow-sm rounded-4 mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="auth-modal-form">
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

                        <div class="auth-modal-field">
                            <label for="password" class="visually-hidden">Password</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control auth-modal-control @error('password') is-invalid @enderror"
                                    placeholder="Password"
                                    required
                                >
                                <button
                                    type="button"
                                    class="auth-modal-icon-btn"
                                    data-toggle-password="password"
                                    aria-label="Show or hide password"
                                >
                                    <i class='bx bx-show'></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="auth-modal-meta">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-modal-link">
                                    Forgot Password?
                                </a>
                            @endif

                            <div class="form-check auth-modal-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Remember Me</label>
                            </div>
                        </div>

                        <button type="submit" class="btn auth-modal-submit w-100">
                            Login
                        </button>
                    </form>

                    <div class="auth-modal-support">
                        <span>Don't have an account?</span>
                        <a href="{{ route('register') }}" class="auth-modal-link ms-1">Sign Up</a>
                    </div>

                    <div class="auth-modal-footer">
                        <p class="mb-1">&copy; {{ date('Y') }} ATC Attendance Portal</p>
                        <p class="mb-0">Secure biometric attendance access</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                const icon = button.querySelector('i');
                const showing = input.type === 'text';

                input.type = showing ? 'password' : 'text';
                icon.className = showing ? 'bx bx-show' : 'bx bx-hide';
            });
        });
    </script>
</body>
</html>
