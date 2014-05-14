<?php

class Telefone extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = [	'tabela', // operadoras, representantes, dependentes
							'tabela_id',
							'codigoDDI',
							'codigoDDD',
							'numeroTel',
							'ramal'];
	public function operadora(){
		if($this->tabela == 'operadoras'){
			return $this->belongsTo('Operadora','tabela_id');
		}else{
			return null;
		}
	}

	public function representante(){
		if($this->tabela == 'representantes'){
			return $this->belongsTo('Representante','tabela_id');
		}else{
			return null;
		}
	}

	public function dependente(){
		if($this->tabela == 'dependentes'){
			return $this->belongsTo('Dependente','tabela_id');
		}else{
			return null;
		}
	}
}