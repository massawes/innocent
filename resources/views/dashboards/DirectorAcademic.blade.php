@extends('layouts.app')
@section('page-title', 'Dashboard — Director Academic')

@section('content')

<div class="ent-page-header">
    <div>
        <h1 class="ent-page-title">Director Academic Dashboard</h1>
        <p class="ent-page-sub">Overview of academic leadership — departments, programmes and performance</p>
    </div>
    <div class="ent-page-actions">
        <a href="{{ route('director.faculties') }}" class="ent-btn ent-btn-outline ent-btn-sm">
            <i class='bx bx-building'></i> Faculties
        </a>
        <a href="{{ route('hods.index') }}" class="ent-btn ent-btn-outline ent-btn-sm">
            <i class='bx bx-briefcase-alt-2'></i> Heads of Department
        </a>
        <a href="{{ route('analytics.dashboard') }}" class="ent-btn ent-btn-primary ent-btn-sm">
            <i class='bx bx-bar-chart-alt-2'></i> Statistics
        </a>
    </div>
</div>

{{-- Stat cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="ent-stat">
            <div class="ent-stat-icon"><i class='bx bx-category'></i></div>
            <div class="ent-stat-value">{{ $totalDepartments }}</div>
            <div class="ent-stat-label">All Departments</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="ent-stat ent-stat-info">
            <div class="ent-stat-icon"><i class='bx bx-bookmark'></i></div>
            <div class="ent-stat-value">{{ $totalPrograms }}</div>
            <div class="ent-stat-label">All Programs</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="ent-stat ent-stat-success">
            <div class="ent-stat-icon"><i class='bx bx-graduation'></i></div>
            <div class="ent-stat-value">{{ $totalStudents }}</div>
            <div class="ent-stat-label">Total Students</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="ent-stat {{ $overallAttendanceRate >= 75 ? 'ent-stat-success' : 'ent-stat-danger' }}">
            <div class="ent-stat-icon"><i class='bx bx-user-check'></i></div>
            <div class="ent-stat-value">{{ $overallAttendanceRate }}%</div>
            <div class="ent-stat-label">Overall Attendance</div>
            <div class="ent-stat-trend {{ $overallAttendanceRate >= 75 ? 'up' : 'down' }}">
                <i class='bx {{ $overallAttendanceRate >= 75 ? "bx-trending-up" : "bx-trending-down" }}'></i>
                {{ $overallAttendanceRate >= 75 ? 'Above threshold' : 'Below threshold' }}
            </div>
        </div>
    </div>
</div>

{{-- Department performance table --}}
<div class="ent-card">
    <div class="ent-card-header">
        <h2 class="ent-card-title"><i class='bx bx-trophy'></i> Top Department Performance</h2>
        <span class="ent-badge ent-badge-primary">{{ $departmentPerformance->count() }} top departments</span>
    </div>
    <div class="ent-card-body" style="padding:0">
        @if($departmentPerformance->isEmpty())
            <div class="ent-empty">
                <i class='bx bx-building'></i>
                <p>No department data yet.</p>
            </div>
        @else
            <table class="ent-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Department Name</th>
                        <th>Programs</th>
                        <th>Students</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departmentPerformance as $i => $dept)
                        <tr>
                            <td style="color:var(--ent-text-muted);font-weight:600">{{ $i + 1 }}</td>
                            <td style="font-weight:600">{{ $dept->department_name }}</td>
                            <td style="color:var(--ent-text-muted)">{{ $dept->total_programs }}</td>
                            <td style="color:var(--ent-text-muted)">{{ $dept->total_students }}</td>
                            <td>
                                @if($dept->attendance_rate >= 75)
                                    <span class="ent-badge ent-badge-success"><i class='bx bx-trending-up'></i> {{ $dept->attendance_rate }}%</span>
                                @else
                                    <span class="ent-badge ent-badge-danger"><i class='bx bx-trending-down'></i> {{ $dept->attendance_rate }}%</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
