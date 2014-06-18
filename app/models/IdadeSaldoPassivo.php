<?php

class IdadeSaldoPassivo extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = [	'dias',
							'eventos',
							'comercial',
							'debOper',
							'outrosDebOper',
							'depBenConSegRec',
							'prestServAS',
							'depAquisCarre',
							'outrosDebPagar',
							'eventossus',
							'titulosencargos',
							'trimestre'];
}