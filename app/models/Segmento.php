<?php

class Segmento extends Eloquent {
	public $timestamps = false;
	
	protected $fillable = ['codigo','descricao'];
}