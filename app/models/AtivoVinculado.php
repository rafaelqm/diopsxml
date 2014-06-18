<?php

class AtivoVinculado extends Eloquent {
	
	public $timestamps = false;

	protected $table = 'ativo_vinculado';

	protected $fillable = [	'trimestre',
							'rgi',
							'tipo_bem_imobiliario',
							'nome_cartorio',
							'area_imovel',
							'data_aquisicao',
							'data_venda',
							'data_avaliacao',
							'rede_propria',
							'preco_unitario',
							'valor_contabil',
							'endereco'];

	
	public function enderecoAtual(){
		return $this->belongsTo('Endereco','endereco');
	}

}