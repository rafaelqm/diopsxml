@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Responsáveis administration @stop
@section('author')Rafael Querino Moreira @stop
@section('description')Responsáveis administration @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}
			
			<div class="pull-right">
				<a href="{{{ URL::to('admin/resps/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Criar</a>
			</div>

		</h3>
	</div>

	<table id="resps" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-1">{{{ Lang::get('admin/resps/table.tipoPessoa') }}}</th>
				<th class="col-md-3">{{{ Lang::get('admin/resps/table.nome') }}}</th>
				<th class="col-md-3">{{{ Lang::get('admin/resps/table.cpfCnpj') }}}</th>
				<th class="col-md-1">{{{ Lang::get('admin/resps/table.tipo') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/resps/table.numRegistro') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		var oTable;
		$(document).ready(function() {
			oTable = $('#resps').dataTable( {
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
		        "sAjaxSource": "{{ URL::to('admin/resps/data') }}",
		        "fnDrawCallback": function ( oSettings ) {
	           		$(".iframe").colorbox({iframe:true, width:"90%", height:"90%"});
	     		}
			});
		});
	</script>
@stop