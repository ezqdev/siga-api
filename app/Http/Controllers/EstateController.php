<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstateCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Estate;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $estates = new EstateCollection(Estate::all());
            return ApiResponse::success('Listado De Los Bienes',201,$estates);
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
            $estate = Estate::create($request->all());
            return ApiResponse::success('Bien creado exitosamente',201,$estate);
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
    public function update(Request $request, $id)
    {
        try {
            $estate = Estate::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:3|max:64',
            ]);
            $estate->update($request->all());
            return  ApiResponse::success('Se ha actualizado el bien',200,$estate);
        } catch (ModelNotFoundException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }catch(ModelNotFoundException $e){
            return ApiResponse::error('No se encontro el bien', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $estate = Estate::findOrFail($id);
            $estate->delete();
            return ApiResponse::success("Se ha eliminado el Bien de manera exitosa!!", 200);
        }catch (ModelNotFoundException $e) {
            return ApiResponse::error("La reservacion no existe",404);
        }catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }
}
