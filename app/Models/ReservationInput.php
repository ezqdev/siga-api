<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationInput extends Model
{
    protected $table = 'reservation_input';

    protected $fillable = [
        'reservation_id',
        'input_id',
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function input(){
        return $this->belongsTo(Input::class);
    }
}
