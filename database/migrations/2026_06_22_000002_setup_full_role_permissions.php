<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Permissions design per role:
     *
     * LECTURER     – attendance CRUD, devices, reports for own classes
     * HOD          – full department management
     * REGISTRAR    – view/export attendance & analytics, manage students
     * EXAM_OFFICER – exam eligibility, reports, timetable, users
     * QA           – view attendance, analytics, reports (read-heavy)
     * DIRECTOR     – analytics, departments, HODs, reports
     * RECTOR       – top-level analytics and reports
     * STUDENT      – own attendance, timetable, modules
     */
    private array $permissions = [

        // ── LECTURER ──────────────────────────────────────────────
        ['name' => 'View Attendance Records',     'key' => 'view_attendance',          'group' => 'Attendance',   'roles' => ['lecturer']],
        ['name' => 'Mark Attendance',             'key' => 'create_attendance',        'group' => 'Attendance',   'roles' => ['lecturer']],
        ['name' => 'Edit Attendance Record',      'key' => 'edit_attendance',          'group' => 'Attendance',   'roles' => ['lecturer']],
        ['name' => 'Delete Attendance Record',    'key' => 'delete_attendance',        'group' => 'Attendance',   'roles' => ['lecturer']],
        ['name' => 'Manage Biometric Devices',    'key' => 'manage_devices',           'group' => 'Devices',      'roles' => ['lecturer']],
        ['name' => 'View My Class Reports',       'key' => 'view_own_reports',         'group' => 'Reports',      'roles' => ['lecturer']],

        // ── HOD ───────────────────────────────────────────────────
        ['name' => 'View Department Attendance',  'key' => 'hod_view_attendance',      'group' => 'Attendance',   'roles' => ['hod']],
        ['name' => 'Export Department Reports',   'key' => 'hod_export_reports',       'group' => 'Reports',      'roles' => ['hod']],
        ['name' => 'Manage Lecturers',            'key' => 'hod_manage_lecturers',     'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'Manage Modules',              'key' => 'hod_manage_modules',       'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'Manage Programs',             'key' => 'hod_manage_programs',      'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'Manage Roles',                'key' => 'hod_manage_roles',         'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'Manage Academic Weeks',       'key' => 'hod_manage_weeks',         'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'Manage Class Timings',        'key' => 'hod_manage_class_timings', 'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'Manage Students',             'key' => 'hod_manage_students',      'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'Assign Modules to Lecturers', 'key' => 'hod_assign_modules',       'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'Manage Role Permissions',     'key' => 'hod_manage_permissions',   'group' => 'Management',   'roles' => ['hod']],
        ['name' => 'View Analytics Dashboard',    'key' => 'hod_view_analytics',       'group' => 'Analytics',    'roles' => ['hod']],

        // ── REGISTRAR ─────────────────────────────────────────────
        ['name' => 'View All Attendance',         'key' => 'reg_view_attendance',      'group' => 'Attendance',   'roles' => ['registrar']],
        ['name' => 'Export Attendance Reports',   'key' => 'reg_export_reports',       'group' => 'Reports',      'roles' => ['registrar']],
        ['name' => 'Manage Students',             'key' => 'reg_manage_students',      'group' => 'Management',   'roles' => ['registrar']],
        ['name' => 'View Analytics',              'key' => 'reg_view_analytics',       'group' => 'Analytics',    'roles' => ['registrar']],

        // ── EXAMINATION OFFICER ───────────────────────────────────
        ['name' => 'View Exam Eligibility',       'key' => 'exam_view_eligibility',    'group' => 'Examination',  'roles' => ['examination_officer']],
        ['name' => 'View Exam Reports',           'key' => 'exam_view_reports',        'group' => 'Examination',  'roles' => ['examination_officer']],
        ['name' => 'Manage Exam Timetable',       'key' => 'exam_manage_timetable',    'group' => 'Examination',  'roles' => ['examination_officer']],
        ['name' => 'Manage Users',                'key' => 'exam_manage_users',        'group' => 'Management',   'roles' => ['examination_officer']],
        ['name' => 'Export Exam Reports',         'key' => 'exam_export_reports',      'group' => 'Reports',      'roles' => ['examination_officer']],

        // ── QUALITY ASSURANCE ─────────────────────────────────────
        ['name' => 'View All Attendance',         'key' => 'qa_view_attendance',       'group' => 'Attendance',   'roles' => ['quality_assurance']],
        ['name' => 'View Analytics Dashboard',    'key' => 'qa_view_analytics',        'group' => 'Analytics',    'roles' => ['quality_assurance']],
        ['name' => 'View All Reports',            'key' => 'qa_view_reports',          'group' => 'Reports',      'roles' => ['quality_assurance']],
        ['name' => 'Export Quality Reports',      'key' => 'qa_export_reports',        'group' => 'Reports',      'roles' => ['quality_assurance']],

        // ── DIRECTOR ACADEMIC ─────────────────────────────────────
        ['name' => 'View Analytics Dashboard',    'key' => 'dir_view_analytics',       'group' => 'Analytics',    'roles' => ['director_academic']],
        ['name' => 'Manage Departments',          'key' => 'dir_manage_departments',   'group' => 'Management',   'roles' => ['director_academic']],
        ['name' => 'Manage HODs',                 'key' => 'dir_manage_hods',          'group' => 'Management',   'roles' => ['director_academic']],
        ['name' => 'View All Reports',            'key' => 'dir_view_reports',         'group' => 'Reports',      'roles' => ['director_academic']],
        ['name' => 'Export Institution Reports',  'key' => 'dir_export_reports',       'group' => 'Reports',      'roles' => ['director_academic']],

        // ── RECTOR ────────────────────────────────────────────────
        ['name' => 'View Analytics Dashboard',    'key' => 'rector_view_analytics',    'group' => 'Analytics',    'roles' => ['rector']],
        ['name' => 'View All Institution Reports','key' => 'rector_view_reports',      'group' => 'Reports',      'roles' => ['rector']],
        ['name' => 'Export Institution Reports',  'key' => 'rector_export_reports',    'group' => 'Reports',      'roles' => ['rector']],

        // ── STUDENT ───────────────────────────────────────────────
        ['name' => 'View Own Attendance',         'key' => 'student_view_attendance',  'group' => 'Attendance',   'roles' => ['student']],
        ['name' => 'View Timetable',              'key' => 'student_view_timetable',   'group' => 'Timetable',    'roles' => ['student']],
        ['name' => 'View Enrolled Modules',       'key' => 'student_view_modules',     'group' => 'Modules',      'roles' => ['student']],
    ];

    /**
     * Default permission assignments per role (keys that are pre-assigned).
     * HOD decides what to grant or revoke for each user.
     */
    private array $defaults = [
        'lecturer'           => [
            'view_attendance', 'create_attendance', 'edit_attendance',
            'delete_attendance', 'manage_devices', 'view_own_reports',
        ],
        'hod'                => [
            'hod_view_attendance', 'hod_export_reports', 'hod_manage_lecturers',
            'hod_manage_modules', 'hod_manage_programs', 'hod_manage_roles',
            'hod_manage_weeks', 'hod_manage_class_timings', 'hod_manage_students',
            'hod_assign_modules', 'hod_manage_permissions', 'hod_view_analytics',
        ],
        'registrar'          => [
            'reg_view_attendance', 'reg_export_reports', 'reg_view_analytics',
            // reg_manage_students NOT assigned by default — HOD controls that
        ],
        'examination_officer' => [
            'exam_view_eligibility', 'exam_view_reports',
            'exam_manage_timetable', 'exam_manage_users', 'exam_export_reports',
        ],
        'quality_assurance'  => [
            'qa_view_attendance', 'qa_view_analytics', 'qa_view_reports',
            // qa_export_reports NOT assigned by default — requires explicit grant
        ],
        'director_academic'  => [
            'dir_view_analytics', 'dir_manage_departments',
            'dir_manage_hods', 'dir_view_reports',
            // dir_export_reports NOT assigned by default
        ],
        'rector'             => [
            'rector_view_analytics', 'rector_view_reports',
            // rector_export_reports NOT assigned by default
        ],
        'student'            => [
            'student_view_attendance', 'student_view_timetable', 'student_view_modules',
        ],
    ];

    public function up(): void
    {
        // Upsert each permission (update applicable_roles if key already exists)
        foreach ($this->permissions as $perm) {
            $exists = DB::table('permissions')->where('key', $perm['key'])->exists();

            if ($exists) {
                DB::table('permissions')->where('key', $perm['key'])->update([
                    'name'             => $perm['name'],
                    'group'            => $perm['group'],
                    'applicable_roles' => json_encode($perm['roles']),
                    'updated_at'       => now(),
                ]);
            } else {
                DB::table('permissions')->insert([
                    'name'             => $perm['name'],
                    'key'              => $perm['key'],
                    'group'            => $perm['group'],
                    'applicable_roles' => json_encode($perm['roles']),
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
        }

        // Assign defaults to each role (only insert missing, never remove existing)
        foreach ($this->defaults as $roleName => $keys) {
            $roleId = DB::table('roles')
                ->whereRaw('LOWER(name) = ?', [strtolower($roleName)])
                ->value('id');

            if (! $roleId) {
                continue;
            }

            foreach ($keys as $key) {
                $permId = DB::table('permissions')->where('key', $key)->value('id');
                if (! $permId) {
                    continue;
                }

                $already = DB::table('role_permissions')
                    ->where('role_id', $roleId)
                    ->where('permission_id', $permId)
                    ->exists();

                if (! $already) {
                    DB::table('role_permissions')->insert([
                        'role_id'       => $roleId,
                        'permission_id' => $permId,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                }
            }
        }
    }

    public function down(): void
    {
        $keys = array_column($this->permissions, 'key');
        $ids  = DB::table('permissions')->whereIn('key', $keys)->pluck('id');
        DB::table('role_permissions')->whereIn('permission_id', $ids)->delete();
        DB::table('permissions')->whereIn('key', $keys)->delete();
    }
};
