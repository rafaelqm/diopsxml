<?php

class AdminXmlController extends BaseController {

	private function somenteNumeros($var){
		$procurar = array(',','.','-',' ','/','\\','(',')');
		$substituir = array('','','','','','','','');
		$var = str_replace($procurar, $substituir, $var);

		return $var;
	}

	public function getCadastral()
	{

		$operadora = Operadora::first();

		$xml = new DOMDocument('1.0', 'ISO-8859-1');
		$xml_node1 = $xml->createElement('ans:diopsCadastral');
		$xml_atributo1 = $xml->createAttribute('xmlns:ans');
		$xml_atributo1->value = "http://www.ans.gov.br/padroes/diops/schemas";

		$xml_atributo2 = $xml->createAttribute('xmlns:xsi');
		$xml_atributo2->value = "http://www.w3.org/2001/XMLSchema-instance";

		$xml_atributo3 = $xml->createAttribute('xsi:schemaLocation');
		$xml_atributo3->value = "http://www.ans.gov.br/padroes/diops/schemas/diopsComplexTypes.xsd";
		$xml_node1->appendChild($xml_atributo1);
		$xml_node1->appendChild($xml_atributo2);
		$xml_node1->appendChild($xml_atributo3);

		$xml_node2 = $xml->createElement('ans:identificador');
		$xml_node1->appendChild($xml_node2);

		$xml_node2_1 = $xml->createElement('ans:registroANS', $operadora->registroANS);
		$xml_node2->appendChild($xml_node2_1);
		
		$xml_node2_2 = $xml->createElement('ans:razaoSocial', $operadora->razaoSocial);
		$xml_node2->appendChild($xml_node2_2);
		
		$xml_node2_3 = $xml->createElement('ans:CNPJ', $this->somenteNumeros($operadora->CNPJ) );
		$xml_node2->appendChild($xml_node2_3);

		$xml_node2_4 = $xml->createElement('ans:periodo', '2014-06-01');
		$xml_node2->appendChild($xml_node2_4);

		$xml_node2_5 = $xml->createElement('ans:transacao', 'ENVIO_DIOPS_CADASTRAL');
		$xml_node2->appendChild($xml_node2_5);


		$xml->appendChild( $xml_node1 );


		$xml_node3 = $xml->createElement('ans:medicinaGrupo');
		$xml_node1->appendChild($xml_node3);
		# Cadastro
			$xml_node3_1 = $xml->createElement('ans:cadastro');
			$xml_node3->appendChild($xml_node3_1);

			$xml_node3_1_1 = $xml->createElement('ans:nomeFantasia', $operadora->nomeFantasia);
			$xml_node3_1->appendChild($xml_node3_1_1);

			# EnderecoMatriz

				$xml_node3_1_2 = $xml->createElement('ans:enderecoMatriz');
				$xml_node3_1->appendChild($xml_node3_1_2);

				$enderecoMatriz = $operadora->enderecoMatriz;

				$xml_node3_1_2_1 = $xml->createElement('ans:logradouro', $enderecoMatriz->logradouro);
				$xml_node3_1_2->appendChild($xml_node3_1_2_1);
				$xml_node3_1_2_2 = $xml->createElement('ans:numLogradouro', $enderecoMatriz->numLogradouro);
				$xml_node3_1_2->appendChild($xml_node3_1_2_2);
				$xml_node3_1_2_3 = $xml->createElement('ans:complemento', $enderecoMatriz->complemento);
				$xml_node3_1_2->appendChild($xml_node3_1_2_3);
				$xml_node3_1_2_4 = $xml->createElement('ans:bairro', $enderecoMatriz->bairro);
				$xml_node3_1_2->appendChild($xml_node3_1_2_4);
				$xml_node3_1_2_5 = $xml->createElement('ans:municipioIBGE', $enderecoMatriz->municipioIBGE);
				$xml_node3_1_2->appendChild($xml_node3_1_2_5);
				$xml_node3_1_2_6 = $xml->createElement('ans:siglaUF', $enderecoMatriz->siglaUF);
				$xml_node3_1_2->appendChild($xml_node3_1_2_6);
				$xml_node3_1_2_7 = $xml->createElement('ans:cep', $enderecoMatriz->cep);
				$xml_node3_1_2->appendChild($xml_node3_1_2_7);

			# Telefones
				$telefones = $operadora->telefones()->where('tabela','=','operadoras')->get();


				$num_tel = 0;
				$xml_node3_1_2_array = array();
				foreach ($telefones as $telefone) {				
					$xml_node3_1_2_array[$num_tel] = $xml->createElement('ans:telefone');

					$xml_node3_1_2_array_ddi[$num_tel] = $xml->createElement('ans:codigoDDI', $telefone->codigoDDI);
					$xml_node3_1_2_array_ddd[$num_tel] = $xml->createElement('ans:codigoDDD', $telefone->codigoDDD);
					$xml_node3_1_2_array_num[$num_tel] = $xml->createElement('ans:numeroTel', $telefone->numeroTel);
					$xml_node3_1_2_array_ram[$num_tel] = $xml->createElement('ans:ramal', $telefone->ramal);

					$xml_node3_1_2_array[$num_tel]->appendChild($xml_node3_1_2_array_ddi[$num_tel]);
					$xml_node3_1_2_array[$num_tel]->appendChild($xml_node3_1_2_array_ddd[$num_tel]);
					$xml_node3_1_2_array[$num_tel]->appendChild($xml_node3_1_2_array_num[$num_tel]);
					$xml_node3_1_2_array[$num_tel]->appendChild($xml_node3_1_2_array_ram[$num_tel]);

					$xml_node3_1->appendChild($xml_node3_1_2_array[$num_tel]);

					$num_tel++;
				}
			# Email
				$xml_node3_1_3 = $xml->createElement('ans:eMail',$operadora->eMail);
				$xml_node3_1->appendChild($xml_node3_1_3);

			# enderecoCorresp
				$xml_node3_1_4 = $xml->createElement('ans:enderecoCorresp');
				$xml_node3_1->appendChild($xml_node3_1_4);


					$enderecoCorresp = $operadora->enderecoCorresp;

					$xml_node3_1_4_1 = $xml->createElement('ans:logradouro', $enderecoCorresp->logradouro);
					$xml_node3_1_4->appendChild($xml_node3_1_4_1);
					$xml_node3_1_4_2 = $xml->createElement('ans:numLogradouro', $enderecoCorresp->numLogradouro);
					$xml_node3_1_4->appendChild($xml_node3_1_4_2);
					$xml_node3_1_4_3 = $xml->createElement('ans:complemento', $enderecoCorresp->complemento);
					$xml_node3_1_4->appendChild($xml_node3_1_4_3);
					$xml_node3_1_4_4 = $xml->createElement('ans:bairro', $enderecoCorresp->bairro);
					$xml_node3_1_4->appendChild($xml_node3_1_4_4);
					$xml_node3_1_4_5 = $xml->createElement('ans:municipioIBGE', $enderecoCorresp->municipioIBGE);
					$xml_node3_1_4->appendChild($xml_node3_1_4_5);
					$xml_node3_1_4_6 = $xml->createElement('ans:siglaUF', $enderecoCorresp->siglaUF);
					$xml_node3_1_4->appendChild($xml_node3_1_4_6);
					$xml_node3_1_4_7 = $xml->createElement('ans:cep', $enderecoCorresp->cep);
					$xml_node3_1_4->appendChild($xml_node3_1_4_7);

		# Enquadramento
			$xml_node3_2 = $xml->createElement('ans:enquadramento');
			$xml_node3->appendChild($xml_node3_2);

				$xml_node3_2_1 = $xml->createElement('ans:segmentacao',$operadora->segmentacao);
				$xml_node3_2->appendChild($xml_node3_2_1);

				$xml_node3_2_2 = $xml->createElement('ans:UF');
				$xml_node3_2->appendChild($xml_node3_2_2);

					$xml_node3_2_2_1 = $xml->createElement('ans:siglaUF',$operadora->siglaUF);
					$xml_node3_2_2->appendChild($xml_node3_2_2_1);

					$xml_node3_2_2_2 = $xml->createElement('ans:listaMunicipios');
					$xml_node3_2_2->appendChild($xml_node3_2_2_2);

						$xml_node3_2_2_2_1 = $xml->createElement('ans:municipioIBGE',$operadora->municipioIBGE);
						$xml_node3_2_2_2->appendChild($xml_node3_2_2_2_1);

		# Dados Basicos

			$xml_node3_3 = $xml->createElement('ans:dadosBasicos');
			$xml_node3->appendChild($xml_node3_3);

			# respContabilidade
			
				$responsavel = Resp::where('tipo','=','C')->first();
				$xml_node3_3_1 = $xml->createElement('ans:respContabilidade');
				$xml_node3_3->appendChild($xml_node3_3_1);

				$xml_node3_3_1_1 = $xml->createElement('ans:identifResp');
				$xml_node3_3_1->appendChild($xml_node3_3_1_1);

				$nomeCampo = ($responsavel->tipoPessoa=='F'?'CPF':'CNPJ');

				$xml_node3_3_1_1_1 = $xml->createElement('ans:'.$nomeCampo,$this->somenteNumeros($responsavel->cpfCnpj));
				$xml_node3_3_1_1->appendChild($xml_node3_3_1_1_1);

				$xml_node3_3_1_2 = $xml->createElement('ans:nome',$responsavel->nome);
				$xml_node3_3_1->appendChild($xml_node3_3_1_2);

				$xml_node3_3_1_3 = $xml->createElement('ans:numRegistro',$responsavel->numRegistro);
				$xml_node3_3_1->appendChild($xml_node3_3_1_3);

			# respAtuaria
			
				$responsavel = Resp::where('tipo','=','T')->first();
				$xml_node3_3_2 = $xml->createElement('ans:respAtuaria');
				$xml_node3_3->appendChild($xml_node3_3_2);

				$xml_node3_3_2_1 = $xml->createElement('ans:identifResp');
				$xml_node3_3_2->appendChild($xml_node3_3_2_1);

				$nomeCampo = ($responsavel->tipoPessoa=='F'?'CPF':'CNPJ');

				$xml_node3_3_2_1_1 = $xml->createElement('ans:'.$nomeCampo,$this->somenteNumeros($responsavel->cpfCnpj));
				$xml_node3_3_2_1->appendChild($xml_node3_3_2_1_1);

				$xml_node3_3_2_2 = $xml->createElement('ans:nome',$responsavel->nome);
				$xml_node3_3_2->appendChild($xml_node3_3_2_2);

				$xml_node3_3_2_3 = $xml->createElement('ans:numRegistro',$responsavel->numRegistro);
				$xml_node3_3_2->appendChild($xml_node3_3_2_3);

			# respAuditoria
			
				$responsavel = Resp::where('tipo','=','U')->first();
				$xml_node3_3_3 = $xml->createElement('ans:respAuditoria');
				$xml_node3_3->appendChild($xml_node3_3_3);

				$xml_node3_3_3_1 = $xml->createElement('ans:identifResp');
				$xml_node3_3_3->appendChild($xml_node3_3_3_1);

				$nomeCampo = ($responsavel->tipoPessoa=='F'?'CPF':'CNPJ');

				$xml_node3_3_3_1_1 = $xml->createElement('ans:'.$nomeCampo,$this->somenteNumeros($responsavel->cpfCnpj));
				$xml_node3_3_3_1->appendChild($xml_node3_3_3_1_1);

				$xml_node3_3_3_2 = $xml->createElement('ans:nome',$responsavel->nome);
				$xml_node3_3_3->appendChild($xml_node3_3_3_2);

				$xml_node3_3_3_3 = $xml->createElement('ans:numRegistro',$responsavel->numRegistro);
				$xml_node3_3_3->appendChild($xml_node3_3_3_3);

		# administradores
			$xml_node3_4 = $xml->createElement('ans:administradores');
			$xml_node3->appendChild($xml_node3_4);

			$administradores = Admin::where('resposavelTecnico','=','0')->get();
			$k = 0;
			foreach ($administradores as $administrador) {
				
				$xml_node3_4_array[$k] = $xml->createElement('ans:administrador');
				$xml_node3_4->appendChild($xml_node3_4_array[$k]);

				$xml_node3_4_array_CPF[$k] = $xml->createElement('ans:CPF', $this->somenteNumeros($administrador->CPF) );
				$xml_node3_4_array[$k]->appendChild($xml_node3_4_array_CPF[$k]);

				$xml_node3_4_array_nome[$k] = $xml->createElement('ans:nome', $administrador->nome);
				$xml_node3_4_array[$k]->appendChild($xml_node3_4_array_nome[$k]);

				$xml_node3_4_array_nomeMae[$k] = $xml->createElement('ans:nomeMae', $administrador->nomeMae);
				$xml_node3_4_array[$k]->appendChild($xml_node3_4_array_nomeMae[$k]);

				$xml_node3_4_array_cargoFuncao[$k] = $xml->createElement('ans:cargoFuncao', $administrador->cargoFuncao);
				$xml_node3_4_array[$k]->appendChild($xml_node3_4_array_cargoFuncao[$k]);

				$xml_node3_4_array_dataIniMandato[$k] = $xml->createElement('ans:dataIniMandato', $administrador->dataIniMandato);
				$xml_node3_4_array[$k]->appendChild($xml_node3_4_array_dataIniMandato[$k]);

				if(! is_null($administrador->dataFimMandato)){
					$xml_node3_4_array_dataFimMandato[$k] = $xml->createElement('ans:dataFimMandato', $administrador->dataFimMandato);
					$xml_node3_4_array[$k]->appendChild($xml_node3_4_array_dataFimMandato[$k]);
				}

				$k++;
			}

			$administradores = Admin::where('resposavelTecnico','=','1')->get();
			$k = 0;
			foreach ($administradores as $administrador) {
				
				$xml_node3_5_array[$k] = $xml->createElement('ans:respTecnico');
				$xml_node3_4->appendChild($xml_node3_5_array[$k]);

				$xml_node3_5_array_CPF[$k] = $xml->createElement('ans:CPF', $this->somenteNumeros($administrador->CPF) );
				$xml_node3_5_array[$k]->appendChild($xml_node3_5_array_CPF[$k]);

				$xml_node3_5_array_tipoConsRegional[$k] = $xml->createElement('ans:tipoConsRegional', $administrador->tipo);
				$xml_node3_5_array[$k]->appendChild($xml_node3_5_array_tipoConsRegional[$k]);

				$xml_node3_5_array_numConsRegional[$k] = $xml->createElement('ans:numConsRegional', $administrador->crm);
				$xml_node3_5_array[$k]->appendChild($xml_node3_5_array_numConsRegional[$k]);
				
				$k++;
			}

		# representante
			$xml_node3_5 = $xml->createElement('ans:representante');
			$xml_node3->appendChild($xml_node3_5);

			$representante = Representante::where('tipoRepresentante','=','ANS')->first();

				if($representante){

					$xml_node3_5_1 = $xml->createElement('ans:CPF', $this->somenteNumeros($representante->CPF));
					$xml_node3_5->appendChild($xml_node3_5_1);

					$xml_node3_5_2 = $xml->createElement('ans:nome', $representante->nome);
					$xml_node3_5->appendChild($xml_node3_5_2);

					# enderecoRepresentante
						$xml_node3_5_3 = $xml->createElement('ans:enderecoRepresentante');
						$xml_node3_5->appendChild($xml_node3_5_3);

						$enderecoRepresentante = $representante->enderecoAtual;

						$xml_node3_5_3_1 = $xml->createElement('ans:logradouro', 	$enderecoRepresentante->logradouro);
						$xml_node3_5_3->appendChild($xml_node3_5_3_1);
						$xml_node3_5_3_2 = $xml->createElement('ans:numLogradouro', $enderecoRepresentante->numLogradouro);
						$xml_node3_5_3->appendChild($xml_node3_5_3_2);
						$xml_node3_5_3_3 = $xml->createElement('ans:complemento', 	$enderecoRepresentante->complemento);
						$xml_node3_5_3->appendChild($xml_node3_5_3_3);
						$xml_node3_5_3_4 = $xml->createElement('ans:bairro', 		$enderecoRepresentante->bairro);
						$xml_node3_5_3->appendChild($xml_node3_5_3_4);
						$xml_node3_5_3_5 = $xml->createElement('ans:municipioIBGE', $enderecoRepresentante->municipioIBGE);
						$xml_node3_5_3->appendChild($xml_node3_5_3_5);
						$xml_node3_5_3_6 = $xml->createElement('ans:siglaUF', 		$enderecoRepresentante->siglaUF);
						$xml_node3_5_3->appendChild($xml_node3_5_3_6);
						$xml_node3_5_3_7 = $xml->createElement('ans:cep', 			$enderecoRepresentante->cep);
						$xml_node3_5_3->appendChild($xml_node3_5_3_7);

					# Telefones
						$telefones = $representante->telefones()->where('tabela','=','representantes')->get();

						$num_tel = 0;
						$xml_node3_5_4_array = array();
						foreach ($telefones as $telefone) {				
							$xml_node3_5_4_array[$num_tel] = $xml->createElement('ans:telefone');

							$xml_node3_5_4_array_ddi[$num_tel] = $xml->createElement('ans:codigoDDI', $telefone->codigoDDI);
							$xml_node3_5_4_array_ddd[$num_tel] = $xml->createElement('ans:codigoDDD', $telefone->codigoDDD);
							$xml_node3_5_4_array_num[$num_tel] = $xml->createElement('ans:numeroTel', $telefone->numeroTel);
							$xml_node3_5_4_array_ram[$num_tel] = $xml->createElement('ans:ramal', $telefone->ramal);

							$xml_node3_5_4_array[$num_tel]->appendChild($xml_node3_5_4_array_ddi[$num_tel]);
							$xml_node3_5_4_array[$num_tel]->appendChild($xml_node3_5_4_array_ddd[$num_tel]);
							$xml_node3_5_4_array[$num_tel]->appendChild($xml_node3_5_4_array_num[$num_tel]);
							$xml_node3_5_4_array[$num_tel]->appendChild($xml_node3_5_4_array_ram[$num_tel]);

							$xml_node3_5->appendChild($xml_node3_5_4_array[$num_tel]);

							$num_tel++;
						}

					# Email
						$xml_node3_5_5 = $xml->createElement('ans:eMail', $representante->eMail);
						$xml_node3_5->appendChild($xml_node3_5_5);

				}

		# represRN117
			$xml_node3_6 = $xml->createElement('ans:represRN117');
			$xml_node3->appendChild($xml_node3_6);

			$representante = Representante::where('tipoRepresentante','=','RN117')->first();

				if($representante){

					$xml_node3_6_1 = $xml->createElement('ans:CPF', $this->somenteNumeros($representante->CPF));
					$xml_node3_6->appendChild($xml_node3_6_1);

					$xml_node3_6_2 = $xml->createElement('ans:nome', $representante->nome);
					$xml_node3_6->appendChild($xml_node3_6_2);

					# enderecoRepresentante
						$xml_node3_6_3 = $xml->createElement('ans:enderecoRepresentante');
						$xml_node3_6->appendChild($xml_node3_6_3);

						$enderecoRepresentante = $representante->enderecoAtual;

						$xml_node3_6_3_1 = $xml->createElement('ans:logradouro', 	$enderecoRepresentante->logradouro);
						$xml_node3_6_3->appendChild($xml_node3_6_3_1);
						$xml_node3_6_3_2 = $xml->createElement('ans:numLogradouro', $enderecoRepresentante->numLogradouro);
						$xml_node3_6_3->appendChild($xml_node3_6_3_2);
						$xml_node3_6_3_3 = $xml->createElement('ans:complemento', 	$enderecoRepresentante->complemento);
						$xml_node3_6_3->appendChild($xml_node3_6_3_3);
						$xml_node3_6_3_4 = $xml->createElement('ans:bairro', 		$enderecoRepresentante->bairro);
						$xml_node3_6_3->appendChild($xml_node3_6_3_4);
						$xml_node3_6_3_5 = $xml->createElement('ans:municipioIBGE', $enderecoRepresentante->municipioIBGE);
						$xml_node3_6_3->appendChild($xml_node3_6_3_5);
						$xml_node3_6_3_6 = $xml->createElement('ans:siglaUF', 		$enderecoRepresentante->siglaUF);
						$xml_node3_6_3->appendChild($xml_node3_6_3_6);
						$xml_node3_6_3_7 = $xml->createElement('ans:cep', 			$enderecoRepresentante->cep);
						$xml_node3_6_3->appendChild($xml_node3_6_3_7);

					# Telefones
						$telefones = $representante->telefones()->where('tabela','=','representantes')->get();

						$num_tel = 0;
						$xml_node3_6_4_array = array();
						foreach ($telefones as $telefone) {				
							$xml_node3_6_4_array[$num_tel] = $xml->createElement('ans:telefone');

							$xml_node3_6_4_array_ddi[$num_tel] = $xml->createElement('ans:codigoDDI', $telefone->codigoDDI);
							$xml_node3_6_4_array_ddd[$num_tel] = $xml->createElement('ans:codigoDDD', $telefone->codigoDDD);
							$xml_node3_6_4_array_num[$num_tel] = $xml->createElement('ans:numeroTel', $telefone->numeroTel);
							$xml_node3_6_4_array_ram[$num_tel] = $xml->createElement('ans:ramal', $telefone->ramal);

							$xml_node3_6_4_array[$num_tel]->appendChild($xml_node3_6_4_array_ddi[$num_tel]);
							$xml_node3_6_4_array[$num_tel]->appendChild($xml_node3_6_4_array_ddd[$num_tel]);
							$xml_node3_6_4_array[$num_tel]->appendChild($xml_node3_6_4_array_num[$num_tel]);
							$xml_node3_6_4_array[$num_tel]->appendChild($xml_node3_6_4_array_ram[$num_tel]);

							$xml_node3_6->appendChild($xml_node3_6_4_array[$num_tel]);

							$num_tel++;
						}

					# Email
						$xml_node3_6_5 = $xml->createElement('ans:eMail', $representante->eMail);
						$xml_node3_6->appendChild($xml_node3_6_5);
					# numeroRG
						$xml_node3_6_6 = $xml->createElement('ans:numeroRG', $representante->RG);
						$xml_node3_6->appendChild($xml_node3_6_6);
					# dataExpedicao
						$xml_node3_6_7 = $xml->createElement('ans:dataExpedicao', $representante->dataExpedicao);
						$xml_node3_6->appendChild($xml_node3_6_7);
					# orgaoExpeditor
						$xml_node3_6_8 = $xml->createElement('ans:orgaoExpeditor', $representante->orgaoExpeditor);
						$xml_node3_6->appendChild($xml_node3_6_8);
					# pais 
						$xml_node3_6_9 = $xml->createElement('ans:pais', $representante->pais);
						$xml_node3_6->appendChild($xml_node3_6_9);
					# cargo
						$xml_node3_6_10 = $xml->createElement('ans:cargo', $representante->cargo);
						$xml_node3_6->appendChild($xml_node3_6_10);

				}

		# acionQuotistas
			$xml_node3_7 = $xml->createElement('ans:acionQuotistas');
			$xml_node3->appendChild($xml_node3_7);

			$xml_node3_7_1 = $xml->createElement('ans:totalmentePulverizado', $operadora->totalmentePulverizado);
			$xml_node3_7->appendChild($xml_node3_7_1);

			$xml_node3_7_2 = $xml->createElement('ans:totalAcoesQuotas', number_format( $operadora->totalAcoesQuotas,0,'','') );
			$xml_node3_7->appendChild($xml_node3_7_2);

			/**
			* @todo acionistaQuotista - Como não existe no meu caso, para economizar tempo não fiz.
			*/

		# controlColigadas
			$xml_node3_8 = $xml->createElement('ans:controlColigadas');
			$xml_node3->appendChild($xml_node3_8);
			/**
			* @todo empresa - Como não existe no meu caso, para economizar tempo não fiz.
			*/

		# dependencias
			$xml_node3_9 = $xml->createElement('ans:dependencias');
			$xml_node3->appendChild($xml_node3_9);
			/**
			* @todo empresaDependente - Como não existe no meu caso, para economizar tempo não fiz.
			*/

		// $xml->save("/tmp/test.xml");

		// return $xml->saveXML();
		$header['Content-Type'] = 'application/xml';
		return Response::make($xml->saveXML(), 200, $header);
	}

