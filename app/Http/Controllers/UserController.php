<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Resources\UserCollection;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $users = new UserCollection(User::all());
            return ApiResponse::success('Listado de usuarios',201,$users);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        try{
            //$validatedData = $request->validated();
            $user = User::create($request->validated());
            return ApiResponse::success("Usuario creado correctamente", 200, $user);
        } catch (ValidationException $e){
            return ApiResponse::error("error",404);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = new UserCollection(User::query()->where('id',$id)->get());
            if ($user->isEmpty()) throw new ModelNotFoundException("Usuario no encontrado");
            return ApiResponse::success( 'Usuario encontrado',200,$user);
        } catch (ModelNotFoundException $e) {
            return ApiResponse::error('Usuario no encontrado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
