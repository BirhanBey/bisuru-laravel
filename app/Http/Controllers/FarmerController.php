<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    /**
     * Display a listing of the farmers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllFarmer()
    {
        $farmers = Farmer::all();

        return response()->json($farmers);
    }

    /**
     * Store a newly created farmer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFarmer(Request $request)
    {
        $farmer = Farmer::create($request->all());

        return response()->json($farmer, 201);
    }

    /**
     * Display the specified farmer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function FarmerById($id)
    {
        $farmer = Farmer::findOrFail($id);

        return response()->json($farmer);
    }

    /**
     * Update the specified farmer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFarmer(Request $request, $id)
    {
        $farmer = Farmer::findOrFail($id);
        $farmer->update($request->all());

        return response()->json($farmer, 200);
    }

    /**
     * Remove the specified farmer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFarmer($id)
    {
        Farmer::findOrFail($id)->delete();

        return response()->json(['message' => 'Farmer deleted'], 200);
    }
}
