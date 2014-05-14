<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelasCadastro extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('natureza_juridicas', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo',10)->unique();
            $table->string('descricao');
		});

		Schema::create('modalidades', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo',10)->unique();
            $table->string('descricao');
		});

		Schema::create('segmentos', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('codigo',10)->unique();
            $table->string('descricao');
		});

		Schema::create('cargos', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('descricao');
		});

		Schema::create('ANSoperadoras', function ($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->tinyInteger('operadora')->default(1);
			$table->string('registroOperadora',50);
			$table->string('nome');
			$table->string('nomeFantasia');
			$table->string('CNPJ',20);
		});

		Schema::create('enderecos', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('tipoEndereco',1)->default('M'); // M = Matriz | C = Correspondência
			$table->string('logradouro');
			$table->string('numLogradouro',10);
			$table->string('complemento')->nullable();
			$table->string('bairro')->nullable();
			$table->string('municipioIBGE',10);
			$table->string('siglaUF',2);
			$table->string('cep',10);

		});

		Schema::create('operadoras', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('registroANS')->unique();
			$table->string('razaoSocial');
			$table->string('nomeFantasia');
			$table->string('CNPJ');
			$table->string('eMail');
			$table->string('naturezaJuridica')->default('SOCIA');
            $table->integer('endereco_matriz')->unsigned();
            $table->integer('endereco_corresp')->unsigned();

            // Acionistas definições
            $table->string('totalmentePulverizado',1)->default('S');
            $table->decimal('totalAcoesQuotas',19,1)->nullable();

			$table->foreign('endereco_matriz')->references('id')->on('enderecos');
			$table->foreign('endereco_corresp')->references('id')->on('enderecos');

		});
		
		
		Schema::create('telefones', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('tabela'); // operadoras, representantes, dependentes
            $table->integer('tabela_id')->unsigned();
            $table->string('codigoDDI',2)->default('55');
            $table->string('codigoDDD',2);
            $table->string('numeroTel');
            $table->string('ramal')->nullable();

		});

		Schema::create('admins', function ($table){
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('CPF',20)->nullable();
			$table->tinyInteger('estrangeiro')->default(0);
			$table->string('nome');
			$table->string('nomeMae');
			$table->integer('cargoFuncao')->unsigned();
			$table->date('dataIniMandato');
			$table->date('dataFimMandato')->nullable();
			$table->tinyInteger('resposavelTecnico');
			$table->string('tipo',1)->nullable(); // M = médico , D = Dentista
			$table->string('crm')->nullable();

			$table->foreign('cargoFuncao')->references('id')->on('cargos');
        });

		Schema::create('resps', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipoPessoa',1)->default('F');
            $table->string('nome');
            $table->string('cpfCnpj',20);
            $table->string('tipo',1)->default('C'); // C = Contabilidade | T = Atuária | U = Auditoria
			$table->string('numRegistro')->nullable();
		});


		Schema::create('paises', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('descricao');
		});

		Schema::create('representantes', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('CPF',20)->nullable();
			$table->string('RG',20)->nullable();
            $table->string('nome');
            $table->string('email');
            $table->string('tipoRepresentante',5); // ANS | RN117
            $table->date('dataExpedicao');
            $table->string('orgaoExpeditor',10);

            $table->integer('pais')->unsigned();
            $table->integer('cargo')->unsigned();

            $table->integer('endereco')->unsigned();

            $table->foreign('endereco')->references('id')->on('enderecos');
			
            $table->foreign('pais')->references('id')->on('paises');
            $table->foreign('cargo')->references('id')->on('cargos');

		});
		
		Schema::create('acionistas', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipoPessoa',1)->default('F');
			$table->string('cpfCnpj',20)->nullable();
            $table->string('nome');
            $table->decimal('qtdAcoesQuotas',19,1);
		});

		Schema::create('coligadas', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('CNPJ',20)->nullable();
            $table->string('tipoVinculo',1)->default('N'); // N = Controlada | L = Coligada
            $table->string('classificacaoEmpresa',1)->default('C'); // C = Congênere | H = hospital | O = Outras
            $table->string('razaoSocial');
            $table->decimal('qtdeAcoesQuotas',19,1);
            $table->decimal('totalAcoesQuotas',19,1);
		});

		Schema::create('dependentes', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('CNPJ',20)->nullable();
			$table->string('tipo',10)->nullable(); // Filial | Sucursal | Outra
            $table->string('razaoSocial');
            $table->string('email');

            $table->integer('endereco')->unsigned();

            $table->foreign('endereco')->references('id')->on('enderecos');
		});

		// Financeiro 

		Schema::create('lancamentos', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('tipo',1)->default('A'); // A = Ativo | P = Passivo | R = Receita | D = Despesa
			$table->string('conta');
			$table->string('contaTasy')->nullable();
			$table->string('descricao')->nullable();
            $table->decimal('saldoAnterior',19,2);
            $table->decimal('debito',19,2);
            $table->decimal('credito',19,2);
            $table->decimal('saldoFinal',19,2);
            $table->date('inicioPeriodo');

		});

		Schema::create('fluxoCaixas', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
			$table->string('descricao');
			$table->string('conta');
            $table->decimal('valor',19,2);
            $table->date('inicioPeriodo');
		});

		Schema::create('idadeSaldoPassivos', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('dias');
            $table->decimal('eventos',19,2);
            $table->decimal('comercial',19,2);
            $table->decimal('debOper',19,2);
            $table->decimal('outrosDebOper',19,2);
            $table->decimal('depBenConSegRec',19,2);
            $table->decimal('prestServAS',19,2);
            $table->decimal('depAquisCarre',19,2);
            $table->decimal('outrosDebPagar',19,2);
            $table->decimal('eventossus',19,2);
            $table->decimal('titulosencargos',19,2);
            $table->date('inicioPeriodo');
		});

		Schema::create('idadeSaldoAtivos', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('dias');
            $table->decimal('individualPre',19,2);
            $table->decimal('individualPos',19,2);
            $table->decimal('coletivoPre',19,2);
            $table->decimal('coletivoPos',19,2);
            $table->decimal('taxaAdm',19,2);
            $table->decimal('partBenefES',19,2);
            $table->decimal('credOper',19,2);
            $table->decimal('outrosCredComPlano',19,2);
            $table->decimal('outrosCredSemPlano',19,2);
            $table->date('inicioPeriodo');
		});

		Schema::create('lucrosPrejuizos', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('conta');
            $table->decimal('valor',19,2);
			$table->string('descricao')->nullable();
            $table->date('inicioPeriodo');
		});

		Schema::create('informacoesSolvencias', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('conta');
            $table->decimal('valor',19,2);
			$table->string('descricao')->nullable();
            $table->date('inicioPeriodo');
		});

		Schema::create('segProvEventosSinistrosLiq', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->decimal('EventoSinistrosAte',19,2);
            $table->decimal('EventoSinistrosPos',19,2);
            $table->date('inicioPeriodo');
		});

		Schema::create('coberturaAssistencial', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tipo',1)->default('H');
			$table->string('plano');

			// <!-- VALORES PARA CONSULTAS MÉDICAS (REDE PROPRIA, REDE CONTRATADA, REEMBOLSO E INTERCAMBIO EVENTUAL -->
            $table->decimal('valorConsultaRP',19,2);
            $table->decimal('valorConsultaRC',19,2);
            $table->decimal('valorConsultaRE',19,2);
            $table->decimal('valorConsultaIE',19,2);
			
			// <!-- VALORES PARA EXAMES (REDE PROPRIA, REDE CONTRATADA, REEMBOLSO E INTERCAMBIO EVENTUAL -->
            $table->decimal('valorExameRP',19,2);
            $table->decimal('valorExameRC',19,2);
            $table->decimal('valorExameRE',19,2);
            $table->decimal('valorExameIE',19,2);
			
			// <!-- VALORES PARA TERAPIAS (REDE PROPRIA, REDE CONTRATADA, REEMBOLSO E INTERCAMBIO EVENTUAL -->
            $table->decimal('valorTerapiaRP',19,2);
            $table->decimal('valorTerapiaRC',19,2);
            $table->decimal('valorTerapiaRE',19,2);
            $table->decimal('valorTerapiaIE',19,2);
			
			// <!-- VALORES PARA INTERNAÇÕES (REDE PROPRIA, REDE CONTRATADA, REEMBOLSO E INTERCAMBIO EVENTUAL -->
            $table->decimal('valorInternRP',19,2);
            $table->decimal('valorInternRC',19,2);
            $table->decimal('valorInternRE',19,2);
            $table->decimal('valorInternIE',19,2);
			
			// <!-- VALORES PARA OUTROS ATENDIMENTOS (REDE PROPRIA, REDE CONTRATADA, REEMBOLSO E INTERCAMBIO EVENTUAL -->
            $table->decimal('valorAtendimentoRP',19,2);
            $table->decimal('valorAtendimentoRC',19,2);
            $table->decimal('valorAtendimentoRE',19,2);
            $table->decimal('valorAtendimentoIE',19,2);

            // <!-- VALORES PARA DEMAIS DESPESAS (REDE PROPRIA, REDE CONTRATADA, REEMBOLSO E INTERCAMBIO EVENTUAL -->
            $table->decimal('valorDespesasRP',19,2);
            $table->decimal('valorDespesasRC',19,2);
            $table->decimal('valorDespesasRE',19,2);
            $table->decimal('valorDespesasIE',19,2);

            // Versão 1.20 22/04/2014
            $table->decimal('valorOdontologicoRP',19,2);
            $table->decimal('valorOdontologicoRC',19,2);
            $table->decimal('valorOdontologicoRE',19,2);
            $table->decimal('valorOdontologicoIE',19,2);

            $table->date('inicioPeriodo');
		});

		Schema::create('intercambioEventual', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string(	'tipo',1)->default('R'); // R = Receber | P = Pagar | F = Faturar
            $table->string(	'tipoCobertura',1)->default('H'); // H = Hospital | O = Odontológico
            $table->string(	'registroOperadora',50);
            $table->decimal('saldoIntercambio',19,2);
            $table->date(	'dataVencimento');
            $table->date(	'inicioPeriodo');
		});

		Schema::create('contaCorrenteCooperado', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string(	'tipoImposto',10);
            $table->string(	'nomeImposto');
            $table->date(	'dataCompetencia');
            $table->date(	'dataAdesaoRefis');
            $table->integer('qtdeParcelas');
            $table->decimal('valorTotalFinanciado',19,2);
            $table->decimal('valorTotalPago',19,2);
            $table->decimal('valorSaldoTrim',19,2);
            $table->integer('qtdeParcelasDevidas');
            $table->decimal('valorPagoTrim',19,2);
            $table->integer('qtdeParcelasPagas');
            $table->decimal('valorAtualMone',19,2);
            $table->decimal('valorSaldoFinalTrim',19,2);
		});
		/*
		Schema::create('tabela', function ($table){
			$table->engine = 'InnoDB';
            $table->increments('id');
		});
		*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('natureza_juridicas');
		Schema::dropIfExists('modalidades');
		Schema::dropIfExists('segmentos');
		Schema::dropIfExists('cargos');
		Schema::dropIfExists('ANSoperadoras');
		Schema::dropIfExists('enderecos');
		Schema::dropIfExists('operadoras');
		Schema::dropIfExists('telefones');
		Schema::dropIfExists('admins');
		Schema::dropIfExists('resps');
		Schema::dropIfExists('paises');
		Schema::dropIfExists('representantes');
		Schema::dropIfExists('acionistas');
		Schema::dropIfExists('coligadas');
		Schema::dropIfExists('dependentes');
		Schema::dropIfExists('lancamentos');
		Schema::dropIfExists('fluxoCaixas');
		Schema::dropIfExists('idadeSaldoPassivos');
		Schema::dropIfExists('idadeSaldoAtivos');
		Schema::dropIfExists('lucrosPrejuizos');
		Schema::dropIfExists('informacoesSolvencias');
		Schema::dropIfExists('segProvEventosSinistrosLiq');
		Schema::dropIfExists('coberturaAssistencial');
		Schema::dropIfExists('intercambioEventual');
		Schema::dropIfExists('contaCorrenteCooperado');
	}

}
