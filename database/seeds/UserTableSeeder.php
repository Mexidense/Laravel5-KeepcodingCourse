<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 2)->create();
        factory(\App\User::class, 1)->create([
            'name' => 'Salvador Briones',
            'email'=> 's.briones.ro@gmail.com',
            'password' => '$2y$10$atHaQKNjHLJQc8N31kz4KecTkiv9rk3aJLjxthRJD9T2LvUQHSRCq',
        ]);
    }
}
