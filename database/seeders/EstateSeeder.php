<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estates')->insert(
            [
                'name' => 'BOCINAS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('estates')->insert(
            [
                'name' => 'LAPTOP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('estates')->insert(
            [
                'name' => 'PROYECTOR',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('estates')->insert(
            [
                'name' => 'ATRIL DE MADERA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('estates')->insert(
            [
                'name' => 'CAFETERA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('estates')->insert(
            [
                'name' => 'ENFRIADORES',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('estates')->insert(
            [
                'name' => 'HIELERAS GRANDES',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('estates')->insert(
            [
                'name' => 'EXTENCIONES',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
