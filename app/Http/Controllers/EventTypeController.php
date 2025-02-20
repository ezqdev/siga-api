<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstateCollection;
use App\Http\Resources\EventTypeCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Estate;
use App\Models\EventType;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $eventTypes = new EventTypeCollection(EventType::all());
            return ApiResponse::success('Listado',201,$eventTypes);
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
            $eventType = EventType::create($request->all());
            return ApiResponse::success('Creado exitosamente',201,$eventType);
        }catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $estate = new EventTypeCollection(EventType::query()->where('id',$id)->get());
            if ($estate->isEmpty()) throw new ModelNotFoundException("No Encontrado");
            return ApiResponse::success( 'Encontrado',200,$estate);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Bien No Encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $eventType = EventType::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:3|max:64',
            ]);
            $eventType->update($request->all());
            return  ApiResponse::success('Se ha actualizado',200,$eventType);
        } catch (ModelNotFoundException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }catch(ModelNotFoundException $e){
            return ApiResponse::error('No se encontró', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $eventType = EventType::findOrFail($id);
            $eventType->delete();
            return ApiResponse::success("Se ha eliminado de manera exitosa!!", 200);
        }catch (ModelNotFoundException $e) {
            return ApiResponse::error("No existe",404);
        }catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }
}
