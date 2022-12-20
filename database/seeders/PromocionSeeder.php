<?php

namespace Database\Seeders;
use App\Models\Promocion;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
      Promocion::factory(10)->create();
    }
}
