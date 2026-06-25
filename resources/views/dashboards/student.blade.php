@extends('layouts.app')
@section('page-title', 'Dashboard — Student')

@section('content')

{{-- Page header --}}
<div class="ent-page-header">
    <div>
        <h1 class="ent-page-title">Habari, {{ $student->student_name ?? auth()->user()->name }}</h1>
        <p class="ent-page-sub">
            {{ $programName ?? 'Your Program' }}
            @if($departmentName) &nbsp;·&nbsp; {{ $departmentName }} @endif
        </p>
    </div>
    <div class="ent-page-actions">
        <a href="{{ route('studentmodules') }}" class="ent-btn ent-btn-outline ent-btn-sm">
            <i class='bx bx-book'></i> My Modules
        </a>
        <a href="{{ route('studenttimetable') }}" class="ent-btn ent-btn-primary ent-btn-sm">
            <i class='bx bx-calendar'></i> Timetable
        </a>
    </div>
</div>

{{-- Stat cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-4">
        <div class="ent-stat {{ $attendanceRate >= 75 ? 'ent-stat-success' : 'ent-stat-danger' }}">
            <div class="ent-stat-icon"><i class='bx bx-user-check'></i></div>
            <div class="ent-stat-value">{{ $attendanceRate }}%</div>
            <div class="ent-stat-label">Attendance Average</div>
            <div class="ent-stat-trend {{ $attendanceRate >= 75 ? 'up' : 'down' }}">
                <i class='bx {{ $attendanceRate >= 75 ? "bx-trending-up" : "bx-trending-down" }}'></i>
                {{ $attendanceStatus }}
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="ent-stat ent-stat-info">
            <div class="ent-stat-icon"><i class='bx bx-book-open'></i></div>
            <div class="ent-stat-value">{{ $totalModules }}</div>
            <div class="ent-stat-label">Registered Modules</div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="ent-stat ent-stat-warning">
            <div class="ent-stat-icon"><i class='bx bx-calendar-check'></i></div>
            <div class="ent-stat-value">{{ $totalRecords }}</div>
            <div class="ent-stat-label">Total Sessions</div>
        </div>
    </div>
</div>

{{-- Recent attendance --}}
<div class="ent-card">
    <div class="ent-card-header">
        <h2 class="ent-card-title"><i class='bx bx-history'></i> Recent Attendance</h2>
        <span class="ent-badge ent-badge-primary">{{ $recentAttendance->count() }} records</span>
    </div>
    <div class="ent-card-body" style="padding:0">
        @if($recentAttendance->isEmpty())
            <div class="ent-empty">
                <i class='bx bx-calendar-x'></i>
                <p>No attendance records yet.</p>
            </div>
        @else
            <table class="ent-table">
                <thead>
                    <tr>
                        <th>Module</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentAttendance as $rec)
                        <tr>
                            <td style="font-weight:600">{{ $rec->module_name }}</td>
                            <td style="color:var(--ent-text-muted)">{{ $rec->date }}</td>
                            <td>
                                @if($rec->is_present)
                                    <span class="ent-badge ent-badge-success"><i class='bx bx-check'></i> Present</span>
                                @else
                                    <span class="ent-badge ent-badge-danger"><i class='bx bx-x'></i> Absent</span>
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
