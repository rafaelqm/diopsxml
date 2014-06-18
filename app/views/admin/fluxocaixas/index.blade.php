@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')FluxoCaixa Trimestral administration @stop
@section('author')Rafael Querino Moreira @stop
@section('description')FluxoCaixa Trimestral administration @stop

{{-- Content --}}
<?php
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
$mes1 = $meses[ (substr(Session::get('trimestre'), 4,2) * 3 - 2) ];
$mes2 = $meses[ (substr(Session::get('trimestre'), 4,2) * 3 - 1) ];
$mes3 = $meses[ (substr(Session::get('trimestre'), 4,2) * 3 ) ];

?>
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}
			
			<div class="pull-right">
				<a href="{{{ URL::to('admin/fluxocaixas/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Criar</a>
			</div>

		</h3>
		
	</div>

	<table id="fluxocaixas" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-4">{{{ Lang::get('admin/fluxocaixas/table.descricao') }}}</th>
				<th class="col-md-2">{{ $mes1 }}</th>
				<th class="col-md-2">{{ $mes2 }}</th>
				<th class="col-md-2">{{ $mes3 }}</th>
				<th class="col-md-2"> Resultado trimestre </th>
				<!-- <th class="col-md-2">{{{ Lang::get('table.actions') }}}</th> -->
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable = null;
		var tipo_setado = null;

		function carregaTabela(){
			
			oTable = $('#fluxocaixas').dataTable( {
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
		        "sAjaxSource": "{{ URL::to('admin/fluxocaixas/data') }}",
				/*"oLanguage": {
                  "sUrl": "{{{ asset('assets/js/Portuguese-Brasil.json') }}}"
                },*/
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
	     		}
			});
		}

		$(document).ready(function() {
			carregaTabela();
			
		});
	</script>
@stop