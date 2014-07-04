@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')IdadeSaldo Trimestral administration @stop
@section('author')Rafael Querino Moreira @stop
@section('description')IdadeSaldo Trimestral administration @stop

{{-- Content --}}
@section('content')
<script type="text/javascript">
	var obj_atual = null;
	var valor_atual = 0;
</script>
<?php
$array_dias = array(
    0       => 'a Vencer',
    30      => 'Vencidos de 1 a 30 dias',
    60      => 'Vencidos de 31 a 60 dias',
    90      => 'Vencidos de 61 a 90 dias',
    366     => 'Vencidos a mais de 90 dias',
    800     => 'Subtotal',
    801     => '(-)Faturamento Antecipado',
    830     => '(-)PPSC',
    9999    => 'SALDO',
);
$array_dias_passivo = array(
    0       => 'a Vencer',
    30      => 'Vencidos de 1 a 30 dias',
    60      => 'Vencidos de 31 a 60 dias',
    90      => 'Vencidos de 61 a 90 dias',
    120     => 'Vencidos de 91 a 120 dias',
    366     => 'Vencidos a mais de 120 dias',
    9999    => 'SALDO',
);
?>
	<div class="page-header">
		<h3>
			Idade de Saldos
			
			<!-- <div class="pull-right">
				<a href="{{{ URL::to('admin/idadesaldos/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Criar</a>
			</div> -->

		</h3>
		<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-passivos" data-toggle="tab">A Pagar</a></li>
			<li><a href="#tab-ativos" data-toggle="tab">A Receber</a></li>
			
		</ul>
	<!-- ./ tabs -->
	</div>

	<!-- Tabs Content -->
		<div class="tab-content">
			<!-- passivos tab -->
			<div class="tab-pane table-responsive active" id="tab-passivos">
				<table id="idadesaldospassivo" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th colspan="9">Débitos de operações com planos de saúde</th>
							<th colspan="4">Outros Débitos não relacionados com planos de saúde</th>
						</tr>
						<tr>
							<th width="100">Vencimento</th>
							<th width="100">Eventos/ sinistros à liquidar (SUS)</th>
							<th width="100">Eventos/Sinistros à liquidar (Prestador)</th>
							<th width="100">Comercialização sobre operações</th>
							<th width="100">Débitos com Operadoras</th>
							<th width="100">Outros débitos operações com planos</th>
							<th width="100">Tributos e encargos à escolher</th>
							<th width="100">Depósitos de benef.Contrapres. seguros recebidos</th>
							<th width="100">Total</th>
							<th width="100">Prestadores serviço assist. saúde</th>
							<th width="100">Débitos com aquisição de carteira</th>
							<th width="100">Outros débitos a pagar</th>
							<th width="100">Total</th>							
						</tr>
					</thead>
					<tbody>
						@foreach($IdadeSaldoPassivo as $idadeSaldo)
							<tr{{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' id="passivo_'.$array_dias_passivo[$idadeSaldo->dias].'" class="info"' : '' }}>
								<td>{{ $array_dias_passivo[$idadeSaldo->dias] }}</td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->eventossus )  }}" name="eventossus_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->eventos ) }}" name="eventos_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->comercial ) }}" name="comercial_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->debOper ) }}" name="debOper_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->outrosDebOper ) }}" name="outrosDebOper_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->titulosencargos ) }}" name="titulosencargos_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->depBenConSegRec ) }}" name="depBenConSegRec_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( ( $idadeSaldo->eventossus + $idadeSaldo->eventos + $idadeSaldo->comercial + $idadeSaldo->debOper + $idadeSaldo->outrosDebOper + $idadeSaldo->titulosencargos + $idadeSaldo->depBenConSegRec) ) }}" name="tot_deb_opr_pls_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" readonly="readonly" /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->prestServAS ) }}" name="prestServAS_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->depAquisCarre ) }}" name="depAquisCarre_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->outrosDebPagar ) }}" name="outrosDebPagar_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias_passivo[$idadeSaldo->dias] == 'Subtotal') || ($array_dias_passivo[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} /></td>
								<td class="text-right"><input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->prestServAS + $idadeSaldo->depAquisCarre + $idadeSaldo->outrosDebPagar ) }}" name="tot_outros_deb_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" readonly="readonly" /></td>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>

			<!-- ativo tab -->
			<div class="tab-pane table-responsive" id="tab-ativos">
				<table id="idadesaldosativo" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th width="100">Vencimento</th>
							<th colspan="2">Planos Individuais/Familiares mensalidades (Pessoa Física)</th>
							<th colspan="2">Planos Coletivos Faturas (Pessoa Jurídica)</th>
							<th colspan="6"></th>
						</tr>
						<tr>
							<th width="100"></th>
							<th width="100">Preço pré-estabelecido</th>
							<th width="100">Preço pós-estabelecido</th>
							<th width="100">Preço pré-estabelecido</th>
							<th width="100">Preço pós-estabelecido</th>
							<th width="100">Créditos de Operações de administração de benefícios</th>
							<th width="100">Participação beneficiários Eventos/Sinistros</th>
							<th width="100">Créditos Operadoras</th>
							<th width="100">Outros créditos Operações com planos</th>
							<th width="100">Total</th>
							<th width="100">Outros Créditos Não relacionados com planos</th>							
						</tr>
					</thead>
					<tbody>
						@foreach($IdadeSaldoAtivo as $idadeSaldo)
							<tr{{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' id="ativo_'.$array_dias[$idadeSaldo->dias].'" class="info"' : '' }}>
								<td class="text-right">{{ $array_dias[$idadeSaldo->dias] }}</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->individualPre) }}"  name="individualPre_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->individualPos) }}"  name="individualPos_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->coletivoPre) }}"  name="coletivoPre_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->coletivoPos) }}"  name="coletivoPos_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->taxaAdm) }}"  name="taxaAdm_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->partBenefES) }}"  name="partBenefES_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->credOper) }}"  name="credOper_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->outrosCredComPlano) }}"  name="outrosCredComPlano_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( ( $idadeSaldo->individualPre + $idadeSaldo->individualPos + $idadeSaldo->coletivoPre + $idadeSaldo->coletivoPos + $idadeSaldo->taxaAdm + $idadeSaldo->outrosCredComPlano + $idadeSaldo->partBenefES + $idadeSaldo->credOper ) ) }}" readonly="readonly"  name="tot_ativo_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right"  />	</td>	
								<td class="text-right"> <input type="text" style="width:130px" value="{{ DataFormat::moneyBR( $idadeSaldo->outrosCredSemPlano ) }}"  name="outrosCredSemPlano_{{ $idadeSaldo->id }}" class="form-control idadesaldoativo_frm moeda text-right" {{ ($array_dias[$idadeSaldo->dias] == 'Subtotal') || ($array_dias[$idadeSaldo->dias] == 'SALDO') ? ' readonly="readonly"' : '' }} />	</td>
							</tr>						
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

