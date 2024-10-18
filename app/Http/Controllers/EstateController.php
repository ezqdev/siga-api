<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstateCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Estate;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $estates = new EstateCollection(Estate::all());
            return ApiResponse::success('Listado De Las Requisiciones',201,$estates);
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
            $estate = new EstateCollection(Estate::query()->where('id',$id)->get());
            if ($estate->isEmpty()) throw new ModelNotFoundException("Bien No Encontrado");
            return ApiResponse::success( 'Bien encontrado',200,$estate);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Bien No Encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estate $estate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estate $estate)
    {
        //
    }
}
