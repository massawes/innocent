@extends('layouts.app')
@section('page-title', 'Dashboard — Quality Assurance (QA)')

@section('content')

<div class="ent-page-header">
    <div>
        <h1 class="ent-page-title">Quality Assurance Dashboard</h1>
        <p class="ent-page-sub">Monitor teaching quality, attendance and issues requiring attention</p>
    </div>
    <div class="ent-page-actions">
        <a href="{{ route('analytics.dashboard') }}" class="ent-btn ent-btn-outline ent-btn-sm">
            <i class='bx bx-bar-chart-alt-2'></i> More Statistics
        </a>
        <a href="{{ route('management.attendance-report') }}" class="ent-btn ent-btn-primary ent-btn-sm">
            <i class='bx bx-file-blank'></i> Report
        </a>
    </div>
</div>

{{-- Stat cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-4">
        <div class="ent-stat">
            <div class="ent-stat-icon"><i class='bx bx-book-content'></i></div>
            <div class="ent-stat-value">{{ $totalModules }}</div>
            <div class="ent-stat-label">Total Modules</div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="ent-stat {{ $coverageRate >= 80 ? 'ent-stat-success' : 'ent-stat-warning' }}">
            <div class="ent-stat-icon"><i class='bx bx-badge-check'></i></div>
            <div class="ent-stat-value">{{ $coverageRate }}%</div>
            <div class="ent-stat-label">Coverage Rate</div>
            <div class="ent-stat-trend {{ $coverageRate >= 80 ? 'up' : 'down' }}">
                <i class='bx {{ $coverageRate >= 80 ? "bx-trending-up" : "bx-trending-down" }}'></i>
                {{ $coverageRate >= 80 ? 'Good level' : 'Needs improvement' }}
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="ent-stat {{ $pendingReviews > 0 ? 'ent-stat-danger' : 'ent-stat-success' }}">
            <div class="ent-stat-icon"><i class='bx bx-time-five'></i></div>
            <div class="ent-stat-value">{{ $pendingReviews }}</div>
            <div class="ent-stat-label">Pending Issues</div>
        </div>
    </div>
</div>

{{-- Modules needing attention --}}
<div class="ent-card">
    <div class="ent-card-header">
        <h2 class="ent-card-title"><i class='bx bx-search-alt'></i> Modules Requiring Attention</h2>
        <span class="ent-badge ent-badge-warning">{{ $modulesWithoutTimetables }} gaps</span>
    </div>
    <div class="ent-card-body" style="padding:0">
        @if($lowAttendanceModules->isEmpty())
            <div class="ent-empty">
                <i class='bx bx-check-double'></i>
                <p>No modules with issues at the moment.</p>
            </div>
        @else
            <table class="ent-table">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Program</th>
                        <th>Records</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowAttendanceModules as $module)
                        <tr>
                            <td style="font-weight:600">{{ $module->module_name }}</td>
                            <td style="color:var(--ent-text-muted)">{{ $module->program_name ?? 'Overall' }}</td>
                            <td style="color:var(--ent-text-muted)">{{ $module->total_records }}</td>
                            <td>
                                <span class="ent-badge ent-badge-danger">
                                    <i class='bx bx-trending-down'></i> {{ $module->attendance_rate }}%
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
