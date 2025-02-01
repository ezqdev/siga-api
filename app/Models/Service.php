<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name'
    ];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }

}
