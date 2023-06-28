<?php

namespace App\Http\Controllers;

use App\Models\Cooperative;
use App\Models\Farmer;
use Illuminate\Http\Request;

class CoopController extends Controller
{
    /**
     * Display a listing of the cooperatives.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCooperatives()
    {
        $cooperatives = Cooperative::with('cooperative_staffs', 'farmers.farms.farmstaff', 'farmers.farms.animals')->get();

        return response()->json($cooperatives);
    }

    /**
     * Display CoopStaff list of a Cooperative
     */
    public function getCoopStaff($cooperativeId)
    {
        $cooperative = Cooperative::with('cooperative_staffs')
            ->find($cooperativeId);

        if (!$cooperative) {
            return response()->json(['error' => 'Cooperative not found'], 404);
        }

        return response()->json($cooperative);
    }

    /**
     * Display farmers list of a Cooperative
     */
    public function getFarmersByCoopId($cooperativeId)
    {
        $cooperative = Cooperative::with('farmers')
            ->find($cooperativeId);

        if (!$cooperative) {
            return response()->json(['error' => 'farmers not found'], 404);
        }

        return response()->json($cooperative);
    }

    /**
     * Store a newly created cooperative in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCooperative(Request $request)
    {
        $cooperative = Cooperative::create($request->all());

        return response()->json($cooperative, 201);
    }

    /**
     * Display the specified cooperative.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function CooperativeById($id)
    {
        $cooperative = Cooperative::with('cooperative_staffs', 'farmers.farms.farmstaff', 'farmers.farms.animals')->findOrFail($id);

        return response()->json($cooperative);
    }

    /**
     * Update the specified cooperative in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCooperative(Request $request, $id)
    {
        $cooperative = Cooperative::findOrFail($id);
        $cooperative->update($request->all());

        return response()->json($cooperative, 200);
    }

    /**
     * Remove the specified cooperative from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyCooperative($id)
    {
        Cooperative::findOrFail($id)->delete();

        return response()->json(['message' => 'Cooperative deleted'], 200);
    }
}
