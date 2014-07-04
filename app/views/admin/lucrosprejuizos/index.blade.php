@extends('admin.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

@section('keywords')Lucros e Prejuizos Trimestral administration @stop
@section('author')Rafael Querino Moreira @stop
@section('description')Lucros e Prejuizos Trimestral administration @stop

{{-- Content --}}
@section('content')
<script type="text/javascript">
	var obj_atual = null;
	var valor_atual = 0;
</script>

	<div class="page-header">
		<h3>
			{{ $title }}
			
			<!-- <div class="pull-right">
				<a href="{{{ URL::to('admin/lucrosprejuizos/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Criar</a>
			</div> -->

		</h3>
		
	</div>

	
	<table id="lucrosprejuizospassivo" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th width="70%">Descrição</th>
				<th>Valor</th>
			</tr>
			
		</thead>
		<tbody>
			@foreach($LucrosPrejuizos as $LucrosPrejuizo)
				<tr{{ ( $LucrosPrejuizo->conta == 'TOTAL') ? ' id="total_'.$LucrosPrejuizo->id.'" class="info"' : '' }}>
					<td>{{ $LucrosPrejuizo->descricao }}</td>
					<td><input type="text" value="{{ DataFormat::moneyBR( $LucrosPrejuizo->valor )  }}" name="valor_{{ $LucrosPrejuizo->id }}" class="form-control LucrosPrejuizos_frm moeda text-right" {{ ($LucrosPrejuizo->conta == 'TOTAL')  ? ' readonly="readonly"' : '' }} /></td>
				</tr>
			@endforeach
		</tbody>
	</table>

			

	
@stop

{{-- Onload --}}
@section('onload')
	$('.LucrosPrejuizos_frm').on('focus', function(){
		valor_atual = this.value;
	});

	$('.LucrosPrejuizos_frm').on('blur', function(){

		obj_atual = $('input[name="'+this.name+'"]');

		if(valor_atual != this.value){			
			
			$.ajax(
				{
				  url: "/admin/lucrosprejuizos/alteravalor",
				  data: { name: this.name, valor: this.value }
				}
			)
			.done(function(resposta) {				
				obj_atual.parent().css('background-color','#84B352');
		    	obj_atual.parent().animate({
			            backgroundColor: "#fff"
			    }, 1500 );

			    // Atualiza total
			    
				$('input[name="valor_'+resposta.id_total+'"]').val(resposta.total);
				
			    

		  	})
		  	.fail(function() {
		    	alert( "Erro ao salvar" );
		  	});
		}
	});
@stop