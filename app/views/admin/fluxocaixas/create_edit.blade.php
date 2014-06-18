@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Lançamento</a></li>
			
		</ul>
	<!-- ./ tabs -->
	<?php
	$contas[] = array('conta'=>'ATIVIDADES OPERACIONAIS'			,'sequencia'=>'A00',	'descricao'=>'ATIVIDADES OPERACIONAIS');
	$contas[] = array('conta'=>'RECEBIMENTOS_PLANOS'				,'sequencia'=>'A01',	'descricao'=>'Recebimentos de Plano Saúde (+)');
	$contas[] = array('conta'=>'OUTROS_RECEBIMENTOS_OPER'			,'sequencia'=>'A02',	'descricao'=>'Outros Recebimentos Operacionais (+)');
	$contas[] = array('conta'=>'FORNECEDORES_PRESTADORES'			,'sequencia'=>'A03',	'descricao'=>'Pagamentos a Fornecedores/Prestadores de Serviço de Saúde (-)');
	$contas[] = array('conta'=>'COMISSOES'							,'sequencia'=>'A04',	'descricao'=>'Pagamentos de Comissões (-)');
	$contas[] = array('conta'=>'PESSOAL'							,'sequencia'=>'A05',	'descricao'=>'Pagamentos de Pessoal (-)');
	$contas[] = array('conta'=>'PRO_LABORE'							,'sequencia'=>'A06',	'descricao'=>'Pagamentos de Pró-Labore (-)');
	$contas[] = array('conta'=>'SERVICOS_TERCEIROS_OPER'			,'sequencia'=>'A07',	'descricao'=>'Pagamentos de Serviços Terceiros (-)');
	$contas[] = array('conta'=>'TRIBUTOS'							,'sequencia'=>'A08',	'descricao'=>'Pagamentos de Tributos (-)');
	$contas[] = array('conta'=>'CONTINGENCIAS'						,'sequencia'=>'A09',	'descricao'=>'Pagamentos de Contingências (-) (Cíveis/Trabalhistas/Tributárias)');
	$contas[] = array('conta'=>'ALUGUEL'							,'sequencia'=>'A10',	'descricao'=>'Pagamentos de Aluguel (-)');
	$contas[] = array('conta'=>'PROMOCAO_PUBLICIDADE'				,'sequencia'=>'A11',	'descricao'=>'Pagamentos de Promoção/Publicidade (-)');
	$contas[] = array('conta'=>'OUTROS_PAGAMENTOS'					,'sequencia'=>'A12',	'descricao'=>'Outros Pagamentos Operacionais (-)');
	$contas[] = array('conta'=>'ATIVIDADES DE INVESTIMENTO'			,'sequencia'=>'B00',	'descricao'=>'ATIVIDADES DE INVESTIMENTO');
	$contas[] = array('conta'=>'VENDA_ATIVO_HOSP'					,'sequencia'=>'B01',	'descricao'=>'Recebimentos de Venda de Ativo Imobilizado - Hospitalar (+)');
	$contas[] = array('conta'=>'VENDA_ATIVO_OUTROS'					,'sequencia'=>'B02',	'descricao'=>'Recebimentos de Venda de Ativo Imobilizado - Outros (+)');
	$contas[] = array('conta'=>'VENDA_INVESTIMENTOS'				,'sequencia'=>'B03',	'descricao'=>'Recebimentos de Venda de Investimentos (+)');
	$contas[] = array('conta'=>'DIVIDENDOS'							,'sequencia'=>'B04',	'descricao'=>'Recebimentos de Dividendos (+)');
	$contas[] = array('conta'=>'OUTROS_RECEBIMENTOS_INV'			,'sequencia'=>'B05',	'descricao'=>'Outros Recebimentos das Atividades de Investimento (+)');
	$contas[] = array('conta'=>'AQUISICAO_ATIVO_HOSP'				,'sequencia'=>'B06',	'descricao'=>'Pagamentos de Aquisição de Ativo Imobilizado - Hospitalar (-)');
	$contas[] = array('conta'=>'AQUISICAO_ATIVO_OUTROS'				,'sequencia'=>'B07',	'descricao'=>'Pagamentos de Aquisição de Ativo Imobilizado - Outros (-)');
	$contas[] = array('conta'=>'ATIVO_DIFERIDO'						,'sequencia'=>'B08',	'descricao'=>'Pagamentos Relativos ao Ativo Diferido (-)');
	$contas[] = array('conta'=>'AQUISICAO_PARTICIPACAO'				,'sequencia'=>'B09',	'descricao'=>'Pagamentos de Aquisição de Participação em Outras Empresas (-)');
	$contas[] = array('conta'=>'OUTROS_PAGAMENTOS_INV'				,'sequencia'=>'B10',	'descricao'=>'Outros Pagamentos das Atividade de Investimento (-)');
	$contas[] = array('conta'=>'ATIVIDADES DE FINANCIAMENTO'		,'sequencia'=>'C00',	'descricao'=>'ATIVIDADES DE FINANCIAMENTO');
	$contas[] = array('conta'=>'INTEGRALIZACAO_CAPITAL'				,'sequencia'=>'C01',	'descricao'=>'Integralização Capital em Dinheiro (+)');
	$contas[] = array('conta'=>'RECEBIMENTO_EMPRESTIMOS'			,'sequencia'=>'C02',	'descricao'=>'Recebimento Empréstimos/Financiamentos (+)');
	$contas[] = array('conta'=>'TITULOS_DESCONTADOS'				,'sequencia'=>'C03',	'descricao'=>'Títulos (Recebíveis) Descontados (+)');
	$contas[] = array('conta'=>'JUROS_APLICACOES'					,'sequencia'=>'C04',	'descricao'=>'Recebimentos de Juros de Aplicações Financeiras (+)');
	$contas[] = array('conta'=>'RESGATE_APLICACOES'					,'sequencia'=>'C05',	'descricao'=>'Resgate de Aplicações Financeiras (+)');
	$contas[] = array('conta'=>'OUTROS_RECEBIMENTOS_FIN'			,'sequencia'=>'C06',	'descricao'=>'Outros Recebimentos das Atividades de Financiamento (+)');
	$contas[] = array('conta'=>'JUROS_EMPRESTIMOS'					,'sequencia'=>'C07',	'descricao'=>'Pagamentos de Juros e Encargos sobre Empréstimos/Financiamentos/Leasing (-)');
	$contas[] = array('conta'=>'AMORTIZACAO_EMPRESTIMOS'			,'sequencia'=>'C08',	'descricao'=>'Pagamentos de Amortização de Empréstimos/Financiamentos/Leasing (-)');
	$contas[] = array('conta'=>'PARTICIPACAO_RESULTADOS'			,'sequencia'=>'C09',	'descricao'=>'Pagamento de Participação nos Resultados (-)');
	$contas[] = array('conta'=>'APLICACOES_FINANCEIRAS'				,'sequencia'=>'C10',	'descricao'=>'Aplicações Financeiras (-)');
	$contas[] = array('conta'=>'OUTROS_PAGAMENTOS_FIN'				,'sequencia'=>'C11',	'descricao'=>'Outros Pagamentos das Atividades de Financiamento (-)');
	$contas[] = array('conta'=>'CAIXA LIQUÍDO'						,'sequencia'=>'T00',	'descricao'=>'CAIXA LIQUÍDO');

	$meses = array(
					1 => 'Janeiro', 
					2 => 'Fevereiro', 
					3 => 'Março', 
					4 => 'Abril', 
					5 => 'Maio', 
					6 => 'Junho', 
					7 => 'Julho', 
					8 => 'Agosto', 
					9 => 'Setembro', 
					10 => 'Outubro', 
					11 => 'Novembro', 
					12 => 'Dezembro', 
			);
	$mes = array();
	$mes[1] = $meses[ (substr(Session::get('trimestre'), 4,2) * 3 - 2) ];
	$mes[2] = $meses[ (substr(Session::get('trimestre'), 4,2) * 3 - 1) ];
	$mes[3] = $meses[ (substr(Session::get('trimestre'), 4,2) * 3 ) ];
	$fluxocaixas_array = array();
	if(isset($fluxocaixas)){
		
		foreach ($fluxocaixas as $flxcaixa) {
			$fluxocaixas_array[$flxcaixa->sequencia] = array('valor'=>$flxcaixa->valor,'id'=>$flxcaixa->id);
		}
	}

	?>
	{{-- Edit Form --}}
	<form class="form-horizontal" method="post" action="@if (count($fluxocaixas_array)){{ URL::to('admin/fluxocaixas/' . $mes_num . '/editar') }}@else{{ URL::to('admin/fluxocaixas/create') }}@endif" >
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				@if(isset($mes_num))
					<input type="hidden" name="mes_num" 		value="{{ $mes_num }}" ><h2>{{ $mes[$mes_num] }}</h2>
				@else
					<div class="form-group {{{ $errors->has('mes_num') ? 'error' : '' }}}">
					    <div class="col-md-12">
					        <label class="control-label" for="mes_num">Mês</label>
							<select id="mes_num" name="mes_num" class="form-control">                                
	                            @for($k=1;$k <= count($mes);$k++)
	                                <option value="{{ $k }}" {{ Input::old('mes_num', (isset( $mes_num )? $mes_num : 1 ) ) == $k ? ' selected="selected" ':'' }}>{{ $mes[$k] }}</option>
	                            @endfor
	                        </select>
							{{{ $errors->first('mes_num', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
				@endif
				<!-- ./ mes_num -->

				@foreach($contas as $conta)
					<input type="hidden" name="conta[{{ $conta['sequencia'] }}]" 		value="{{ $conta['conta'] }}" >
					<input type="hidden" name="descricao[{{ $conta['sequencia'] }}]" 	value="{{ $conta['descricao'] }}" >
					@if(count($fluxocaixas_array))
						<input type="hidden" name="id[{{ $conta['sequencia'] }}]" 	value="{{ $fluxocaixas_array[$conta['sequencia']]['id'] }}" >
					@endif
					<!-- valor -->
					<div class="form-group{{{ $errors->has('valor') ? 'error' : '' }}}" style="border-bottom:1px solid #ccc">
	                    <div class="col-md-12">
	                        <span class="col-md-8"><label for="valor">{{ $conta['descricao'] }}</label></span>
							<span class="col-md-4" style="margin-top: -12px;"><input class="form-control moeda" type="text" name="valor[{{ $conta['sequencia'] }}]" id="valor" value="{{{ Input::old('valor', count($fluxocaixas_array) ? DataFormat::moneyBR( $fluxocaixas_array[$conta['sequencia']]['valor'] ) : null) }}}" /></span>
							{{{ $errors->first('valor', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ valor -->
				@endforeach				

			</div>
			<!-- ./ general tab -->			
		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
			<div class="col-md-12">
				<element class="btn-cancel close_popup">Cancelar</element>
				<button type="reset" class="btn btn-default">Resetar</button>
				<button type="submit" class="btn btn-success">Salvar</button>
			</div>
		</div>
		<!-- ./ form actions -->
	</form>
@stop

@section('onload')
	

@stop