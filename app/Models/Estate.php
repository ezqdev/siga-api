<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable = [
        'name'
    ];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
}
