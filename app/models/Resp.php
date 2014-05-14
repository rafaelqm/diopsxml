<?php

class Resp extends Eloquent {

	public $timestamps = false;
	
	protected $fillable = [	'tipoPessoa',
							'nome',
							'cpfCnpj',
							'tipo',
							'numRegistro'];
}