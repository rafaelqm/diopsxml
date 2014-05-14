<?php

class CargosTableSeeder extends Seeder {

	public function run()
	{
		$array_tipos = array(
			array('descricao' => 'PRESIDENTE'),
			array('descricao' => 'VICE-PRESIDENTE'),
			array('descricao' => 'TESOUREIRO'),
			array('descricao' => 'ACIONISTA'),
			array('descricao' => 'ADMINISTRADOR'),
			array('descricao' => 'ADVOGADO'),
			array('descricao' => 'ANALISTA CONSULTOR'),
			array('descricao' => 'ANALISTA DE RECURSOS HUMANOS'),
			array('descricao' => 'ANALISTA DE SISTEMAS'),
			array('descricao' => 'ASSESSOR'),
			array('descricao' => 'ASSESSOR TÉCNICO'),
			array('descricao' => 'ASSISTENTE DE RECURSOS HUMANOS'),
			array('descricao' => 'ASSISTENTE DE SAÚDE OCUPACIONAL'),
			array('descricao' => 'ASSISTENTE SOCIAL'),
			array('descricao' => 'AUXILIAR DE ADMINISTRAÇÃO'),
			array('descricao' => 'CHEFE DE RECURSOS HUMANOS'),
			array('descricao' => 'CHEFE DE DEPARTAMENTO MÉDICO'),
			array('descricao' => 'CHEFE DE DEPARTAMENTO PESSOAL'),
			array('descricao' => 'CIRURGIÃO-DENTISTA'),
			array('descricao' => 'CONSELHEIRO'),
			array('descricao' => 'CONSELHEIRO FISCAL'),
			array('descricao' => 'CONTADOR'),
			array('descricao' => 'COORDENADOR'),
			array('descricao' => 'COORDENADOR ADMINISTRATIVO'),
			array('descricao' => 'COORDENADOR DE BENEFÍCIOS'),
			array('descricao' => 'COORDENADOR DE RECURSOS HUMANOS'),
			array('descricao' => 'COORDENADOR GERAL'),
			array('descricao' => 'COORDENADOR MÉDICO'),
			array('descricao' => 'COORDENADOR TÉCNICO'),
			array('descricao' => 'DELEGADO'),
			array('descricao' => 'DENTISTA'),
			array('descricao' => 'DIRETOR ADMINISTRATIVO'),
			array('descricao' => 'DIRETOR ADMINISTRATIVO-COMERCIAL'),
			array('descricao' => 'DIRETOR ADMINISTRATIVO-FINANCEIRO'),
			array('descricao' => 'DIRETOR CLÍNICO'),
			array('descricao' => 'DIRETOR COMERCIAL'),
			array('descricao' => 'DIRETOR DE ASSISTÊNCIA'),
			array('descricao' => 'DIRETOR DE ASSISTÊNCIA E SAÚDE'),
			array('descricao' => 'DIRETOR DE CONTROLADORIA'),
			array('descricao' => 'DIRETOR DE MERCADO'),
			array('descricao' => 'DIRETOR DE PATRIMÔNIO'),
			array('descricao' => 'DIRETOR DE RECURSOS HUMANOS'),
			array('descricao' => 'DIRETOR DE SAÚDE´E ATENDIMENTO'),
			array('descricao' => 'DIRETOR DE SEGURIDADE SOCIAL'),
			array('descricao' => 'DIRETOR DE SERVIÇOS MÉDICOS'),
			array('descricao' => 'DIRETOR DE SERVIÇOS MÉDICOS/ODONT.'),
			array('descricao' => 'DIRETOR DE SERVIÇOS ODONTOLÓGICO'),
			array('descricao' => 'DIRETOR EXECUTIVO'),
			array('descricao' => 'DIRETOR EXECUTIVO DE BENEFÍCIOS'),
			array('descricao' => 'DIRETOR FINANCEIRO'),
			array('descricao' => 'DIRETOR GERAL'),
			array('descricao' => 'DIRETOR HOSPITALAR'),
			array('descricao' => 'DIRETOR INDUSTRIAL'),
			array('descricao' => 'DIRETOR LIQUIDANTE'),
			array('descricao' => 'DIRETOR MÉDICO'),
			array('descricao' => 'DIRETOR OPERACIONAL'),
			array('descricao' => 'DIRETOR PRESIDENTE'),
			array('descricao' => 'DIRETOR SÓCIO'),
			array('descricao' => 'DIRETOR SUPERINTENDENTE'),
			array('descricao' => 'GERENTE'),
			array('descricao' => 'GERENTE ADMINISTRATIVO'),
			array('descricao' => 'GERENTE ADMINISTRATIVO-FINANCEIRO'),
			array('descricao' => 'GERENTE COMERCIAL'),
			array('descricao' => 'GERENTE DA DIVISÃO DE RECURSOS'),
			array('descricao' => 'GERENTE DE ADMINISTRAÇÃO DE BENEFÍCIOS'),
			array('descricao' => 'GERENTE DE ASSISTÊNCIA'),
			array('descricao' => 'GERENTE DE ASSISTÊNCIA E SAÚDE'),
			array('descricao' => 'GERENTE DE BENEFÍCIOS ASSISTENCIAIS'),
			array('descricao' => 'GERENTE DE CONTROLADORIA'),
			array('descricao' => 'GERENTE DE CONVÊNIOS'),
			array('descricao' => 'GERENTE DE DIVISÃO'),
			array('descricao' => 'GERENTE DE MEDICINA OCUPACIONAL'),
			array('descricao' => 'GERENTE DE OPERAÇÕES'),
			array('descricao' => 'GERENTE DE PADRÕES'),
			array('descricao' => 'GERENTE DE PESSOAL'),
			array('descricao' => 'GERENTE DE PRODUÇÃO'),
			array('descricao' => 'GERENTE DE RECURSOS HUMANOS'),
			array('descricao' => 'GERENTE DE SAÚDE E SEGURANÇA'),
			array('descricao' => 'GERENTE DE UNIDADE'),
			array('descricao' => 'GERENTE DELEGADO'),
			array('descricao' => 'GERENTE EXECUTIVO'),
			array('descricao' => 'GERENTE FINANCEIRO'),
			array('descricao' => 'GERENTE GERAL'),
			array('descricao' => 'GERENTE JURÍDICO'),
			array('descricao' => 'GERENTE OPERACIONAL'),
			array('descricao' => 'GERENTE OPERACIONAL DE PLANOS'),
			array('descricao' => 'GERENTE PROCURADOR'),
			array('descricao' => 'GERENTE RELAÇÕES INDUSTRIAIS'),
			array('descricao' => 'GERENTE RESPONSÁVEL TÉCNICO'),
			array('descricao' => 'GERENTE TÉCNICO'),
			array('descricao' => 'GERENTE TÉCNICO-ADMINISTRATIVO'),
			array('descricao' => 'GESTOR'),
			array('descricao' => 'INTERVENTOR'),
			array('descricao' => 'INTERVENTOR MUNICIPAL'),
			array('descricao' => 'LIQUIDANTE'),
			array('descricao' => 'MÉDICO'),
			array('descricao' => 'MÉDICO AUDITOR'),
			array('descricao' => 'MÉDICO RESPONSÁVEL'),
			array('descricao' => 'MÉDICO RESPONSÁVEL CONTRATADO'),
			array('descricao' => 'MEMBRO CONSELHO CURADOR'),
			array('descricao' => 'MEMBRO DE CONSELHO'),
			array('descricao' => 'MEMBRO DO CONSELHO FISCAL'),
			array('descricao' => 'ODONTÓLOGO'),
			array('descricao' => 'PRESIDENTE CONSELHO ADMINISTRATIVO'),
			array('descricao' => 'PRESIDENTE CONSELHO CURADOR'),
			array('descricao' => 'PRESIDENTE CONSELHO DELIBERATIVO'),
			array('descricao' => 'PRESIDENTE CONSELHO GERAL'),
			array('descricao' => 'PRESIDENTE EXECUTIVO'),
			array('descricao' => 'PRESIDENTE GRUPO GESTOR'),
			array('descricao' => 'PRESIDENTE NACIONAL'),
			array('descricao' => 'PROCURADOR'),
			array('descricao' => 'PROPRIETÁRIO'),
			array('descricao' => 'PROVEDOR'),
			array('descricao' => 'REPRESENTANTE'),
			array('descricao' => 'REPRESENTANTE JUNTO A ANS'),
			array('descricao' => 'REPRESENTANTE LEGAL'),
			array('descricao' => 'REPRESENTANTE TÉCNICO'),
			array('descricao' => 'REPRESENTANTE TÉCNICO CONTRATADO'),
			array('descricao' => 'RESPONSÁVEL'),
			array('descricao' => 'RESPONSÁVEL JUNTO A ANS'),
			array('descricao' => 'RESPONSÁVEL LEGAL'),
			array('descricao' => 'SECRETÁRIO'),
			array('descricao' => 'SECRETÁRIO DE FINANÇAS'),
			array('descricao' => 'SÓCIO'),
			array('descricao' => 'SÓCIO ADMINISTRADOR'),
			array('descricao' => 'SÓCIO GERENTE'),
			array('descricao' => 'SUPERINTENDENTE'),
			array('descricao' => 'SUPERINTENDENTE ADMINISTRATIVO'),
			array('descricao' => 'SUPERINTENDENTE DE MEDICINA'),
			array('descricao' => 'SUPERINTENDENTE DE PLANOS'),
			array('descricao' => 'SUPERINTENDENTE DE RECURSOS HUMANOS'),
			array('descricao' => 'SUPERINTENDENTE EXECUTIVO'),
			array('descricao' => 'SUPERINTENDENTE GERAL'),
			array('descricao' => 'SUPERVISOR'),
			array('descricao' => 'SUPERVISOR DE RECURSOS HUMANOS'),
			array('descricao' => 'TÉCNICO DE SEGURANÇA DO TRABALHO'),
			array('descricao' => 'TÉCNICO EM CONTABILIDADE'),
			array('descricao' => 'TÉCNICO RESPONSÁVEL'),
			array('descricao' => 'VICE-PRESIDENTE DE SAÚDE'),
			array('descricao' => 'VICE-PRESIDENTE EXECUTIVO'),
			array('descricao' => 'PRIMEIRO VICE PROVEDOR'),
			array('descricao' => 'PRIMEIRO TESOUREIRO'),
			array('descricao' => 'DIRETOR TESOUREIRO'),
			array('descricao' => 'DIRETOR SECRETÁRIO'),
			array('descricao' => 'DIRETOR TÉCNICO'),
			array('descricao' => 'SEGUNDO VICE PROVEDOR'),
			array('descricao' => 'DIRETOR OUVIDOR'),			
		);

		foreach($array_tipos as $item)
		{
			Cargo::create($item);
		}
	}

}