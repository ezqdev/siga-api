<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('inputs')->insert(
            [
                'name' => 'CAFÉ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('inputs')->insert(
            [
                'name' => 'AZUCAR',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('inputs')->insert(
            [
                'name' => 'GALLETA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('inputs')->insert(
            [
                'name' => 'CUCHARAS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('inputs')->insert(
            [
                'name' => 'TE',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('inputs')->insert(
            [
                'name' => 'AGUA EMBOTELLADA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('inputs')->insert(
            [
                'name' => 'REFRESCOS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('inputs')->insert(
            [
                'name' => 'SERVILLETAS',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

    }
}
