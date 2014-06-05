<?php
class DataFormat{

	public static function makeBR($data){
		return self::retorna($data,'-','/');
	}

	public static function makeUS($data){
		return self::retorna($data,'/','-');
	}

	public static function retorna($data,$explode,$glue){
		return  implode($glue,array_reverse(explode($explode,$data)));
	}

	public static function moneyBR($val){
		return number_format($val,2,',','.');
	}

	public static function moneyBD($val){
		$val = str_replace('.', '', $val);
		$val = str_replace(',', '.', $val);
		return $val;
	}

	public static function moneyUS($val){
		return number_format($val,2,'.',',');
	}

}