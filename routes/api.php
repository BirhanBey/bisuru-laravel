<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserRoleController;
use App\Http\Controllers\CoopController;
use App\Http\Controllers\CoopStaffController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FarmStaffController;
use App\Http\Controllers\AnimalController;
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

    // Cooperatives Routes

    // Display a listing of the cooperatives.
    Route::get('/cooperatives', [CoopController::class, 'getAllCooperatives']);
    // Store a newly created cooperative in storage.
    Route::post('/cooperatives', [CoopController::class, 'createCooperative']);
    //Display the specified cooperative.
    Route::get('/cooperatives/{id}', [CoopController::class, 'CooperativeById']);
    // Update the specified cooperative in storage.
    Route::put('/cooperatives/{id}', [CoopController::class, 'updateCooperative']);
    // Remove the specified cooperative from storage.
    Route::delete('/cooperatives/{id}', [CoopController::class, 'destroyCooperative']);

    // Cooperative Staff's Routes

    // Display a listing of the Cooperative Staffs.
    Route::get('/coopstaffs', [CoopStaffController::class, 'getAllCoopStaff']);
    // Store a newly created Cooperative Staff in storage.
    Route::post('/coopstaffs', [CoopStaffController::class, 'createCoopStaff']);
    // Display the specified Cooperative Staff.
    Route::get('/coopstaffs/{id}', [CoopStaffController::class, 'CoopStaffById']);
    // Update the specified Cooperative Staff in storage.
    Route::put('/coopstaffs/{id}', [CoopStaffController::class, 'updateCoopStaff']);
    // Remove the specified Cooperative Staff from storage.
    Route::delete('/coopstaffs/{id}', [CoopStaffController::class, 'destroyCoopStaff']);

    // Farmer's Routes

    // Display a listing of the Farmer.
    Route::get('/farmers', [FarmerController::class, 'getAllFarmer']);
    // Store a newly created Farmer in storage.
    Route::post('/farmers', [FarmerController::class, 'createFarmer']);
    // Display the specified Farmer.
    Route::get('/farmers/{id}', [FarmerController::class, 'FarmerById']);
    // Update the specified Farmer in storage.
    Route::put('/farmers/{id}', [FarmerController::class, 'updateFarmer']);
    // Remove the specified Farmer from storage.
    Route::delete('/farmers/{id}', [FarmerController::class, 'destroyFarmer']);

    // Farm's Routes

    // Display a listing of the Farm.
    Route::get('/farms', [FarmController::class, 'getAllFarm']);
    // Store a newly created Farm in storage.
    Route::post('/farms', [FarmController::class, 'createFarm']);
    // Display the specified Farm.
    Route::get('/farms/{id}', [FarmController::class, 'FarmById']);
    // Update the specified Farm in storage.
    Route::put('/farms/{id}', [FarmController::class, 'updateFarm']);
    // Remove the specified Farm from storage.
    Route::delete('/farms/{id}', [FarmController::class, 'destroyFarm']);

    // Farm Staff's Routes

    // Display a listing of the FarmStaff.
    Route::get('/farmstaff', [FarmStaffController::class, 'getAllFarmStaff']);
    // Store a newly created FarmStaff in storage.
    Route::post('/farmstaff', [FarmStaffController::class, 'createFarmStaff']);
    // Display the specified FarmStaff.
    Route::get('/farmstaff/{id}', [FarmStaffController::class, 'FarmStaffById']);
    // Update the specified FarmStaff in storage.
    Route::put('/farmstaff/{id}', [FarmStaffController::class, 'updateFarmStaff']);
    // Remove the specified FarmStaff from storage.
    Route::delete('/farmstaff/{id}', [FarmStaffController::class, 'destroyFarmStaff']);

    // Animal's Routes

    // Display a listing of the Animal.
    Route::get('/animals', [AnimalController::class, 'getAllAnimals']);
    // Store a newly created Animal in storage.
    Route::post('/animals', [AnimalController::class, 'createAnimal']);
    // Display the specified Animal.
    Route::get('/animals/{id}', [AnimalController::class, 'AnimalById']);
    // Update the specified Animal in storage.
    Route::put('/animals/{id}', [AnimalController::class, 'updateAnimal']);
    // Remove the specified Animal from storage.
    Route::delete('/animals/{id}', [AnimalController::class, 'destroyAnimal']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
