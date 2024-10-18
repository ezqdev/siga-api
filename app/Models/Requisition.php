<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    protected $fillable = [
        'space_id',
        'estate_id',
        'service_id',
        'Num_requisitions'
    ];

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, );
    }
}
