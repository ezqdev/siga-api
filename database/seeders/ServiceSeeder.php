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
                'name' => 'SILLAS ACOJINADAS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'TABLONES',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'MANTELES',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'FORROS PARA SILLAS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'MOÑOS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'TEMPLETE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'ATRIL PERSONALIZADO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'PANTALLA LED',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('services')->insert(
            [
                'name' => 'LUZ Y SONIDO',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

    }
}
