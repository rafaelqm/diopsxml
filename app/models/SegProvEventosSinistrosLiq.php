<?php

class SegProvEventosSinistrosLiq extends Eloquent {
	
	public $timestamps = false;

	protected $table = 'segProvEventosSinistrosLiq';
	
	protected $fillable = [	'EventoSinistrosAte',
							'EventoSinistrosPos',
							'inicioPeriodo'];
}