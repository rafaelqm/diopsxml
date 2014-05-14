<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MunicipiosEstados extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('municipios', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('municipioIBGE');
            $table->string('uf',2);
            $table->string('descricao');
		});

		Schema::create('estados', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('uf',2);
            $table->string('descricao');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::dropIfExists('municipios');
		Schema::dropIfExists('estados');
	}

}
