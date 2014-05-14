<?php

class Representante extends Eloquent {
	
	public $timestamps = false;

	protected $fillable = [	'CPF',
							'RG',
							'nome',
							'email',
							'tipoRepresentante',
							'dataExpedicao',
							'orgaoExpeditor',
							'pais',
							'cargo',
							'endereco'];

	public function telefones(){
		return Telefone::where('tabela','=','representantes')->where('tabela_id','=',$this->id)->get();
	}

	public function endereco_atual(){
		return $this->belongsTo('Endereco','endereco');
	}

	public function pais(){
		return $this->belongsTo('Pais','pais');
	}

	public function cargo_atual(){
		return $this->belongsTo('Cargo','cargo');
	}
}