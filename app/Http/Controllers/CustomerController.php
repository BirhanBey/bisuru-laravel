<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Post a newly created Admin in storage.
     */
    public function createCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
        ]);

        $customer = new Customer();
        $customer->name = $request->input('name');
        $customer->surname = $request->input('surname');
        $customer->email = $request->input('email');
        $customer->password = bcrypt($request->input('password'));
        $customer->phone_number = $request->input('phone_number');
        $customer->status = $request->input('status');
        $customer->image = $request->input('image');


        $customer->save();

        return response()->json([
            'message' => 'Customer created successfully',
            'customer' => $customer
        ], 201);
    }

    /**
     * Customer login and token creation
     */
    public function customerLogin(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $customer = Customer::where('email', $fields['email'])->first();

        // Check password
        if (!$customer || !Hash::check($fields['password'], $customer->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $customer->createToken('myapptoken')->plainTextToken;

        $response = [
            'customer' => $customer,
            'token' => $token
        ];

        return response($response, 201);
    }

    /**
     * Display a listing of the Customers.
     */

    public function getCustomersAndRelatedTables()
    {
        $customers = Customer::all();
        foreach ($customers as $customer) {
            $customer->loginLogs = DB::table('customer_login_logs')->where('customers_id', $customer->id)->get();
            $customer->roles = DB::table('customer_users_roles')
                ->join('customer_roles', 'customer_users_roles.customer_roles_id', '=', 'customer_roles.id')
                ->where('customer_users_roles.customers_id', $customer->id)
                ->get();
        }

        return $customers;
    }

    /**
     * Display the specified Customer.
     */
    public function getCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        return response()->json([
            'customer' => $customer
        ], 200);
    }

    /**
     * Update the specified Customer in storage.
     */
    public function updateCustomer(Request $request, string $id)
    {
            $customer = Customer::findOrFail($id);
            $customer->update($request->all());

        return response()->json([
            'message' => 'Customer updated successfully',
            'customer' => $customer
        ], 200);
    }

    /**
     * Remove the specified Customer from storage.
     */
    public function deleteCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully'
        ], 200);
    }

    /**
     * Search the specified Customer from storage by name.
     */
    public function searchCustomerByName($name)
    {
        return Customer::where('name', 'like', '%' . $name . '%')->get();
    }
}
