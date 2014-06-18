<?php

class FluxoCaixa extends Eloquent {
	public $timestamps = false;

	protected $table = "fluxoCaixas";
	
	protected $fillable = [	'descricao',
							'conta',
							'valor',
							'mes_num',
							'trimestre',
							'sequencia'];
}