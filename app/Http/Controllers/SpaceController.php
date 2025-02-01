<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpaceCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Space;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $spaces = new SpaceCollection(Space::all());
            return ApiResponse::success('Listado De los Espacios', 201, $spaces);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:5|max:100',
                'capacity' => 'required|min:1|max:5',
                'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,svg,bmp', 'max:10240'],
                'description' => 'required|min:5|max:100',
            ]);
            $space = new Space;
            $space->name = $request->input('name');
            $space->capacity = $request->input('capacity');
            $space->description = $request->input('description');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $filename = pathinfo($filename, PATHINFO_FILENAME);
                $name_file = str_replace(" ", "_", $filename);
                $extension = $file->getClientOriginalExtension();
                $picture = date('His') . '_' . $name_file . '.' . $extension; //?Nuevo nombre del archivo
                $file->move(public_path('uploads/image'), $picture);
                $space->image = '/uploads/image' . $picture;
            }
            $space->save();
            return ApiResponse::success("Se ha creado el espacio correctamente", 200, $space);
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 404);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $spaces = new SpaceCollection(Space::query()->where('id', $id)->get());
            if ($spaces->isEmpty()) throw new ModelNotFoundException("Espacio no encontrado");
            return ApiResponse::success('Espacio Encontrado', 200, $spaces);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Espacio no encontrado', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $space = Space::findOrFail($id);
            $request->validate([
                'name' => 'required|min:5|max:100',
                'capacity' => 'required|min:1|max:5',
                'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,svg,bmp', 'max:10240'],
                'description' => 'required|min:5|max:100',
            ]);
            $space->name = $request->input('name');
            $space->capacity = $request->input('capacity');
            $space->description = $request->input('description');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $filename = pathinfo($filename, PATHINFO_FILENAME);
                $name_file = str_replace(" ", "_", $filename);
                $extension = $file->getClientOriginalExtension();
                $picture = date('His') . '_' . $name_file . '.' . $extension; //?Nuevo nombre del archivo
                $file->move(public_path('uploads/image'), $picture);
                $space->image = '/uploads/image' . $picture;
            }
            $space->save();
            return ApiResponse::success("Se ha creado el espacio correctamente", 200, $space);
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 404);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('No se encontro el espacio', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $space = Space::findOrFail($id);
            $space->delete();
            return ApiResponse::success("Se ha eliminado el espacio de manera exitosa!!", 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("El espacio no existe", 404);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }


    public function getSpacesResume()
    {
        $now = now();
        $currentTime = $now->format('H:i:s');

        // Espacios ocupados
        $occupied = Space::whereHas('reservations', function($query) use ($now, $currentTime) {
            $query->where('start_date', '<=', $now->format('Y-m-d'))
                ->where('end_date', '>=', $now->format('Y-m-d'))
                ->where('start_time', '<=', $currentTime)
                ->where('end_time', '>=', $currentTime)
                ->where('status', 'active'); // Asumiendo que tienes un status
        })->get();

        // Espacios en mantenimiento
        $maintenance = Space::where('is_maintenance', true)->get();

        // Espacios disponibles (todos los que no están ni ocupados ni en mantenimiento)
        $available = Space::whereNotIn('id', $occupied->pluck('id'))
                        ->whereNotIn('id', $maintenance->pluck('id'))
                        ->where('is_maintenance', false)
                        ->get();

        return response()->json([
            'occupied' => $occupied,
            'maintenance' => $maintenance,
            'available' => $available
        ]);
    }
}
