<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | ATC Attendance Portal</title>

    <link rel="preload" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"></noscript>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="auth-shell auth-shell-modal">
        <div class="container px-3 py-4 py-md-5">
            <div class="auth-modal-wrap">
                <div class="auth-modal-card auth-modal-card-lg">
                    <div class="auth-modal-header">
                        <div>
                            <div class="auth-modal-brand">ATC Attendance Portal</div>
                            <h1 class="auth-modal-title mb-0">Sign Up</h1>
                        </div>
                        <a href="{{ route('login') }}" class="auth-modal-close" aria-label="Close registration page">
                            <i class='bx bx-x'></i>
                        </a>
                    </div>

                    <div class="auth-modal-divider"></div>
                    <p class="auth-modal-copy">Create your account using the same required details already in the system.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                            Please review the form and try again.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" id="register-form" class="auth-modal-form">
                        @csrf

                        <div class="auth-modal-field">
                            <label for="name" class="visually-hidden">Full name</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    class="form-control auth-modal-control @error('name') is-invalid @enderror"
                                    placeholder="Full Name"
                                    required
                                >
                                <span class="auth-modal-icon" aria-hidden="true">
                                    <i class='bx bx-user'></i>
                                </span>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="auth-modal-field">
                            <label for="email" class="visually-hidden">Email</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="form-control auth-modal-control @error('email') is-invalid @enderror"
                                    placeholder="Email"
                                    required
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

                        <div class="auth-modal-field">
                            <label for="password_confirmation" class="visually-hidden">Confirm password</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control auth-modal-control"
                                    placeholder="Confirm Password"
                                    required
                                >
                                <button
                                    type="button"
                                    class="auth-modal-icon-btn"
                                    data-toggle-password="password_confirmation"
                                    aria-label="Show or hide confirmation password"
                                >
                                    <i class='bx bx-show'></i>
                                </button>
                            </div>
                        </div>

                        <div class="auth-modal-field">
                            <label for="role" class="visually-hidden">Select role</label>
                            <div class="auth-modal-input-wrap">
                                <select name="role_id" id="role" class="form-select auth-modal-select @error('role_id') is-invalid @enderror" required>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" data-role-name="{{ $role->name }}" @selected(old('role_id') == $role->id)>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="auth-modal-icon" aria-hidden="true">
                                    <i class='bx bx-chevron-down'></i>
                                </span>
                            </div>
                            @error('role_id')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="auth-modal-field" id="program-field" style="display:none;">
                            <label for="program_id" class="visually-hidden">Select program</label>
                            <div class="auth-modal-input-wrap">
                                <select name="program_id" id="program_id" class="form-select auth-modal-select">
                                    <option value="">Select Program</option>
                                    @foreach ($programs as $program)
                                        <option value="{{ $program->id }}" @selected(old('program_id') == $program->id)>
                                            {{ $program->program_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="auth-modal-icon" aria-hidden="true">
                                    <i class='bx bx-book-content'></i>
                                </span>
                            </div>
                        </div>

                        <div class="auth-modal-field" id="admin-number-field" style="display:none;">
                            <label for="admin_number" class="visually-hidden">Admin number</label>
                            <div class="auth-modal-input-wrap">
                                <input
                                    type="text"
                                    name="admin_number"
                                    id="admin_number"
                                    value="{{ old('admin_number') }}"
                                    class="form-control auth-modal-control @error('admin_number') is-invalid @enderror"
                                    placeholder="Admin Number"
                                >
                                <span class="auth-modal-icon" aria-hidden="true">
                                    <i class='bx bx-id-card'></i>
                                </span>
                            </div>
                            <small class="auth-modal-note">Required for student accounts.</small>
                            @error('admin_number')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="auth-modal-field" id="department-field" style="display:none;">
                            <label for="department_id" class="visually-hidden">Select department</label>
                            <div class="auth-modal-input-wrap">
                                <select name="department_id" id="department_id" class="form-select auth-modal-select">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="auth-modal-icon" aria-hidden="true">
                                    <i class='bx bx-buildings'></i>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn auth-modal-submit w-100">
                            Sign Up
                        </button>
                    </form>

                    <div class="auth-modal-support">
                        <span>Have an account?</span>
                        <a href="{{ route('login') }}" class="auth-modal-link ms-1">Login</a>
                    </div>

                    <div class="auth-modal-footer">
                        <p class="mb-1">&copy; {{ date('Y') }} ATC Attendance Portal</p>
                        <p class="mb-0">Biometric attendance registration portal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const role = document.getElementById('role');
        const programField = document.getElementById('program-field');
        const adminNumberField = document.getElementById('admin-number-field');
        const departmentField = document.getElementById('department-field');
        const programInput = document.getElementById('program_id');
        const adminNumberInput = document.getElementById('admin_number');
        const departmentInput = document.getElementById('department_id');

        function toggleFields() {
            const selectedRole = role.options[role.selectedIndex];
            const roleName = selectedRole ? selectedRole.dataset.roleName : '';
            const isStudent = roleName === 'student';
            const isStaff = roleName === 'lecturer' || roleName === 'HOD';

            programInput.required = isStudent;
            adminNumberInput.required = isStudent;
            departmentInput.required = isStaff;

            if (isStudent) {
                programField.style.display = 'block';
                adminNumberField.style.display = 'block';
                departmentField.style.display = 'none';
            } else if (isStaff) {
                programField.style.display = 'none';
                adminNumberField.style.display = 'none';
                departmentField.style.display = 'block';
            } else {
                programField.style.display = 'none';
                adminNumberField.style.display = 'none';
                departmentField.style.display = 'none';
            }
        }

        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                const icon = button.querySelector('i');
                const showing = input.type === 'text';

                input.type = showing ? 'password' : 'text';
                icon.className = showing ? 'bx bx-show' : 'bx bx-hide';
            });
        });

        role.addEventListener('change', toggleFields);
        toggleFields();
    </script>
</body>
</html>
