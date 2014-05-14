<?php

class FluxoCaixa extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = [	'descricao',
							'conta',
							'valor',
							'inicioPeriodo'];
}