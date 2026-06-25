<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $lecturerId = DB::table('roles')->where('name', 'lecturer')->value('id');

        if (! $lecturerId) {
            return;
        }

        $permissionKeys = ['view_attendance', 'create_attendance', 'edit_attendance', 'delete_attendance'];

        // Ensure permissions exist (insert if missing)
        $allRoles = DB::table('roles')->pluck('name')->map(fn ($n) => strtolower($n))->values()->toArray();

        $defaultPermissions = [
            ['name' => 'View Attendance Records',  'key' => 'view_attendance',   'group' => 'Attendance'],
            ['name' => 'Mark Attendance',           'key' => 'create_attendance', 'group' => 'Attendance'],
            ['name' => 'Edit Attendance Record',    'key' => 'edit_attendance',   'group' => 'Attendance'],
            ['name' => 'Delete Attendance Record',  'key' => 'delete_attendance', 'group' => 'Attendance'],
        ];

        foreach ($defaultPermissions as $perm) {
            $exists = DB::table('permissions')->where('key', $perm['key'])->exists();
            if (! $exists) {
                DB::table('permissions')->insert([
                    'name'             => $perm['name'],
                    'key'              => $perm['key'],
                    'group'            => $perm['group'],
                    'applicable_roles' => json_encode($allRoles),
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            } else {
                // Update applicable_roles to include all roles
                DB::table('permissions')
                    ->where('key', $perm['key'])
                    ->update([
                        'applicable_roles' => json_encode($allRoles),
                        'updated_at'       => now(),
                    ]);
            }
        }

        // Assign all attendance permissions to lecturer role
        foreach ($permissionKeys as $key) {
            $permId = DB::table('permissions')->where('key', $key)->value('id');
            if (! $permId) {
                continue;
            }

            $already = DB::table('role_permissions')
                ->where('role_id', $lecturerId)
                ->where('permission_id', $permId)
                ->exists();

            if (! $already) {
                DB::table('role_permissions')->insert([
                    'role_id'       => $lecturerId,
                    'permission_id' => $permId,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        $lecturerId = DB::table('roles')->where('name', 'lecturer')->value('id');
        if (! $lecturerId) {
            return;
        }

        $permissionIds = DB::table('permissions')
            ->whereIn('key', ['view_attendance', 'create_attendance', 'edit_attendance', 'delete_attendance'])
            ->pluck('id');

        DB::table('role_permissions')
            ->where('role_id', $lecturerId)
            ->whereIn('permission_id', $permissionIds)
            ->delete();
    }
};
