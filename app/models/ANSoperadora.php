<?php

class ANSoperadora extends Eloquent {
	public $timestamps = false;
	protected $fillable = [	'operadora',
							'registroOperadora',
							'nome',
							'nomeFantasia',
							'CNPJ'];
}