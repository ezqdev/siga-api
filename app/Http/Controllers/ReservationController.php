<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Reservation;
use App\Models\ReservationEstate;
use App\Models\ReservationInput;
use App\Models\ReservationService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reservations = Reservation::with(['space', 'estates', 'services'])->get();
            return ApiResponse::success('Listado De las Reservaciones', 200, $reservations);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try { //? Validación de los datos recibidos
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'space_id' => 'required|exists:spaces,id',
                'reservation_date' => 'required|date',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'status' => 'required|string|max:20',
                'uploaded_job' => 'nullable|string',
                'reservation_details' => 'nullable|string',
                'more_stuff' => 'nullable|string'
            ]);
            $reservation = new Reservation(); //? Crear una nueva reservación
            $reservation->user_id = $request->input('user_id');
            $reservation->space_id = $request->input('space_id');
            $reservation->reservation_date = $request->input('reservation_date');
            $reservation->start_date = $request->input('start_date');
            $reservation->end_date = $request->input('end_date');
            $reservation->start_time = $request->input('start_time');
            $reservation->end_time = $request->input('end_time');
            $reservation->status = $request->input('status');
            $reservation->reservation_details = $request->input('reservation_details', null);
            $reservation->uploaded_job = $request->input('uploaded_job', null);
            $reservation->more_stuff = $request->input('more_stuff', null);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('reservations', 'public');
                $reservation->file = '/storage/' . $path;
            }
            $reservation->save(); //? Guardar la reservación en la base de datos
            return ApiResponse::success("Reservación creada correctamente.", 200, $reservation); //? Respuesta de éxito
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
        try {
            $reservation = new ReservationCollection(Reservation::query()->where('id', $id)->get());
            if ($reservation->isEmpty()) throw new ModelNotFoundException("Reservacion No Encontrado");
            return ApiResponse::success('Reservacion Encontrada', 200, $reservation);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Reservacion No Encontrada', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id); //? Encontrar la reservación o lanzar una excepción si no existe
            //? Validación de los datos recibidos
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'space_id' => 'required|exists:spaces,id',
                'reservation_date' => 'required|date',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'status' => 'required|string|max:20',
                'uploaded_job' => 'nullable|string',
                'reservation_details' => 'nullable|string',
                'more_stuff' => 'nullable|string'
            ]);
            $reservation->user_id = $request->input('user_id');
            $reservation->space_id = $request->input('space_id');
            $reservation->reservation_date = $request->input('reservation_date');
            $reservation->start_date = $request->input('start_date');
            $reservation->end_date = $request->input('end_date');
            $reservation->start_time = $request->input('start_time');
            $reservation->end_time = $request->input('end_time');
            $reservation->status = $request->input('status');
            $reservation->reservation_details = $request->input('reservation_details', null);
            $reservation->uploaded_job = $request->input('uploaded_job', null);
            $reservation->more_stuff = $request->input('more_stuff', null);
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $path = $file->store('reservations', 'public');
                $reservation->file = '/storage/' . $path;
            }
            $reservation->save(); //? Guardar la reservación en la base de datos
            return ApiResponse::success("Reservación Actualizada correctamente.", 200, $reservation); //? Respuesta de éxito
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 422); //? Manejo de errores de validación
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500); //? Manejo de cualquier otro error
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('No se encontro la Reservacion', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();
            return ApiResponse::success("Se ha eliminado la reservacion de manera exitosa!!", 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("La reservacion no existe", 404);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }


    public function assignItems(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $estates = $request->input('estates', []);
            $services = $request->input('services', []);
            $inputs = $request->input('inputs', []);

            foreach ($estates as $estateId) {
                ReservationEstate::create([
                    'reservation_id' => $reservation->id,
                    'estate_id' => $estateId
                ]);
            }

            foreach ($services as $serviceId) {
                ReservationService::create([
                    'reservation_id' => $reservation->id,
                    'service_id' => $serviceId
                ]);
            }

            foreach ($inputs as $inputId) {
                ReservationInput::create([
                    'reservation_id' => $reservation->id,
                    'input_id' => $inputId
                ]);
            }

            return ApiResponse::success('Items asignados exitosamente', 200);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error("La reservacion no existe", 404);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function byUser($userId)
    {
        try {
            $reservations = Reservation::with(['space', 'estates', 'services'])->where('user_id', $userId)->get();
            return ApiResponse::success('Reservaciones encontradas', 200, $reservations);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }


    public function bySpace($spaceId)
    {
        try {
            $reservations = Reservation::with(['space', 'estates', 'services'])->where('space_id', $spaceId)->get();
            return ApiResponse::success('Reservaciones encontradas', 200, $reservations);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }


    public function changeStatus(Request $request, $reservationId)
    {
        try {
            $status = $request->input('status');
            $reservation = Reservation::findOrFail($reservationId);
            if($status){
                $reservation->update([
                    'status' => 'aprobado'
                ]);
            }else{
                $reservation->update([
                    'status' => 'rechazado'
                ]);
            }
            return ApiResponse::success('Estado actualizado exitosamente', 200, $reservation);
        } catch (ValidationException $e) {
            return ApiResponse::error($e->getMessage(), 422); //? Manejo de errores de validación
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500); //? Manejo de cualquier otro error
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('No se encontro la Reservacion', 400);
        }
    }
}
