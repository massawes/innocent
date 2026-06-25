<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ATC — Digital Attendance System</title>

    <link rel="preload" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"></noscript>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="ega-body">

    {{-- Top Government Bar --}}
    <div class="ega-topbar">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex align-items-center justify-content-between">
                <span class="ega-topbar-text">
                    <i class='bx bx-globe'></i>
                    United Republic of Tanzania
                </span>
                <div class="d-flex align-items-center gap-3">
                    <span class="ega-topbar-text d-none d-md-flex align-items-center gap-1">
                        <i class='bx bx-shield-check'></i> Official System
                    </span>
                    <div class="ega-tz-flag" title="Tanzania">
                        <span class="f-green"></span>
                        <span class="f-diag"></span>
                        <span class="f-blue"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Header --}}
    <header class="ega-header">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <a href="{{ route('home') }}" class="ega-brand">
                    <img src="{{ asset('images/logo.png') }}" alt="ATC Logo" class="ega-brand-img">
                    <div>
                        <div class="ega-brand-name">ATC Attendance Portal</div>
                        <div class="ega-brand-sub">Digital Attendance Management System</div>
                    </div>
                </a>
                <nav class="d-flex align-items-center gap-2">
                    <a href="{{ route('login') }}" class="ega-nav-outline">
                        <i class='bx bx-log-in'></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="ega-nav-primary">
                        <i class='bx bx-user-plus'></i> Register
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <main>
        {{-- Hero --}}
        <section class="ega-hero ega-hero--img" style="--hero-bg: url('{{ asset('images/hero-students.jpg') }}')">
            <div class="container-fluid px-3 px-md-5">
                <div class="row align-items-center gy-5">

                    {{-- Left: Copy --}}
                    <div class="col-lg-7">
                        <div class="ega-badge ega-badge--light mb-4">
                            <i class='bx bx-badge-check'></i>
                            Official ATC Digital System
                        </div>

                        <h1 class="ega-title ega-title--white mb-2">
                            Student Attendance<br>
                            <span class="ega-title-accent--gold">Management System</span>
                        </h1>
                        <p class="ega-title-en ega-title-en--light mb-4">Student Attendance Management System</p>

                        <p class="ega-copy ega-copy--white mb-5">
                            Record attendance, manage biometric devices and view reports —
                            all in one secure system built for students, lecturers and administrators.
                        </p>

                        <div class="ega-actions mb-5">
                            <a href="{{ route('login') }}" class="ega-btn-main ega-btn-gold">
                                <i class='bx bx-log-in'></i>
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="ega-btn-ghost ega-btn-ghost--white">
                                <i class='bx bx-user-plus'></i>
                                Register Now
                            </a>
                        </div>

                        <div class="ega-pills">
                            <div class="ega-pill">
                                <div class="ega-pill-icon ega-pill--white">
                                    <i class='bx bx-fingerprint'></i>
                                </div>
                                <div>
                                    <div class="ega-pill-title ega-pill-title--white">Biometric</div>
                                    <div class="ega-pill-sub ega-pill-sub--white">Fingerprint scan</div>
                                </div>
                            </div>
                            <div class="ega-pill">
                                <div class="ega-pill-icon ega-pill-green ega-pill--white">
                                    <i class='bx bx-bar-chart-alt-2'></i>
                                </div>
                                <div>
                                    <div class="ega-pill-title ega-pill-title--white">Live Reports</div>
                                    <div class="ega-pill-sub ega-pill-sub--white">Real-time data</div>
                                </div>
                            </div>
                            <div class="ega-pill">
                                <div class="ega-pill-icon ega-pill-gold ega-pill--white">
                                    <i class='bx bx-shield-alt-2'></i>
                                </div>
                                <div>
                                    <div class="ega-pill-title ega-pill-title--white">High Security</div>
                                    <div class="ega-pill-sub ega-pill-sub--white">Role-based access</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right: Dashboard Preview --}}
                    <div class="col-lg-5">
                        <div class="ega-dash-wrap">

                            {{-- Browser chrome bar --}}
                            <div class="ega-browser-bar">
                                <div class="ega-browser-dots">
                                    <span class="dot-red"></span>
                                    <span class="dot-yellow"></span>
                                    <span class="dot-green"></span>
                                </div>
                                <div class="ega-browser-url">
                                    <i class='bx bx-lock-alt'></i> atc.ac.tz / dashboard
                                </div>
                            </div>

                            {{-- Dashboard content --}}
                            <div class="ega-dash-body">

                                {{-- Header --}}
                                <div class="ega-dash-header">
                                    <div>
                                        <div class="ega-dash-eyebrow">SYSTEM OVERVIEW</div>
                                        <div class="ega-dash-title">Attendance Reports at Your Fingertips</div>
                                    </div>
                                    <div class="ega-dash-avatar">
                                        <i class='bx bx-user'></i>
                                    </div>
                                </div>

                                <div class="ega-dash-hr"></div>

                                {{-- Main metric --}}
                                <div class="ega-dash-metric">
                                    <div class="ega-metric-ring">
                                        <svg viewBox="0 0 80 80" class="ega-ring-svg">
                                            <circle cx="40" cy="40" r="34" class="ega-ring-track"/>
                                            <circle cx="40" cy="40" r="34" class="ega-ring-fill" stroke-dasharray="213.6" stroke-dashoffset="10.7"/>
                                        </svg>
                                        <div class="ega-ring-text">
                                            <span class="ega-ring-val">95%</span>
                                        </div>
                                    </div>
                                    <div class="ega-metric-info">
                                        <div class="ega-metric-title">Attendance Average</div>
                                        <div class="ega-metric-sub">This week · All classes</div>
                                        <div class="ega-metric-trend">
                                            <i class='bx bx-trending-up'></i>
                                            +2.3% from last week
                                        </div>
                                        <div class="ega-metric-badge">Excellent</div>
                                    </div>
                                </div>

                                {{-- Weekly attendance mini-bars --}}
                                <div class="ega-dash-bars-wrap">
                                    <div class="ega-bars-label">Daily Attendance (This Week)</div>
                                    <div class="ega-bars">
                                        <div class="ega-bar"><div class="ega-bar-fill" style="height:88%"></div><span>Mon</span></div>
                                        <div class="ega-bar"><div class="ega-bar-fill" style="height:92%"></div><span>Tue</span></div>
                                        <div class="ega-bar"><div class="ega-bar-fill" style="height:95%"></div><span>Wed</span></div>
                                        <div class="ega-bar"><div class="ega-bar-fill ega-bar-active" style="height:97%"></div><span>Thu</span></div>
                                        <div class="ega-bar"><div class="ega-bar-fill" style="height:91%"></div><span>Fri</span></div>
                                    </div>
                                </div>

                                {{-- Capabilities list --}}
                                <div class="ega-dash-caps">
                                    <div class="ega-dash-cap-item">
                                        <div class="ega-dash-cap-icon"><i class='bx bx-fingerprint'></i></div>
                                        <span>Record Attendance via Biometric</span>
                                    </div>
                                    <div class="ega-dash-cap-item">
                                        <div class="ega-dash-cap-icon ega-cap-green"><i class='bx bx-bar-chart-alt-2'></i></div>
                                        <span>View Class Attendance Reports</span>
                                    </div>
                                    <div class="ega-dash-cap-item">
                                        <div class="ega-dash-cap-icon ega-cap-gold"><i class='bx bx-download'></i></div>
                                        <span>Download Attendance Analysis</span>
                                    </div>
                                    <div class="ega-dash-cap-item">
                                        <div class="ega-dash-cap-icon ega-cap-teal"><i class='bx bx-calendar-check'></i></div>
                                        <span>Manage Class Timetables</span>
                                    </div>
                                </div>

                            </div>{{-- /ega-dash-body --}}
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- Services Cards --}}
        <section class="ega-services">
            <div class="container-fluid px-3 px-md-5">
                <div class="text-center mb-5">
                    <div class="ega-section-tag">System Services</div>
                    <h2 class="ega-section-title">Designed for every user</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="ega-card ega-card-blue">
                            <div class="ega-card-icon">
                                <i class='bx bx-user-check'></i>
                            </div>
                            <h3 class="ega-card-title">Students</h3>
                            <p class="ega-card-desc">View your attendance, class timetable and exam eligibility status with ease.</p>
                            <a href="{{ route('login') }}" class="ega-card-link">
                                Login <i class='bx bx-right-arrow-alt'></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ega-card ega-card-green">
                            <div class="ega-card-icon">
                                <i class='bx bx-chalkboard'></i>
                            </div>
                            <h3 class="ega-card-title">Lecturers</h3>
                            <p class="ega-card-desc">Manage classes, record attendance easily and generate detailed student reports.</p>
                            <a href="{{ route('login') }}" class="ega-card-link">
                                Login <i class='bx bx-right-arrow-alt'></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ega-card ega-card-gold">
                            <div class="ega-card-icon">
                                <i class='bx bx-shield-quarter'></i>
                            </div>
                            <h3 class="ega-card-title">Administrators</h3>
                            <p class="ega-card-desc">Monitor attendance trends, manage users and biometric devices efficiently.</p>
                            <a href="{{ route('login') }}" class="ega-card-link">
                                Login <i class='bx bx-right-arrow-alt'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="ega-footer">
        <div class="container-fluid px-3 px-md-5">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
                <div class="ega-footer-left">
                    <img src="{{ asset('images/logo.png') }}" alt="ATC" class="ega-footer-logo">
                    <span>ATC Attendance Portal &copy; {{ date('Y') }}</span>
                </div>
                <div class="ega-footer-right">
                    <i class='bx bx-check-shield me-1'></i>
                    Follows EGA Tanzania Standards
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
