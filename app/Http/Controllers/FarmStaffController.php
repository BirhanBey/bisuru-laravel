<?php

namespace App\Http\Controllers;

use App\Models\FarmStaff;
use Illuminate\Http\Request;

class FarmStaffController extends Controller
{
    /**
     * Display a listing of the farm staff.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllFarmStaff()
    {
        $farmStaffs = FarmStaff::all();

        return response()->json($farmStaffs);
    }

    /**
     * Store a newly created farm staff in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFarmStaff(Request $request)
    {
        $farmStaff = FarmStaff::create($request->all());

        return response()->json($farmStaff, 201);
    }

    /**
     * Display the specified farm staff.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function FarmStaffById($id)
    {

        $farmStaff = FarmStaff::find($id);

        if (!$farmStaff) {
            return response()->json(['message' => 'Farm staff not found.'], 404);
        }

        return response()->json($farmStaff);
    }

    /**
     * Update the specified farm staff in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFarmStaff(Request $request, $id)
    {
        $farmStaff = FarmStaff::find($id);

        if (!$farmStaff) {
            return response()->json(['message' => 'Farm staff not found.'], 404);
        }

        $farmStaff->update($request->all());

        return response()->json($farmStaff);
    }

    /**
     * Remove the specified farm staff from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFarmStaff($id)
    {
        $farmStaff = FarmStaff::find($id);

        if (!$farmStaff) {
            return response()->json(['message' => 'Farm staff not found.'], 404);
        }

        $farmStaff->delete();

        return response()->json(['message' => 'Farm staff deleted.']);
    }
}
