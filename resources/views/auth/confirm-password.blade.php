<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirm Password | ATC Attendance Portal</title>

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
                            <h1 class="auth-modal-title mb-0">Confirm Password</h1>
                        </div>
                        <a href="{{ route('home') }}" class="auth-modal-close" aria-label="Close">
                            <i class='bx bx-x'></i>
                        </a>
                    </div>

                    <div class="auth-modal-divider"></div>
                    <p class="auth-modal-copy">This is a secure area. Please confirm your password before continuing.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.confirm') }}" class="auth-modal-form">
                        @csrf

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
                                    autocomplete="current-password"
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

                        <button type="submit" class="btn auth-modal-submit w-100">
                            <i class='bx bx-lock-open me-1'></i> Confirm
                        </button>
                    </form>

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
