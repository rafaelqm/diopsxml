<?php

class Endereco extends Eloquent {
	public $timestamps = false;
	protected $fillable = [	'tipoEndereco',
							'logradouro',
							'numLogradouro',
							'complemento',
							'bairro',
							'municipioIBGE',
							'siglaUF',
							'cep'];

	public function municipio(){
		return $this->belongsTo('Municipio','municipioIBGE','municipioIBGE');
	}
}