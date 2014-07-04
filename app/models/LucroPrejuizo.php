<?php

class LucroPrejuizo extends Eloquent {
	public $timestamps = false;

	protected $table = 'lucrosprejuizos';
	
	protected $fillable = [	'conta',
							'valor',
							'descricao',
							'trimestre'];
}