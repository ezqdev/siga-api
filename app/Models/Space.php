<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $fillable = [
        'name',
        'capacity',
        'image',
        'description',
    ];

     //? Un espacio puede tener muchas reservas
    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function scopeGetSpaceStatus($query)
    {
        $now = now();
        $currentTime = $now->format('H:i:s');

        // Espacios ocupados
        $occupied = Space::whereHas('reservations', function($query) use ($now, $currentTime) {
            $query->where('start_date', '<=', $now->format('Y-m-d'))
                ->where('end_date', '>=', $now->format('Y-m-d'))
                ->where('start_time', '<=', $currentTime)
                ->where('end_time', '>=', $currentTime)
                ->where('status', 'active'); // Asumiendo que tienes un status
        })->get();

        // Espacios en mantenimiento
        $maintenance = Space::where('is_maintenance', true)->get();

        // Espacios disponibles (todos los que no están ni ocupados ni en mantenimiento)
        $available = Space::whereNotIn('id', $occupied->pluck('id'))
                        ->whereNotIn('id', $maintenance->pluck('id'))
                        ->where('is_maintenance', false)
                        ->get();

        return [
            'occupied' => $occupied,
            'maintenance' => $maintenance,
            'available' => $available
        ];
    }
}
