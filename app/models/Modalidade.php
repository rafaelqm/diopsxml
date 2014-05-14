<?php

class Modalidade extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = ['codigo','descricao'];
}