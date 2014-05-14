<?php

class IdadeSaldoAtivo extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = [ 'dias',
							'individualPre',
							'individualPos',
							'coletivoPre',
							'coletivoPos',
							'taxaAdm',
							'partBenefES',
							'credOper',
							'outrosCredComPlano',
							'outrosCredSemPlano',
							'inicioPeriodo'];
}