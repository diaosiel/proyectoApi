<?php

namespace Database\Factories;
use App\Models\Promocion;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromocionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Promocion::class;
    public function definition()
    {
        return [
            'nombre'=> $this->faker->sentence(),
            'descripcion'=> $this->faker->paragraph(),
            'precioDolar'=>$this->faker->numberBetween(150,175),
            'foto'=>$this->faker->sentence()
        ];
    }
}
