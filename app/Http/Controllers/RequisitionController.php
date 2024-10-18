<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequisitionCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Requisition;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $requisitions = new RequisitionCollection(Requisition::all());
            return ApiResponse::success('Listado De Las Requisiciones',201,$requisitions);
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
        try{
            $requisitions = new RequisitionCollection(Requisition::query()->where('id',$id)->get());
            if($requisitions->isEmpty()) throw new ModelNotFoundException("Requisicion No Encontrado");
            return ApiResponse::success( 'Requisicion Encontrado',200,$requisitions);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Requisicion no encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requisition $requisition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
