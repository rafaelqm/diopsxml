<?php

class Dependente extends Eloquent {
	public $timestamps = false;
	protected $fillable = [	'CNPJ',
							'tipo',
							'razaoSocial',
							'email',
							'endereco'];

	public function telefones(){
		return Telefone::where('tabela','=','dependentes')->where('tabela_id','=',$this->id)->get();
	}

	public function endereco_atual(){
		return $this->belongsTo('Endereco','endereco');
	}

}