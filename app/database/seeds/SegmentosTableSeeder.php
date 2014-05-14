<?php

class SegmentosTableSeeder extends Seeder {

	public function run()
	{
		$array_tipos = array(
			array('codigo'=>'SPP', 'descricao' => 'Segmento Primário Principal'),
			array('codigo'=>'SPSUS', 'descricao' => 'Segmento Primário principal / SPP/SUS'),
			array('codigo'=>'SPS', 'descricao' => 'Segmento Primário Subsidiário - SPS'),
			array('codigo'=>'SSP', 'descricao' => 'Segmento Secundário Principal'),
			array('codigo'=>'SSS', 'descricao' => 'Segmento Secundário Subsidiário'),
			array('codigo'=>'ST', 'descricao' => 'Segmento Terciário'),
			
		);

		foreach($array_tipos as $item)
		{
			Segmento::create($item);
		}
	}

}