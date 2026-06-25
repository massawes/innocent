<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password | ATC Attendance Portal</title>

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
                            <h1 class="auth-modal-title mb-0">Reset Password</h1>
                        </div>
                        <a href="{{ route('home') }}" class="auth-modal-close" aria-label="Close">
                            <i class='bx bx-x'></i>
                        </a>
                    </div>

                    <div class="auth-modal-divider"></div>
                    <p class="auth-modal-copy">Choose a new password for your account.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}" class="auth-modal-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="auth-modal-field">
                            <label for="email" class="visually-hidden">Email address</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email', $request->email) }}"
                                    class="form-control auth-modal-control @error('email') is-invalid @enderror"
                                    placeholder="Email"
                                    required
                                    autofocus
                                    autocomplete="username"
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
                            <label for="password" class="visually-hidden">New password</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control auth-modal-control @error('password') is-invalid @enderror"
                                    placeholder="New Password"
                                    required
                                    autocomplete="new-password"
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

                        <div class="auth-modal-field">
                            <label for="password_confirmation" class="visually-hidden">Confirm password</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control auth-modal-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirm Password"
                                    required
                                    autocomplete="new-password"
                                >
                                <button
                                    type="button"
                                    class="auth-modal-icon-btn"
                                    data-toggle-password="password_confirmation"
                                    aria-label="Show or hide password"
                                >
                                    <i class='bx bx-show'></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn auth-modal-submit w-100">
                            <i class='bx bx-check-circle me-1'></i> Reset Password
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
