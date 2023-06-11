<?php

namespace App\Http\Controllers;
use App\Models\Farm;


use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the farms.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllFarm()
    {
        $farms = Farm::all();

        return response()->json($farms);
    }

    /**
     * Store a newly created farm in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createFarm(Request $request)
    {
        $farm = Farm::create($request->all());

        return response()->json($farm, 201);
    }

    /**
     * Display the specified farm.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function FarmById($id)
    {
        $farm = Farm::findOrFail($id);

        return response()->json($farm);
    }

    /**
     * Update the specified farm in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFarm(Request $request, $id)
    {
        $farm = Farm::findOrFail($id);
        $farm->update($request->all());

        return response()->json($farm, 200);
    }

    /**
     * Remove the specified farm from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyFarm($id)
    {
        Farm::findOrFail($id)->delete();

        return response()->json(['message' => 'Farm deleted'], 200);
    }
}
