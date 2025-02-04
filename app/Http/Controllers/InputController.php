<?php

namespace App\Http\Controllers;

use App\Http\Resources\InputCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Input;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $input = new InputCollection(Input::all());
            return ApiResponse::success('Listado De los Insumos',201,$input);
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
            $input = Input::create($request->all());
            return ApiResponse::success('Insumo Creado Exitosamente!!',201,$input);
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
            $input = new InputCollection(Input::query()->where('id',$id)->get());
            if($input->isEmpty()) throw new ModelNotFoundException("Servicio No Encontrado");
            return ApiResponse::success( 'Insumo Encontrado',200,$input);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Insumo no encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $input = Input::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:3|max:64',
            ]);
            $input->update($request->all());
            return  ApiResponse::success('Se ha actualizado el insumo!!',200,$input);
        } catch (ModelNotFoundException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }catch(ModelNotFoundException $e){
            return ApiResponse::error('No se encontro el insumo', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $input = Input::findOrFail($id);
            $input->delete();
            return ApiResponse::success("Se ha eliminado el Insumo de manera exitosa!!", 200);
        }catch (ModelNotFoundException $e) {
            return ApiResponse::error("El insumo no existe",404);
        }catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }
}
