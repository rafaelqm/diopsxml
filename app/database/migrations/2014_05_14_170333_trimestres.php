<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Trimestres extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trimestres', function($table)
		{
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('trimestre')->nullable();
		});


		Schema::table('lancamentos', function ($table){
			$table->integer('trimestre')->nullable();

		});

		Schema::table('fluxoCaixas', function ($table){
			$table->integer('trimestre')->nullable();
		});

		Schema::table('idadeSaldoPassivos', function ($table){
			$table->integer('trimestre')->nullable();
		});

		Schema::table('idadeSaldoAtivos', function ($table){
			$table->integer('trimestre')->nullable();
		});

		Schema::table('lucrosPrejuizos', function ($table){
			$table->integer('trimestre')->nullable();
		});

		Schema::table('informacoesSolvencias', function ($table){
			$table->integer('trimestre')->nullable();
		});

		Schema::table('segProvEventosSinistrosLiq', function ($table){
			$table->integer('trimestre')->nullable();
		});

		Schema::table('coberturaAssistencial', function ($table){
			$table->integer('trimestre')->nullable();
		});

		Schema::table('intercambioEventual', function ($table){
			$table->integer('trimestre')->nullable();
		});

		Schema::table('contaCorrenteCooperado', function ($table){
			$table->integer('trimestre')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("trimestres");


		Schema::table('lancamentos', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('fluxoCaixas', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('idadeSaldoPassivos', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('idadeSaldoAtivos', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('lucrosPrejuizos', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('informacoesSolvencias', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('segProvEventosSinistrosLiq', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('coberturaAssistencial', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('intercambioEventual', function ($table){
			$table->dropColumn('trimestre');
		});

		Schema::table('contaCorrenteCooperado', function ($table){
			$table->dropColumn('trimestre');
		});
	}

}
