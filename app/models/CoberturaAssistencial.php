<?php

class CoberturaAssistencial extends Eloquent {
	public $timestamps = false;
	protected $table = 'coberturaAssistencial';

	protected $fillable = [	'tipo',
							'plano',
							'valorConsultaRP',
							'valorConsultaRC',
							'valorConsultaRE',
							'valorConsultaIE',
							'valorExameRP',
							'valorExameRC',
							'valorExameRE',
							'valorExameIE',
							'valorTerapiaRP',
							'valorTerapiaRC',
							'valorTerapiaRE',
							'valorTerapiaIE',
							'valorInternRP',
							'valorInternRC',
							'valorInternRE',
							'valorInternIE',
							'valorAtendimentoRP',
							'valorAtendimentoRC',
							'valorAtendimentoRE',
							'valorAtendimentoIE',
							'valorDespesasRP',
							'valorDespesasRC',
							'valorDespesasRE',
							'valorDespesasIE',
							'valorOdontologicoRP',
							'valorOdontologicoRC',
							'valorOdontologicoRE',
							'valorOdontologicoIE',
							'inicioPeriodo'];
}