<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAtivoVinculado extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ativo_vinculado', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('trimestre');
            $table->integer('rgi');
            $table->integer('tipo_bem_imobiliario');
            $table->string('nome_cartorio');
            $table->decimal('area_imovel',19,2);
            $table->date('data_aquisicao',19,2);
            $table->date('data_venda',19,2);
            $table->date('data_avaliacao',19,2);
            $table->string('rede_propria',3);
            $table->decimal('preco_unitario',19,2);
            $table->decimal('valor_contabil',19,2);
            $table->integer('endereco')->unsigned();

            $table->foreign('endereco')->references('id')->on('enderecos');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ativo_vinculado');
	}

}
