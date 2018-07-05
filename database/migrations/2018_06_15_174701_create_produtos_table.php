<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('descricao');
            $table->smallInteger('estoque')->nullable();
            $table->smallInteger('estoquemin')->nullable();
            $table->decimal('preco', 10, 2);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('tipo_id')->unsigned();
            $table->string('foto', 60)->nullable();
            $table->smallInteger('us')->default();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
