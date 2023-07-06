<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*SE UTILIZA UN METODO ESTATICO PARA INSTANCIAR
        UNA FABRICA DE USUARIOS*/
        User::factory(10)->create();
    }
}
