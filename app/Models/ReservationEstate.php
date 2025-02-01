<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationEstate extends Model
{
    protected $table = 'reservation_estate';

    protected $fillable = [
        'reservation_id',
        'estate_id',
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function space(){
        return $this->belongsTo(Estate::class);
    }
}
