@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Balancete Trimestral administration @stop
@section('author')Rafael Querino Moreira @stop
@section('description')Balancete Trimestral administration @stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			{{{ $title }}}
			
			<div class="pull-right">
				<a href="{{{ URL::to('admin/balancetes/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Criar</a>
			</div>

		</h3>
		<div class="row">
			<span class="col-md-3"><label for="tipo_ativos"> 	<input id="tipo_ativos" type="radio"   name="tipo" value="A" {{ Session::get('tipo')=='A'?' checked="checked"':'' }} /> Ativos</label></span>
			<span class="col-md-3"><label for="tipo_passivos"> 	<input id="tipo_passivos" type="radio" name="tipo" value="P" {{ Session::get('tipo')=='P'?' checked="checked"':'' }} /> Passivo</label></span>
			<span class="col-md-3"><label for="tipo_receitas"> 	<input id="tipo_receitas" type="radio" name="tipo" value="R" {{ Session::get('tipo')=='R'?' checked="checked"':'' }} /> Receita</label></span>
			<span class="col-md-3"><label for="tipo_despesas"> 	<input id="tipo_despesas" type="radio" name="tipo" value="D" {{ Session::get('tipo')=='D'?' checked="checked"':'' }} /> Despesa</label></span>
		</div>
	</div>

	<table id="balancetes" class="table table-striped table-hover">
		<thead>
			<tr>
				<th class="col-md-2">{{{ Lang::get('admin/balancetes/table.conta') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/balancetes/table.descricao') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/balancetes/table.saldoAnterior') }}}</th>
				<th class="col-md-1">{{{ Lang::get('admin/balancetes/table.debito') }}}</th>
				<th class="col-md-1">{{{ Lang::get('admin/balancetes/table.credito') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/balancetes/table.saldoFinal') }}}</th>
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
		var oTable = null;
		var tipo_setado = null;

		function carregaTabela(){
			var t = '';
			if(tipo_setado != null){
				t = '/'+tipo_setado;
			}
			tipo_setado = null;
			oTable = $('#balancetes').dataTable( {
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
		        "sAjaxSource": "{{ URL::to('admin/balancetes/data') }}"+t,
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

			$('input[name="tipo"]').change(function(event) {
				tipo_setado = $(this).val();
				var t = '';
				if(tipo_setado != null){
					t = '/'+tipo_setado;
				}
				tipo_setado = null;

				oTable.fnReloadAjax("{{ URL::to('admin/balancetes/data') }}"+t);
			});
		});
	</script>
@stop