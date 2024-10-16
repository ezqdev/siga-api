<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'space_id',
        'reservation_date',
        'star_date',
        'end_date',
        'start_time',
        'end_time',
        'status',
        'reservation_details'
    ];

    //? Una reserva pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    //? Una reserva pertenece a un espacio
    public function space(){
        return $this->belongsTo(Space::class);
    }
}
