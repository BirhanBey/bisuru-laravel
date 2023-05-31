<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminRole;

class AdminRoleController extends Controller
{
    /**
     * Display a listing of the AdminRoles.
     */
    public function getAllAdminRoles()
    {
        $adminRoles = AdminRole::all();

        return response()->json([
            'data' => $adminRoles
        ], 200);
    }

    /**
     * Post a newly created AdminRole in storage.
     */
    public function createAdminRole(Request $request)
    {
        $validatedData = $request->validate([
            'mainID' => 'nullable|string',
            'title' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $adminRole = AdminRole::create($validatedData);

        return response()->json([
            'message' => 'Admin role created successfully',
            'data' => $adminRole
        ], 201);
    }

    /**
     * Display the specified AdminRole.
     */
    public function getAdminRole($id)
    {
        $adminRole = AdminRole::findOrFail($id);

        return response()->json([
            'adminRole' => $adminRole
        ], 200);
    }

    /**
     * Update the specified Admin in storage.
     */
    public function updateAdminRole(Request $request, $id)
    {
        $adminRole = AdminRole::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|unique:admin_roles,title',
            'status' => 'required|boolean',
        ]);

        $adminRole->title = $request->input('title');
        $adminRole->status = $request->input('status');
        $adminRole->save();

        return response()->json([
            'message' => 'Admin Role updated successfully',
            'adminRole' => $adminRole
        ], 200);
    }

    /**
     * Remove the specified AdminRole from storage.
     */
    public function deleteAdminRole($id)
    {
        $adminRole = AdminRole::findOrFail($id);
        $adminRole->delete();

        return response()->json([
            'message' => 'Admin Role deleted successfully'
        ], 200);
    }

    /**
     * Search the specified AdminRole from storage by name.
     */
    public function searchAdminRoleByName($title)
    {
        return AdminRole::where('title', 'like', '%' . $title . '%')->get();
    }
}
