<?php

class EstadosTableSeeder extends Seeder {

	public function run()
	{
		$array_tipos = array(
			array('uf' => 'AC','descricao' => 'ACRE'),
			array('uf' => 'AL','descricao' => 'ALAGOAS'),
			array('uf' => 'AM','descricao' => 'AMAZONAS'),
			array('uf' => 'AP','descricao' => 'AMAPÁ'),
			array('uf' => 'BA','descricao' => 'BAHIA'),
			array('uf' => 'CE','descricao' => 'CEARÁ'),
			array('uf' => 'DF','descricao' => 'DISTRITO FEDERAL'),
			array('uf' => 'ES','descricao' => 'ESPÍRITO SANTO'),
			array('uf' => 'GO','descricao' => 'GOIAS'),
			array('uf' => 'MA','descricao' => 'MARANHÃO'),
			array('uf' => 'MG','descricao' => 'MINAS GERAIS'),
			array('uf' => 'MS','descricao' => 'MATO GROSSO DO SUL'),
			array('uf' => 'MT','descricao' => 'MATO GROSSO'),
			array('uf' => 'PA','descricao' => 'PARÁ'),
			array('uf' => 'PB','descricao' => 'PARAÍBA'),
			array('uf' => 'PE','descricao' => 'PERNAMBUCO'),
			array('uf' => 'PI','descricao' => 'PIAUI'),
			array('uf' => 'PR','descricao' => 'PARANÁ'),
			array('uf' => 'RJ','descricao' => 'RIO DE JANEIRO'),
			array('uf' => 'RN','descricao' => 'RIO GRANDE DO NORTE'),
			array('uf' => 'RO','descricao' => 'RONDÔNIA'),
			array('uf' => 'RR','descricao' => 'RORAIMA'),
			array('uf' => 'RS','descricao' => 'RIO GRANDE DO SUL'),
			array('uf' => 'SC','descricao' => 'SANTA CATARINA'),
			array('uf' => 'SE','descricao' => 'SERGIPE'),
			array('uf' => 'SP','descricao' => 'SÃO PAULO'),
			array('uf' => 'TO','descricao' => 'TOCANTINS')
		);

		foreach($array_tipos as $item)
		{
			Estado::create($item);
		}
	}

}