<script type="text/javascript">
function num(num){
	num = num.replace('.','');
	return Number( num.replace(',','.') );
}

function somaTotPassivos(id){

	var tot_deb_opr_pls = ( num( $('input[name="eventossus_'+id+'"]').val() )+num( $('input[name="eventos_'+id+'"]').val() )+num( $('input[name="comercial_'+id+'"]').val() )+num( $('input[name="debOper_'+id+'"]').val() )+num( $('input[name="outrosDebOper_'+id+'"]').val() )+num( $('input[name="titulosencargos_'+id+'"]').val() )+num( $('input[name="depBenConSegRec_'+id+'"]').val( )) );
	
	var tot_outros_deb = (num( $('input[name="prestServAS_'+id+'"]').val() ) +num( $('input[name="depAquisCarre_'+id+'"]').val() ) +num( $('input[name="outrosDebPagar_'+id+'"]').val( ) ) );
	
	tot_deb_opr_pls = tot_deb_opr_pls.toFixed(2).toString();
	tot_outros_deb = tot_outros_deb.toFixed(2).toString();

	tot_deb_opr_pls = tot_deb_opr_pls.replace('.',',');
	tot_outros_deb = tot_outros_deb.replace('.',',');

	$('input[name="tot_deb_opr_pls_'+id+'"]').val(tot_deb_opr_pls);
	$('input[name="tot_outros_deb_'+id+'"]').val(tot_outros_deb);
	
	
}

function somaTotAtivos(id){

	var tot_ativo = ( num( $('input[name="individualPre_'+id+'"]').val() )+num( $('input[name="individualPos_'+id+'"]').val() )+num( $('input[name="coletivoPre_'+id+'"]').val() )+num( $('input[name="coletivoPos_'+id+'"]').val() )+num( $('input[name="taxaAdm_'+id+'"]').val() )+num( $('input[name="partBenefES_'+id+'"]').val() )+num( $('input[name="credOper_'+id+'"]').val( ))+num( $('input[name="outrosCredComPlano_'+id+'"]').val( )) );
	
	
	tot_ativo = tot_ativo.toFixed(2).toString();

	tot_ativo = tot_ativo.replace('.',',');

	$('input[name="tot_ativo_'+id+'"]').val(tot_ativo);
	
	
}

</script>	
@stop

{{-- Onload --}}
@section('onload')
	$('.idadesaldoativo_frm').on('focus', function(){
		valor_atual = this.value;
	});

	$('.idadesaldoativo_frm').on('blur', function(){

		obj_atual = $('input[name="'+this.name+'"]');

		if(valor_atual != this.value){			
			
			$.ajax(
				{
				  url: "/admin/idadesaldos/alteravalor",
				  data: { name: this.name, valor: this.value }
				}
			)
			.done(function(resposta) {				
				obj_atual.parent().css('background-color','#84B352');
		    	obj_atual.parent().animate({
			            backgroundColor: "#fff"
			    }, 1500 );

			    // Atualiza Saldo e Subtotal
			    if(resposta.tipo=='passivo'){
			    	somaTotPassivos(resposta.id);
					$('input[name="'+resposta.campo+"_"+resposta.id_saldo+'"]').val(resposta.saldo);
				}else{
			    	somaTotAtivos(resposta.id);
					$('input[name="'+resposta.campo+"_"+resposta.id_saldo+'"]').val(resposta.saldo);
					$('input[name="'+resposta.campo+"_"+resposta.id_subtotal+'"]').val(resposta.subtotal);
				}
			    

			    // console.log(resposta);
		  	})
		  	.fail(function() {
		    	alert( "Erro ao salvar" );
		  	});
		}
	});
@stop