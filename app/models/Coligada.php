<?php

class Coligada extends Eloquent {
	public $timestamps = false;
	protected $fillable = [	'CNPJ',
							'tipoVinculo',
							'classificacaoEmpresa',
							'razaoSocial',
							'qtdeAcoesQuotas',
							'totalAcoesQuotas'];
}