<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUserRole;

class AdminUserRoleController extends Controller
{
    /**
     * Display a listing of the AdminUserRoles.
     */
    public function getAllAdminUserRoles()
    {
        $adminUserRoles = AdminUserRole::all();

        return response()->json([
            'data' => $adminUserRoles
        ], 200);
    }

    /**
     * Post a newly created AdminUserRole in storage.
     */
    public function createAdminUserRole(Request $request)
    {
        $validatedData = $request->validate([
            'admins_id' => 'required|exists:admins,id',
            'admin_roles_id' => 'required|exists:admin_roles,id',
        ]);

        $adminUserRole = AdminUserRole::create($validatedData);

        return response()->json([
            'message' => 'Admin user role created successfully',
            'data' => $adminUserRole
        ], 201);
    }

    /**
     * Update the specified AdminUserRole in storage.
     */
    public function updateAdminUserRole(Request $request, $id)
    {
        $adminUserRole = AdminUserRole::findOrFail($id);

        $validatedData = $request->validate([
            'admins_id' => 'required|exists:admins,id',
            'admin_roles_id' => 'required|exists:admin_roles,id',
        ]);

        $adminUserRole->admins_id = $request->input('admins_id');
        $adminUserRole->admin_roles_id = $request->input('admin_roles_id');
        $adminUserRole->save();

        return response()->json([
            'message' => 'Admin user role updated successfully',
            'adminUserRole' => $adminUserRole
        ], 200);
    }

    /**
     * Remove the specified AdminUserRole from storage.
     */
    public function deleteAdminUserRole($id)
    {
        $adminUserRole = AdminUserRole::findOrFail($id);
        $adminUserRole->delete();

        return response()->json([
            'message' => 'Admin user role deleted successfully'
        ], 200);
    }
}