<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreImageRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Post a newly created Admin in storage.
     */
    public function createAdmin(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = new Admin();
        $admin->name = $request->input('name');
        $admin->surname = $request->input('surname');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->phone_number = $request->input('phone_number');
        $admin->status = $request->input('status');
        $admin->image = $request->input('image');


        $admin->save();

        return response()->json([
            'message' => 'Admin created successfully',
            'admin' => $admin
        ], 201);
    }

    /**
     * Admin login and token creation
     */
    public function adminLogin(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $admin = Admin::where('email', $fields['email'])->first();

        // Check password
        if (!$admin || !Hash::check($fields['password'], $admin->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $admin->createToken('bisuru')->plainTextToken;

        // Get admin info
        $adminInfo = new \stdClass();
        $adminInfo->loginLogs = DB::table('admin_login_logs')->where('admins_id', $admin->id)->get();
        $adminInfo->roles = DB::table('admin_users_roles')
            ->join('admin_roles', 'admin_users_roles.admin_roles_id', '=', 'admin_roles.id')
            ->select('admin_roles.id', 'admin_roles.title')
            ->where('admin_users_roles.admins_id', $admin->id)
            ->get();


        $response = [
            'admin' => $admin,
            'token' => $token,
            'adminInfo' => $adminInfo
        ];

        return response($response, 201);
    }

    /**
     * Display a listing of the Admins.
     */

    public function getAdminsAndRelatedTables()
    {
        $admins = Admin::all();
        foreach ($admins as $admin) {
            $admin->loginLogs = DB::table('admin_login_logs')->where('admins_id', $admin->id)->get();
            $admin->roles = DB::table('admin_users_roles')
                ->join('admin_roles', 'admin_users_roles.admin_roles_id', '=', 'admin_roles.id')
                ->where('admin_users_roles.admins_id', $admin->id)
                ->get();
        }

        return $admins;
    }

    /**
     * Display the specified Admin.
     */
    public function getAdmin($id)
    {
        $admin = Admin::findOrFail($id);

        return response()->json([
            'admin' => $admin
        ], 200);
    }

    /**
     * Update the specified Admin in storage.
     */
    public function updateAdmin(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update($request->all());

        return response()->json([
            'message' => 'Admin updated successfully',
            'admin' => $admin
        ], 200);
    }

    /**
     * Remove the specified Admin from storage.
     */
    public function deleteAdmin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return response()->json([
            'message' => 'Admin deleted successfully'
        ], 200);
    }

    /**
     * Search the specified Admin from storage by name.
     */
    public function searchAdminByName($name)
    {
        return Admin::where('name', 'like', '%' . $name . '%')->get();
    }

    /**
     * Admin logout and token destroy 
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful'
        ], 200);
    }

}
