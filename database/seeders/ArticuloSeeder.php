<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articulos')->insert([
            'nombre' => 'Cornetas Bluetooth',
            'precio' => 20,
        ]);

        DB::table('articulos')->insert([
            'nombre' => 'Forro alcatel 1',
            'precio' => 5,
        ]);

        DB::table('articulos')->insert([
            'nombre' => 'Vidrio templado',
            'precio' => 7,
        ]);

        DB::table('articulos')->insert([
            'nombre' => 'Sony Xperia XZS',
            'precio' => 250,
        ]);

        DB::table('articulos')->insert([
            'nombre' => 'Audifonos Astro A10',
            'precio' => 50,
        ]);
    }
}
