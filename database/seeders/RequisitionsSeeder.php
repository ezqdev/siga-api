<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequisitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('requisitions')->insert(
            [
                'space_id'=> 2,
                'estate_id'=> 2,
                'service_id'=> 3,
                'Num requisitions' => 'FOIROI_1233',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('requisitions')->insert(
            [
                'space_id'=> 3,
                'estate_id'=> 3,
                'service_id'=> null,
                'Num requisitions' => 'FOIROI_1233',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        DB::table('requisitions')->insert(
            [
                'space_id'=> 4,
                'estate_id'=> null,
                'service_id'=> 2,
                'Num requisitions' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
