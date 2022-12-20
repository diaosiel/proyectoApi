<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            [
                'nombre'=>'cama',
                'descripcion'=>'personal',
                 'precio'=>'4500',
                 'cantidad'=>'10',
            ],

            [
                'nombre'=>'piano',
                'descripcion'=>'de madera',
                 'precio'=>'14500',
                 'cantidad'=>'20',
            ],

            [
                'nombre'=>'carro',
                'descripcion'=>'audi',
                 'precio'=>'77500',
                 'cantidad'=>'11',
            ],
            [
                'nombre'=>'teclado',
                'descripcion'=>'de goma ',
                 'precio'=>'6500',
                 'cantidad'=>'15',
            ]

            ]);
    }
}
