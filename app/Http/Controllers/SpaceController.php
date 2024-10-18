<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpaceCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Space;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $spaces = new SpaceCollection(Space::all());
            return ApiResponse::success('Listado De los Espacios',201,$spaces);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $spaces = new SpaceCollection(Space::query()->where('id',$id)->get());
            if ($spaces->isEmpty()) throw new ModelNotFoundException("Espacio no encontrado");
            return ApiResponse::success( 'Espacio Encontrado',200,$spaces);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Espacio no encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Space $space)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Space $space)
    {
        //
    }
}
