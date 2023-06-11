<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the animals.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllAnimals()
    {
        $animals = Animal::all();

        return response()->json($animals);
    }

    /**
     * Store a newly created animal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createAnimal(Request $request)
    {
        $animal = Animal::create($request->all());

        return response()->json($animal, 201);
    }

    /**
     * Display the specified animal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function AnimalById($id)
    {
        $animal = Animal::findOrFail($id);

        return response()->json($animal);
    }

    /**
     * Update the specified animal in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAnimal(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);
        $animal->update($request->all());

        return response()->json($animal, 200);
    }

    /**
     * Remove the specified animal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAnimal($id)
    {
        Animal::findOrFail($id)->delete();

        return response()->json(['message' => 'Animal deleted'], 200);
    }
}
