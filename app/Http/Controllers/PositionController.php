<?php

namespace App\Http\Controllers;

use App\Http\Resources\PositionCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Position;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $positions = new PositionCollection(Position::all());
            return ApiResponse::success('Listado De Puestos',201,$positions);
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
            $positions = new PositionCollection(Position::query()->where('id',$id)->get());
            if ($positions->isEmpty()) throw new ModelNotFoundException("Puesto No Encontrado");
            return ApiResponse::success( 'Puesto encontrado',200,$positions);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Puesto no encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        //
    }
}
