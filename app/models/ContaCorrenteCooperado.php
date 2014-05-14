<?php

class ContaCorrenteCooperado extends Eloquent {
	public $timestamps = false;
	protected $fillable = [	'tipoImposto',
							'nomeImposto',
							'dataCompetencia',
							'dataAdesaoRefis',
							'qtdeParcelas',
							'valorTotalFinanciado',
							'valorTotalPago',
							'valorSaldoTrim',
							'qtdeParcelasDevidas',
							'valorPagoTrim',
							'qtdeParcelasPagas',
							'valorAtualMone',
							'valorSaldoFinalTrim'];
}