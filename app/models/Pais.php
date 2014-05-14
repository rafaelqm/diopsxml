<?php

class Pais extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = ['descricao'];

	protected $table = 'pais';
}