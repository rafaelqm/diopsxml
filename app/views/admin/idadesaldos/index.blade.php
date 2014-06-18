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
	<div class="page-header">
		<h3>
			{{{ $title }}}
			
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
				<table id="idadesaldos" class="table table-bordered table-striped table-hover">
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
					</tbody>
				</table>

			</div>

			<!-- ativo tab -->
			<div class="tab-pane table-responsive" id="tab-ativos">
				<table id="idadesaldos" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th colspan="2">Planos Individuais/Familiares mensalidades (Pessoa Física)</th>
							<th colspan="2">Planos Coletivos Faturas (Pessoa Jurídica)</th>
							<th colspan="6"></th>
						</tr>
						<tr>
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
					</tbody>
				</table>
			</div>
		</div>

	
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		/*var oTable = null;
		var tipo_setado = null;

		function carregaTabela(){
			var t = '';
			if(tipo_setado != null){
				t = '/'+tipo_setado;
			}
			tipo_setado = null;
			oTable = $('#idadesaldos').dataTable( {
				"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>",
				"sPaginationType": "bootstrap",
				"oLanguage": {
					"sEmptyTable":     "Nenhum registro encontrado na tabela",
					"sInfo": "Mostrar _START_ até _END_ do _TOTAL_ registros",
					"sInfoEmpty": "Mostrar 0 até 0 de 0 Registros",
					"sInfoFiltered": "(Filtrar de _MAX_ total registros)",
					"sInfoPostFix":    "",
					"sInfoThousands":  ".",
					"sLengthMenu": "Mostrar _MENU_ registros por pagina",
					"sLoadingRecords": "Carregando...",
					"sProcessing":     "Processando...",
					"sZeroRecords": "Nenhum registro encontrado",
					"sSearch": "Pesquisar",
					"oPaginate": {
						"sNext": "Proximo",
						"sPrevious": "Anterior",
						"sFirst": "Primeiro",
						"sLast":"Ultimo"
					},
					"oAria": {
						"sSortAscending":  ": Ordenar colunas de forma ascendente",
						"sSortDescending": ": Ordenar colunas de forma descendente"
					}
				},
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{ URL::to('admin/idadesaldos/data') }}"+t,
				
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
	     		}
			});
		}

		$(document).ready(function() {
			carregaTabela();

			$('input[name="tipo"]').change(function(event) {
				tipo_setado = $(this).val();
				var t = '';
				if(tipo_setado != null){
					t = '/'+tipo_setado;
				}
				tipo_setado = null;

				oTable.fnReloadAjax("{{ URL::to('admin/idadesaldos/data') }}"+t);
			});
		});*/
	</script>
@stop