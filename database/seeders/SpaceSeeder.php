<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spaces')->insert(
            [
                'name' => 'Sala de usos multiples',
                'capacity' => 40,
                'image' => 'https://imgv2-1-f.scribdassets.com/img/document/466299956/original/d0bad0363e/1?v=1',
                'description' => 'Edificio Administrativo',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table("spaces")->insert(
            [
                'name' => 'Cancha Domo',
                'capacity' => 60,
                'image' => 'https://imgv2-1-f.scribdassets.com/img/document/466299956/original/d0bad0363e/1?v=1',
                'description' => 'Patio Principal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table("spaces")->insert(
            [
                'name' => 'Paraninfo',
                'capacity' => 50,
                'image' => 'https://imgv2-1-f.scribdassets.com/img/document/466299956/original/d0bad0363e/1?v=1',
                'description' => 'Pendiente',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        DB::table("spaces")->insert(
                [
                'name' => 'Auditorio',
                'capacity' => 200,
                'image' => 'https://imgv2-1-f.scribdassets.com/img/document/466299956/original/d0bad0363e/1?v=1',
                'description' => 'Gimnasio Auditorio',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
