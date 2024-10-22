<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Service;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $service = new ServiceCollection(Service::all());
            return ApiResponse::success('Listado De los Servicios',201,$service);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request -> validate([
                'name' => 'required|min:3|max:50',
            ]);
            $service = Service::create($request->all());
            return ApiResponse::success('Servicio Creado Exitosamente!!',201,$service);
        }catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $service = new ServiceCollection(Service::query()->where('id',$id)->get());
            if($service->isEmpty()) throw new ModelNotFoundException("Servicio No Encontrado");
            return ApiResponse::success( 'Servicio Encontrado',200,$service);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Servicio no encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $service = Service::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:3|max:64',
            ]);
            $service->update($request->all());
            return  ApiResponse::success('Se ha actualizado el servicio!!',200,$service);
        } catch (ModelNotFoundException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }catch(ModelNotFoundException $e){
            return ApiResponse::error('No se encontro el servicio', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $service = Service::findOrFail($id);
            $service->delete();
            return ApiResponse::success("Se ha eliminado el Servicio de manera exitosa!!", 200);
        }catch (ModelNotFoundException $e) {
            return ApiResponse::error("El servico no existe",404);
        }catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }
}
