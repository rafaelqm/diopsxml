<?php

class Estado extends Eloquent {
	public $timestamps = false;
	protected $fillable = ['uf','descricao'];
}