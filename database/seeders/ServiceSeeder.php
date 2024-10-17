<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert(
            [
                'name' => 'Servicos de Difusion',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'Servicios de Wifi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'Servicio de Sonido',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

    }
}
