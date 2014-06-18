<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFluxocaixas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fluxoCaixas', function($table){	
			$table->dropColumn('inicioPeriodo');
					
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fluxoCaixas', function($table){
			$table->date('inicioPeriodo');
		});
	}

}
