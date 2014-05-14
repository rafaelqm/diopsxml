<?php

class Natureza_juridicasTableSeeder extends Seeder {

	public function run()
	{
		

		$array_tipos = array(
			array('codigo'=>'ASSOC', 'descricao'=>'Associação'),
			array('codigo'=>'DEPEX', 'descricao'=>'Dependência de Empresa Sediada no Exterior'),
			array('codigo'=>'EMIND', 'descricao'=>'Empresa Individual'),
			array('codigo'=>'EMPUB', 'descricao'=>'Empresa Pública'),
			array('codigo'=>'FUNDA', 'descricao'=>'Fundação'),
			array('codigo'=>'OUTRC', 'descricao'=>'Outras com Fins'),
			array('codigo'=>'OUTRS', 'descricao'=>'Outras sem Fins'),
			array('codigo'=>'SOCIA', 'descricao'=>'Sociedade Anônima'),
			array('codigo'=>'SCIVL', 'descricao'=>'Sociedade Civil com Fins lucrativos'),
			array('codigo'=>'SCIVS', 'descricao'=>'Sociedade Civil sem Fins lucrativos'),
			array('codigo'=>'SCOOP', 'descricao'=>'Sociedade Cooperativa'),
			array('codigo'=>'SCOTA', 'descricao'=>'Sociedade com Cotas de Responsabilidade LTDA'),
		);

		foreach($array_tipos as $Natureza_juridica)
		{
			NaturezaJuridica::create($Natureza_juridica);
		}
	}

}