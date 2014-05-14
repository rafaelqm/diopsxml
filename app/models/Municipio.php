<?php

class Municipio extends Eloquent {
	public $timestamps = false;
	protected $fillable = ['municipioIBGE','uf','descricao'];
}