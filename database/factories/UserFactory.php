<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class UserFactory extends Factory
{
    /*SE DEFINE LA CLASE DEL MODELO CORRESPONDIENTE
    A LA FABRICA*/
    protected $model = User::class;

    /*SE DEFINE UNA ESTRUCTURA CON VALORES ALEATORIOS
    PARA CADA REGISTRO*/
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->email(),
            'password' => $this->faker->password(),
            'created_at'=> $this->faker->date()
        ];
    }
}
