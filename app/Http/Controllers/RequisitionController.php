<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequisitionCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Requisition;
use App\Models\Service;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $requisition = new RequisitionCollection(Requisition::all());
            return ApiResponse::success('Listado De Las Requisiciones',201,$requisition);
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
                'space_id' => 'required',
                'estate_id' => 'required',
                'service_id' => 'required',
                'Num_requisitions' => 'required|min:5|max:50',
            ]);
            $requisition = new Requisition();
            $requisition->space_id = $request->input('space_id');
            $requisition->estate_id = $request->input('estate_id');
            $requisition->service_id = $request->input('service_id');
            $requisition->Num_requisitions = $request->input('Num_requisitions');
            $requisition->save();
            return ApiResponse::success("Requisicion creada correctamente.", 200, $requisition);//? Respuesta de éxito
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 422); //? Manejo de errores de validación
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500); //? Manejo de cualquier otro error
        }
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
    public function update(Request $request, $id)
    {
        try{
            $requisition = Requisition::findOrFail($id);
            $request -> validate([
                'space_id' => 'required',
                'estate_id' => 'required',
                'service_id' => 'required',
                'Num_requisitions' => 'required|min:5|max:50',
            ]);
            $requisition->space_id = $request->input('space_id');
            $requisition->estate_id = $request->input('estate_id');
            $requisition->service_id = $request->input('service_id');
            $requisition->Num_requisitions = $request->input('Num_requisitions');
            $requisition->update($request->all());
            return ApiResponse::success("Requisicion creada correctamente.", 200, $requisition);//? Respuesta de éxito
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 422); //? Manejo de errores de validación
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500); //? Manejo de cualquier otro error
        }catch(ModelNotFoundException $e){
            return ApiResponse::error('No se encontro la Requisicion', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $requisition = Requisition::findOrFail($id);
            $requisition -> delete();
            return ApiResponse::success("La requisicion eliminada de manera correcta!!",200,$requisition);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("No se puede encontrar la requisicion a eliminar");
        }
    }
}
