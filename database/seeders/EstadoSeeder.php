<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert([
            'estado' => 'En proceso',
        ]);

        DB::table('estados')->insert([
            'estado' => 'Anulado',
        ]);

        DB::table('estados')->insert([
            'estado' => 'Completado',
        ]);
    }
}
