<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservationService extends Model
{
    protected $table = 'reservation_service';

    protected $fillable = [
        'reservation_id',
        'service_id',
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
