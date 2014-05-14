<?php

class Lancamento extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = [	'tipo',
							'conta',
							'contaTasy',
							'descricao',
							'saldoAnterior',
							'debito',
							'credito',
							'saldoFinal',
							'inicioPeriodo'];
}