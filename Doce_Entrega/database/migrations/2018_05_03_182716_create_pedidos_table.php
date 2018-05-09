<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantidade');
            $table->decimal('preco_total', 10, 2);
            $table->integer('produtos_id')->references('id')->on('produtos');
            $table->integer('clientes_id')->references('id')->on('clientes');
            $table->integer('enderecos_id')->references('id')->on('enderecos');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
