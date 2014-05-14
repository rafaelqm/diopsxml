<?php

class ANSoperadora extends Eloquent {
	
	protected $table = 'ANSoperadoras';
	public $timestamps = false;
	protected $fillable = [	'operadora',
							'registroOperadora',
							'nome',
							'nomeFantasia',
							'CNPJ'];
}