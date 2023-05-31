<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerRole;

class CustomerRoleController extends Controller
{
    /**
     * Display a listing of the CustomerRoles.
     */
    public function getAllCustomerRoles()
    {
        $customerRoles = CustomerRole::all();

        return response()->json([
            'data' => $customerRoles
        ], 200);
    }

    /**
     * Post a newly created CustomerRole in storage.
     */
    public function createCustomerRole(Request $request)
    {
        $validatedData = $request->validate([
            'mainID' => 'nullable|string',
            'title' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $customerRole = CustomerRole::create($validatedData);

        return response()->json([
            'message' => 'Customer role created successfully',
            'data' => $customerRole
        ], 201);
    }

    /**
     * Display the specified CustomerRole.
     */
    public function getCustomerRole($id)
    {
        $customerRole = CustomerRole::findOrFail($id);

        return response()->json([
            'customerRole' => $customerRole
        ], 200);
    }

    /**
     * Update the specified CustomerRole in storage.
     */
    public function updateCustomerRole(Request $request, $id)
    {
        $customerRole = CustomerRole::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|unique:admin_roles,title',
            'status' => 'required|boolean',
        ]);

        $customerRole->title = $request->input('title');
        $customerRole->status = $request->input('status');
        $customerRole->save();

        return response()->json([
            'message' => 'Customer Role updated successfully',
            'customerRole' => $customerRole
        ], 200);
    }

    /**
     * Remove the specified CustomerRole from storage.
     */
    public function deleteCustomerRole($id)
    {
        $customerRole = CustomerRole::findOrFail($id);
        $customerRole->delete();

        return response()->json([
            'message' => 'Customer Role deleted successfully'
        ], 200);
    }

    /**
     * Search the specified CustomerRole from storage by name.
     */
    public function searchCustomerRoleByName($title)
    {
        return CustomerRole::where('title', 'like', '%' . $title . '%')->get();
    }
}
