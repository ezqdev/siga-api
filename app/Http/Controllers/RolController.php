<?php

namespace App\Http\Controllers;

use App\Http\Resources\RolCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Rol;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $rols = new RolCollection(Rol::all());
            return ApiResponse::success('Listado De los Roles',201,$rols);
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
    public function update(Request $request, Rol $rol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        //
    }
}
