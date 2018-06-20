<?php

use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            'tipo' => 'Doce',
            'nome' => 'Brigadeiro',
            'descricao' => 'Feito a base de chocolate',
            'preco' => 375,
            'user_id' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')            
        ]);
        DB::table('produtos')->insert([
            'tipo' => 'Torta',
            'nome' => 'Morango',
            'descricao' => 'Feito a base de morango',
            'preco' => 500,
            'user_id' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')            
        ]);
        DB::table('produtos')->insert([
            'tipo' => 'Doce',
            'nome' => 'Qindim',
            'descricao' => 'Feito a base de ovo',
            'preco' => 375,
            'user_id' => 1,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s')            
        ]);
    }
}
