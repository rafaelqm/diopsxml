<?php

class InformacoesSolvencia extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = [	'conta',
							'valor',
							'descricao',
							'inicioPeriodo'];
}