<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*SE LLAMA AL SEMBRADOR DE USUARIOS DESPUES DE
        EJECUTAR EL COMANDO MIGRATE --SEED*/
        $this->call(UserSeeder::class);
    }
}
