<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerUserRole;
;


class CustomerUserRoleController extends Controller
{
    /**
     * Display a listing of the CustomerUserRoles.
     */
    public function getAllCustomerUserRoles()
    {
        $customerUserRoles = CustomerUserRole::all();

        return response()->json([
            'data' => $customerUserRoles
        ], 200);
    }

    /**
     * Post a newly created CustomerUserRole in storage.
     */
    public function createCustomerUserRole(Request $request)
    {
        $validatedData = $request->validate([
            'customers_id' => 'required|exists:customers,id',
            'customer_roles_id' => 'required|exists:customer_roles,id',
        ]);

        $customerUserRole = CustomerUserRole::create($validatedData);

        return response()->json([
            'message' => 'Customer user role created successfully',
            'data' => $customerUserRole
        ], 201);
    }

    /**
     * Update the specified CustomerUserRole in storage.
     */
    public function updateCustomerUserRole(Request $request, $id)
    {
        $customerUserRole = CustomerUserRole::findOrFail($id);

        $validatedData = $request->validate([
            'customers_id' => 'required|exists:customers,id',
            'customer_roles_id' => 'required|exists:customer_roles,id',
        ]);

        $customerUserRole->customers_id = $request->input('customers_id');
        $customerUserRole->customer_roles_id = $request->input('customer_roles_id');
        $customerUserRole->save();

        return response()->json([
            'message' => 'Customer user role updated successfully',
            'customerUserRole' => $customerUserRole
        ], 200);
    }

    /**
     * Remove the specified CustomerUserRole from storage.
     */
    public function deleteCustomerUserRole($id)
    {
        $customerUserRole = CustomerUserRole::findOrFail($id);
        $customerUserRole->delete();

        return response()->json([
            'message' => 'Customer user role deleted successfully'
        ], 200);
    }
}
