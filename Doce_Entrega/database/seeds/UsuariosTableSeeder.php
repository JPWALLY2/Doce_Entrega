<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
        'nome' => 'Jacó',
        'email' => 'jaco@gmail.com',
        'senha' => '123456',
    ]);
        DB::table('usuarios')->insert([
        'nome' => 'Pedro',
        'email' => 'pedro@gmail.com',
        'senha' => '123456',
    ]);
        DB::table('usuarios')->insert([
        'nome' => 'João',
        'email' => 'joao@gmail.com',
        'senha' => '123456',
    ]);
        DB::table('usuarios')->insert([
        'nome' => 'André',
        'email' => 'andre@gmail.com',
        'senha' => '123456',
    ]);
    }
}
