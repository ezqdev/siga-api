<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Service;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $services = new ServiceCollection(Service::all());
            return ApiResponse::success('Listado De los Espacios',201,$services);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        try{
            $services = new ServiceCollection(Service::query()->where('id',$id)->get());
            if($services->isEmpty()) throw new ModelNotFoundException("Servicio No Encontrado");
            return ApiResponse::success( 'Servicio Encontrado',200,$services);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Servicio no encontrado',404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
