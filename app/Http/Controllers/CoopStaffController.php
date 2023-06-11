<?php

namespace App\Http\Controllers;

use App\Models\CooperativeStaff;
use Illuminate\Http\Request;

class CoopStaffController extends Controller
{
    /**
     * Display a listing of the cooperative staffs.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCoopStaff()
    {
        $cooperativeStaffs = CooperativeStaff::all();

        return response()->json($cooperativeStaffs);
    }

    /**
     * Store a newly created cooperative staff in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCoopStaff(Request $request)
    {
        $cooperativeStaff = CooperativeStaff::create($request->all());

        return response()->json($cooperativeStaff, 201);
    }

    /**
     * Display the specified cooperative staff.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CoopStaffById($id)
    {
        $cooperativeStaff = CooperativeStaff::findOrFail($id);

        return response()->json($cooperativeStaff);
    }

    /**
     * Update the specified cooperative staff in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCoopStaff(Request $request, $id)
    {
        $cooperativeStaff = CooperativeStaff::findOrFail($id);
        $cooperativeStaff->update($request->all());

        return response()->json($cooperativeStaff, 200);
    }

    /**
     * Remove the specified cooperative staff from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCoopStaff($id)
    {
        CooperativeStaff::findOrFail($id)->delete();

        return response()->json(['message' => 'Cooperative staff deleted'], 200);
    }
}
