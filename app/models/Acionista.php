<?php

class Acionista extends Eloquent {
	protected $fillable = [ 'tipoPessoa',
							'cpfCnpj',
							'nome',
							'qtdAcoesQuotas'];
	public $timestamps = false;
}