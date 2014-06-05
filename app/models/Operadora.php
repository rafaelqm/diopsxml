<?php

class Operadora extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = [	'registroANS',
							'razaoSocial',
							'nomeFantasia',
							'CNPJ',
							'eMail',
							'naturezaJuridica',
							'segmentacao',
							'modalidade',
							'municipioIBGE',
							'endereco_matriz',
							'endereco_corresp',
							'totalmentePulverizado',
							'totalAcoesQuotas'];

	public function enderecoMatriz(){
		return $this->belongsTo('Endereco','endereco_matriz');
	}

	public function enderecoCorresp(){
		return $this->belongsTo('Endereco','endereco_corresp');
	}

	public function telefones(){
		return $this->hasMany('Telefone','tabela_id');
		// return Telefone::where('tabela','=','operadoras')->where('tabela_id','=',$this->id)->get();
	}
}