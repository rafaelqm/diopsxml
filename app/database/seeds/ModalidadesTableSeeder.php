<?php

class ModalidadesTableSeeder extends Seeder {

	public function run()
	{
		$array_tipos = array(
			array('codigo'=>'ADMIN', 'descricao' => 'Administradora'),
			array('codigo'=>'AUTOG', 'descricao' => 'Autogestão'),
			array('codigo'=>'COOPM', 'descricao' => 'Cooperativa médica'),
			array('codigo'=>'COOPO', 'descricao' => 'Cooperativa Odontológica'),
			array('codigo'=>'FILAN', 'descricao' => 'Filantropia'),
			array('codigo'=>'MEGRP', 'descricao' => 'Medicina de Grupo'),
			array('codigo'=>'ODGRP', 'descricao' => 'Odontologia de Grupo'),
			array('codigo'=>'SEGUR', 'descricao' => 'Seguradora'),
			array('codigo'=>'SGSAU', 'descricao' => 'Seguradora Especializada em Saúde'),
		);

		foreach($array_tipos as $modalidade)
		{
			Modalidade::create($modalidade);
		}
	}

}