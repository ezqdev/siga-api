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
        'uploaded_job',
        'reservation_details',
        'is_maintenance'
    ];

    //? Una reserva pertenece a un usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    //? Una reserva pertenece a un espacio
    public function space(){
        return $this->belongsTo(Space::class);
    }

    public function estates()
    {
        return $this->belongsToMany(Estate::class, 'reservation_estate');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'reservation_service');
    }
}
