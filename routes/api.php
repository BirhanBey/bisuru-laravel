<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserRoleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerRoleController;
use App\Http\Controllers\CustomerUserRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// public routes

// Post a newly created Admin in storage.
Route::post('/register', [AdminController::class, 'createAdmin']);
// Admin login and token creation
Route::post('/login', [AdminController::class, 'adminLogin']);
// Customer login and token creation
Route::post('/logincustomer', [CustomerController::class, 'customerLogin']);
// Display a listing of the Admins.
Route::get('/admins', [AdminController::class, 'getAdminsAndRelatedTables']);
// Display the specified Admin.
Route::get('/admins/{id}', [AdminController::class, 'getAdmin']);
// Search the specified Admin from storage by name.
Route::get('/admins/search/{name}', [AdminController::class, 'searchAdminByName']);


// protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Update the specified Admin in storage.
    Route::patch('/admins/{id}', [AdminController::class, 'updateAdmin'])->middleware('auth', 'check_user_ownership');
    // Remove the specified Admin from storage.
    Route::delete('/admins/{id}', [AdminController::class, 'deleteAdmin'])->middleware('auth', 'check_user_ownership');

    //AdminRole's Routes

    // Display a listing of the AdminRoles.
    Route::get('/adminroles', [AdminRoleController::class, 'getAllAdminRoles']);
    // Post a newly created AdminRole in storage.
    Route::post('/adminroles', [AdminRoleController::class, 'createAdminRole']);
    // Display the specified AdminRole.
    Route::get('/adminroles/{id}', [AdminRoleController::class, 'getAdminRole'])->middleware('auth', 'check_user_ownership');
    // Update the specified AdminRole in storage.
    Route::patch('/adminroles/{id}', [AdminRoleController::class, 'updateAdminRole'])->middleware('auth', 'check_user_ownership');
    // Remove the specified AdminRole from storage.
    Route::delete('/adminroles/{id}', [AdminRoleController::class, 'deleteAdminRole'])->middleware('auth', 'check_user_ownership');
    // Search the specified AdminRole from storage by name.
    Route::get('/adminroles/search/{name}', [AdminRoleController::class, 'searchAdminRoleByName']);
    // Admin logout and token destroy
    Route::post('/logout', [AdminController::class, 'logout']);

    //AdminUserRole's Routes

    // Display a listing of the AdminUserRoles.
    Route::get('/adminuserroles', [AdminUserRoleController::class, 'getAllAdminUserRoles']);
    // Post a newly created AdminUserRole in storage.
    Route::post('/adminuserroles', [AdminUserRoleController::class, 'createAdminUserRole']);
    // Update the specified AdminUserRole in storage.
    Route::patch('/adminuserroles/{id}', [AdminUserRoleController::class, 'updateAdminUserRole']);
    // Remove the specified AdminUserRole from storage.
    Route::delete('/adminuserroles/{id}', [AdminUserRoleController::class, 'deleteAdminUserRole']);

    //Customers's Routes

    // Post a newly created Customer in storage.
    Route::post('/registercustomer', [CustomerController::class, 'createCustomer']);
    // Display a listing of the Customers.
    Route::get('/customers', [CustomerController::class, 'getCustomersAndRelatedTables']);
    // Display the specified Customer.
    Route::get('/customers/{id}', [CustomerController::class, 'getCustomer']);
    // Update the specified Customer in storage.
    Route::patch('/customers/{id}', [CustomerController::class, 'updateCustomer'])->middleware('auth', 'check_user_ownership');
    // Remove the specified Admin from storage.
    Route::delete('/customers/{id}', [CustomerController::class, 'deleteCustomer']);
    // Search the specified Customer from storage by name.
    Route::get('/customers/search/{name}', [CustomerController::class, 'searchCustomerByName']);
    // Admin logout and token destroy
    Route::post('/logoutcustomer', [CustomerController::class, 'logoutCustomer']);


    //CustomerRole's Routes

    // Display a listing of the CustomerRoles.
    Route::get('/customerroles', [CustomerRoleController::class, 'getAllCustomerRoles']);
    // Post a newly created CustomerRole in storage.
    Route::post('/customerroles', [CustomerRoleController::class, 'createCustomerRole']);
    // Display the specified CustomerRole.
    Route::get('/customerroles/{id}', [CustomerRoleController::class, 'getCustomerRole']);
    // Update the specified CustomerRole in storage.
    Route::patch('/customerroles/{id}', [CustomerRoleController::class, 'updateCustomerRole']);
    // Remove the specified CustomerRole from storage.
    Route::delete('/customerroles/{id}', [CustomerRoleController::class, 'deleteCustomerRole']);
    // Search the specified CustomerRole from storage by name.
    Route::get('/customerroles/search/{name}', [CustomerRoleController::class, 'searchCustomerRoleByName']);


    //CustomerUserRole's Routes

    // Display a listing of the CustomerUserRole.
    Route::get('/customeruserroles', [CustomerUserRoleController::class, 'getAllCustomerUserRoles']);
    // Post a newly created CustomerUserRole in storage.
    Route::post('/customeruserroles', [CustomerUserRoleController::class, 'createCustomerUserRole']);
    // Update the specified CustomerUserRole in storage.
    Route::patch('/customeruserroles/{id}', [CustomerUserRoleController::class, 'updateCustomerUserRole']);
    // Remove the specified CustomerUserRole from storage.
    Route::delete('/customeruserroles/{id}', [CustomerUserRoleController::class, 'deleteCustomerUserRole']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
