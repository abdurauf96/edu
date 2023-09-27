<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function getRole(string $name): Role
    {
        return Role::where('name', $name)->firstOrFail();
    }

    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdmin     = $this->getRole('super-admin');
        $admins         = $this->getRole('admin');
        $cashiers       = $this->getRole('cashier');
        $managers       = $this->getRole('manager');
        $hrs            = $this->getRole('hr');
        $receptionists  = $this->getRole('reception');

        // create permissions
        $permissions = [
            // admin
            'admin_management_access',
            'admin_create',
            'admin_edit',
            'admin_show',
            'admin_delete',
            'admin_access',
            // roles
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            // permissions
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            // schools
            'school_create',
            'school_edit',
            'school_show',
            'school_delete',
            'school_access',
            // districts
            'district_create',
            'district_edit',
            'district_show',
            'district_delete',
            'district_access',
            // users
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            // logins
            'login_create',
            'login_edit',
            'login_show',
            'login_delete',
            'login_access',
            // payment
            'payment_create',
            'payment_edit',
            'payment_show',
            'payment_delete',
            'payment_access',
            // teacher
            'teacher_create',
            'teacher_edit',
            'teacher_show',
            'teacher_delete',
            'teacher_access',
            // teacher plans
            'teacher_plan_create',
            'teacher_plan_edit',
            'teacher_plan_show',
            'teacher_plan_delete',
            'teacher_plan_access',
            // courses
            'course_create',
            'course_edit',
            'course_show',
            'course_delete',
            'course_access',
            // groups
            'group_create',
            'group_edit',
            'group_show',
            'group_delete',
            'group_access',
            // rooms
            'room_create',
            'room_edit',
            'room_show',
            'room_delete',
            'room_access',
            // profile
            'profile_create',
            'profile_edit',
            'profile_show',
            'profile_delete',
            'profile_access',
            // students
            'students_create',
            'students_edit',
            'students_show',
            'students_delete',
            'students_access',
            // appeals
            'appeal_create',
            'appeal_edit',
            'appeal_show',
            'appeal_delete',
            'appeal_access',
            // waiting students
            'waiting_student_create',
            'waiting_student_edit',
            'waiting_student_show',
            'waiting_student_delete',
            'waiting_student_access',
            // organizations
            'organization_create',
            'organization_edit',
            'organization_show',
            'organization_delete',
            'organization_access',
            // staffs
            'staff_create',
            'staff_edit',
            'staff_show',
            'staff_delete',
            'staff_access',
            // others
            'events_access',
            'reports_access',
        ];

        foreach($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        // Give permissions to roles
        $superAdminPermissions = [
            // admin
            'admin_management_access',
            'admin_create',
            'admin_edit',
            'admin_show',
            'admin_delete',
            'admin_access',
            // roles
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            // permissions
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
            // schools
            'school_create',
            'school_edit',
            'school_show',
            'school_delete',
            'school_access',
            // districts
            'district_create',
            'district_edit',
            'district_show',
            'district_delete',
            'district_access',
            // other
            'school_access',
            'students_access',
        ];

        $adminPermissions = [
            // users
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            // logins
            'login_create',
            'login_edit',
            'login_show',
            'login_delete',
            'login_access',
            // payment
            'payment_create',
            'payment_edit',
            'payment_show',
            'payment_delete',
            'payment_access',
            // teacher
            'teacher_create',
            'teacher_edit',
            'teacher_show',
            'teacher_delete',
            'teacher_access',
            // courses
            'course_create',
            'course_edit',
            'course_show',
            'course_delete',
            'course_access',
            // groups
            'group_create',
            'group_edit',
            'group_show',
            'group_delete',
            'group_access',
            // rooms
            'room_create',
            'room_edit',
            'room_show',
            'room_delete',
            'room_access',
            // profile
            'profile_create',
            'profile_edit',
            'profile_show',
            'profile_delete',
            'profile_access',
            // students
            'students_create',
            'students_edit',
            'students_show',
            'students_delete',
            'students_access',
            // appeals
            'appeal_create',
            'appeal_edit',
            'appeal_show',
            'appeal_delete',
            'appeal_access',
            // waiting students
            'waiting_student_create',
            'waiting_student_edit',
            'waiting_student_show',
            'waiting_student_delete',
            'waiting_student_access',
            // organizations
            'organization_create',
            'organization_edit',
            'organization_show',
            'organization_delete',
            'organization_access',
            // staffs
            'staff_create',
            'staff_edit',
            'staff_show',
            'staff_delete',
            'staff_access',
            // other
            'events_access',
            'reports_access',
        ];

        $cashierPermissions = [
            // payment
            'payment_create',
            'payment_edit',
            'payment_show',
            'payment_delete',
            'payment_access',
        ];

        $managerPermissions = [
            // payment
            'payment_create',
            'payment_edit',
            'payment_show',
            'payment_delete',
            'payment_access',
            // teacher
            'teacher_create',
            'teacher_edit',
            'teacher_show',
            'teacher_delete',
            'teacher_access',
            // courses
            'course_create',
            'course_edit',
            'course_show',
            'course_delete',
            'course_access',
            // groups
            'group_create',
            'group_edit',
            'group_show',
            'group_delete',
            'group_access',
            // rooms
            'room_create',
            'room_edit',
            'room_show',
            'room_delete',
            'room_access',
            // profile
            'profile_create',
            'profile_edit',
            'profile_show',
            'profile_delete',
            'profile_access',
            // students
            'students_create',
            'students_edit',
            'students_show',
            'students_delete',
            'students_access',
            // appeals
            'appeal_create',
            'appeal_edit',
            'appeal_show',
            'appeal_delete',
            'appeal_access',
            // other
            'reports_access',
        ];

        $hrPermissions = [
            // organizations
            'organization_create',
            'organization_edit',
            'organization_show',
            'organization_delete',
            'organization_access',
            // staffs
            'staff_create',
            'staff_edit',
            'staff_show',
            'staff_delete',
            'staff_access',
            // other
            'events_access',
        ];

        $receptionistPermissions = [
            // waiting students
            'waiting_student_create',
            'waiting_student_edit',
            'waiting_student_show',
            'waiting_student_delete',
            'waiting_student_access',
        ];

        foreach($superAdminPermissions as $permission) {
            $superAdmin->givePermissionTo($permission);
        }

        foreach ($admins as $admin) {
            $admin->syncPermissions($adminPermissions);
        }

        foreach ($cashiers as $cashier) {
            $cashier->syncPermissions($cashierPermissions);
        }

        foreach ($managers as $manager) {
            $manager->syncPermissions($managerPermissions);
        }

        foreach ($hrs as $hr) {
            $hr->syncPermissions($hrPermissions);
        }

        foreach ($receptionists as $receptionist) {
            $receptionist->syncPermissions($receptionistPermissions);
        }
    }
}