	public function getFinanceiro()
	{
		$operadora = Operadora::first();

		$xml = new DOMDocument('1.0', 'ISO-8859-1');
		$xml_node1 = $xml->createElement('ans:diopsFinanc');
		$xml_atributo1 = $xml->createAttribute('xmlns:ans');
		$xml_atributo1->value = "http://www.ans.gov.br/padroes/diops/schemas";

		$xml_atributo2 = $xml->createAttribute('xmlns:xsi');
		$xml_atributo2->value = "http://www.w3.org/2001/XMLSchema-instance";

		$xml_atributo3 = $xml->createAttribute('xsi:schemaLocation');
		$xml_atributo3->value = "http://www.ans.gov.br/padroes/diops/schemas/diopsComplexTypes.xsd";
		$xml_node1->appendChild($xml_atributo1);
		$xml_node1->appendChild($xml_atributo2);
		$xml_node1->appendChild($xml_atributo3);

		$xml_node2 = $xml->createElement('ans:identificador');
		$xml_node1->appendChild($xml_node2);

		$xml_node2_1 = $xml->createElement('ans:registroANS', $operadora->registroANS);
		$xml_node2->appendChild($xml_node2_1);
		
		$xml_node2_2 = $xml->createElement('ans:razaoSocial', $operadora->razaoSocial);
		$xml_node2->appendChild($xml_node2_2);
		
		$xml_node2_3 = $xml->createElement('ans:CNPJ', $this->somenteNumeros($operadora->CNPJ) );
		$xml_node2->appendChild($xml_node2_3);

		$xml_node2_4 = $xml->createElement('ans:periodo', '2014-06-01');
		$xml_node2->appendChild($xml_node2_4);

		$xml_node2_5 = $xml->createElement('ans:transacao', 'ENVIO_DIOPS_FINANCEIRO	');
		$xml_node2->appendChild($xml_node2_5);


		$xml->appendChild( $xml_node1 );

		// Conteúdo
		
		$header['Content-Type'] = 'application/xml';
		return Response::make($xml->saveXML(), 200, $header);

	}
}