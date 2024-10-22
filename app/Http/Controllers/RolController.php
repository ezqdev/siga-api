<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Http\Responses\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\RolCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $roles = new RolCollection(Rol::all());
            return ApiResponse::success('Listado de roles con usuarios',201, $roles);
        } catch (Exception $e){
            return ApiResponse::error('Error al obtener los roles',500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request -> validate([
                'name' => 'required|min:3|max:45',
            ]);
            $rol = Rol::create($request->all());
            return ApiResponse::success("Se ha creado el rol correctamente", 200, $rol);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $rol = new RolCollection(Rol::query()->where('id',$id)->get()); //select * from rols where id = $id;
            if ($rol->isEmpty()) throw new ModelNotFoundException("Rol no encontrado");
            return ApiResponse::success( 'Información del rol',200,$rol);
        }catch(ModelNotFoundException $e) {
            return ApiResponse::error( 'No existe el rol solicitado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $rol = Rol::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:3|max:64',
            ]);
            $rol->update($request->all());
            return  ApiResponse::success('Se ha actualizado el rol',200,$rol);
        } catch (ModelNotFoundException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $rol=Rol::findOrFail($id);
            $rol->delete();
            return ApiResponse::success("Rol eliminado de manera correcta!!",200,$rol);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("No se puede encontrar al Rol a eliminar");
        }
    }
}