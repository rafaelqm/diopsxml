<?php

class LucroPrejuizo extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = [	'conta',
							'valor',
							'descricao',
							'inicioPeriodo'];
}