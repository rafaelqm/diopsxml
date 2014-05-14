<?php

class Admin extends Eloquent {
	public $timestamps = false;
	protected $fillable = [	'CPF',
							'estrangeiro',
							'nome',
							'nomeMae',
							'cargoFuncao',
							'dataIniMandato',
							'dataFimMandato',
							'resposavelTecnico',
							'tipo',
							'crm'];

	public function cargo(){
		return $this->belongsTo('Cargo','cargoFuncao');
	}
}