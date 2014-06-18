@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
<script type="text/javascript">
var cont_tel = 0;

function removerTel(qual) {
	$("#tel"+qual).remove();
}
/*
trimestre






rede_propria
preco_unitario
valor_contabil
*/
</script>
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Dados da ativovinculado</a></li>
			<li><a href="#tab-endereco" data-toggle="tab">Endereço</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($ativovinculado)){{ URL::to('admin/ativovinculados/' . $ativovinculado->id . '/editar') }}@endif" >
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<div class="row">
					
					<!-- rgi -->
					<div class="form-group col-md-6 {{{ $errors->has('rgi') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="rgi">RGI</label>
							<input class="form-control" type="text" name="rgi" id="rgi" value="{{{ Input::old('rgi', isset($ativovinculado) ? $ativovinculado->rgi : null) }}}" />
							{{{ $errors->first('rgi', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ rgi -->

					<!-- tipo_bem_imobiliario -->
					<div class="form-group col-md-6 {{{ $errors->has('tipo_bem_imobiliario') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="tipo_bem_imobiliario">Tipo bem imobiliário</label>
							<select class="form-control" name="tipo_bem_imobiliario" id="tipo_bem_imobiliario">
								<option value="">Selecione...</option>
								<option value="3001" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3001' ? ' selected="selected" ': '' }} >Imóvel rede própria urbano</option>
								<option value="3002" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3002' ? ' selected="selected" ': '' }}>Imóvel não rede própria urbano</option>
								<option value="3003" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3003' ? ' selected="selected" ': '' }}>Imóvel rede própria rural</option>
								<option value="3004" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3004' ? ' selected="selected" ': '' }}>Imóvel não rede própria rural</option>
								<option value="3018" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3018' ? ' selected="selected" ': '' }}>Imóveis (Líquido de Depreciação)</option>
								<option value="3026" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3026' ? ' selected="selected" ': '' }}>Direitos Resultantes da Venda de Imóveis</option>
								<option value="3034" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3034' ? ' selected="selected" ': '' }}>Terrenos</option>
								<option value="3035" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3035' ? ' selected="selected" ': '' }}>Direitos Resultantes da Venda de Terrenos</option>
								<option value="3042" {{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) == '3042' ? ' selected="selected" ': '' }}>Quotas de Fundos de Invest Imobiliários</option>
							</select>
							<!--  value="{{{ Input::old('tipo_bem_imobiliario', isset($ativovinculado) ? $ativovinculado->tipo_bem_imobiliario : null) }}}" /> -->
							{{{ $errors->first('tipo_bem_imobiliario', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ tipo_bem_imobiliario -->

					

				</div>

				<!-- nome_cartorio -->
				<div class="form-group {{{ $errors->has('nome_cartorio') ? 'error' : '' }}}">
                    <div class="col-md-11">
                        <label class="control-label" for="nome_cartorio">Nome cartório</label>
						<input class="form-control" type="text" name="nome_cartorio" id="nome_cartorio" value="{{{ Input::old('nome_cartorio', isset($ativovinculado) ? $ativovinculado->nome_cartorio : null) }}}" />
						{{{ $errors->first('nome_cartorio', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ nome_cartorio -->

				<!-- area_imovel -->
				<div class="form-group {{{ $errors->has('area_imovel') ? 'error' : '' }}}">
                    <div class="col-md-11">
                        <label class="control-label" for="area_imovel">Área</label>
						<input class="form-control" type="text" name="area_imovel" id="area_imovel" value="{{{ Input::old('area_imovel', isset($ativovinculado) ? DataFormat::moneyBR( $ativovinculado->area_imovel ) : null) }}}" />
						{{ $errors->first('area_imovel', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ area_imovel -->

				<div class="row">
					
					<!-- data_aquisicao -->
					<div class="form-group col-md-4 {{{ $errors->has('data_aquisicao') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="data_aquisicao">Data Aquisição</label>
							<input class="form-control" type="text" name="data_aquisicao" id="data_aquisicao" value="{{{ Input::old('data_aquisicao', isset($ativovinculado) ? DataFormat::makeBR(  $ativovinculado->data_aquisicao ) : null) }}}" />
							{{{ $errors->first('data_aquisicao', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ data_aquisicao -->

					<!-- data_venda -->
					<div class="form-group col-md-4 {{{ $errors->has('data_venda') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="data_venda">Data Venda</label>
							<input class="form-control" type="text" name="data_venda" id="data_venda" value="{{{ Input::old('data_venda', isset($ativovinculado) ? DataFormat::makeBR( $ativovinculado->data_venda ) : null) }}}" />
							{{{ $errors->first('data_venda', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ data_venda -->

					<!-- data_avaliacao -->
					<div class="form-group col-md-4 {{{ $errors->has('data_avaliacao') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="data_avaliacao">Data Avaliação</label>
							<input class="form-control" type="text" name="data_avaliacao" id="data_avaliacao" value="{{{ Input::old('data_avaliacao', isset($ativovinculado) ? DataFormat::makeBR( $ativovinculado->data_avaliacao ) : null) }}}" />
							{{{ $errors->first('data_avaliacao', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ data_avaliacao -->



				</div>
				
				<div class="row">

					<!-- rede_propria -->
					<div class="form-group col-md-4 {{ $errors->has('rede_propria') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="rede_propria">Rede própria</label>
							<select class="form-control" type="text" name="rede_propria" id="rede_propria">
								<option value="">Selecione</option>
								<option value="Sim" {{ Input::old('rede_propria', isset($admin) ? $admin->rede_propria : 'Sim') == 'Sim' ? ' selected="selected" ': '' }} >Sim</option>
								<option value="Não" {{ Input::old('rede_propria', isset($admin) ? $admin->rede_propria : null) == 'Não' ? ' selected="selected" ': '' }} >Não</option>
							</select> 
						</div>
					</div>
					<!-- ./ rede_propria -->

					<!-- preco_unitario -->
					<div class="form-group col-md-4 {{ $errors->has('preco_unitario') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="preco_unitario">Preço unitário</label>
							<input class="form-control" type="text" name="preco_unitario" id="preco_unitario" value="{{{ Input::old('preco_unitario', isset($ativovinculado) ? DataFormat::moneyBR( $ativovinculado->preco_unitario ) : null) }}}" />
							{{{ $errors->first('preco_unitario', '<span class="help-block">:message</span>') }}}							
							</select> 
						</div>
					</div>
					<!-- ./ preco_unitario -->

					<!-- valor_contabil -->
					<div class="form-group col-md-4 {{ $errors->has('valor_contabil') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="valor_contabil">Valor Contábil</label>
							<input class="form-control" type="text" name="valor_contabil" id="valor_contabil" value="{{{ Input::old('valor_contabil', isset($ativovinculado) ? DataFormat::moneyBR( $ativovinculado->valor_contabil ) : null) }}}" />
							{{{ $errors->first('valor_contabil', '<span class="help-block">:message</span>') }}}							
							</select> 
						</div>
					</div>
					<!-- ./ valor_contabil -->

				</div>		
				
			</div>
			<!-- ./ general tab -->
			
			<!-- tab-endereco -->
			<div class="tab-pane" id="tab-endereco">

				<div class="row">

					<!-- logradouro  -->
					<div class="form-group col-md-9 {{{ $errors->has('logradouro') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="logradouro">Logradouro</label>
							<input class="form-control" type="text" required="required" name="logradouro" id="logradouro" value="{{ Input::old('logradouro', isset($ativovinculado) ? $ativovinculado->enderecoAtual->logradouro : null) }}" />
							{{{ $errors->first('logradouro', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ logradouro -->

					<!-- numLogradouro  -->
					<div class="form-group col-md-3 {{{ $errors->has('numLogradouro') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="numLogradouro">Número</label>
							<input class="form-control" required="required" type="text" name="numLogradouro" id="numLogradouro" value="{{{ Input::old('numLogradouro', isset($ativovinculado) ? $ativovinculado->enderecoAtual->numLogradouro : null) }}}" />
							{{{ $errors->first('numLogradouro', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ numLogradouro -->

				</div>

				<div class="row">

					<!-- complemento  -->
					<div class="form-group col-md-6 {{{ $errors->has('complemento') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="complemento">Complemento</label>
							<input class="form-control" type="text" name="complemento" id="complemento" value="{{{ Input::old('complemento', isset($ativovinculado) ? $ativovinculado->enderecoAtual->complemento : null) }}}" />
							{{{ $errors->first('complemento', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ complemento -->

					<!-- cep  -->
					<div class="form-group col-md-6 {{{ $errors->has('cep') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="cep">CEP</label>
							<input class="form-control" required="required" type="text" name="cep" id="cep" value="{{{ Input::old('cep', isset($ativovinculado) ? $ativovinculado->enderecoAtual->cep : null) }}}" />
							{{{ $errors->first('cep', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ cep -->

				</div>

				<!-- bairro  -->
				<div class="form-group {{{ $errors->has('bairro') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="bairro">Bairro</label>
						<input class="form-control" type="text" required="required" name="bairro" id="bairro" value="{{{ Input::old('bairro', isset($ativovinculado) ? $ativovinculado->enderecoAtual->bairro : null) }}}" />
						{{{ $errors->first('bairro', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ bairro -->

				<div class="row">

					<!-- siglaUF  -->
					<div class="form-group col-md-5 {{{ $errors->has('siglaUF') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="siglaUF">Estado</label>
							<select class="form-control" required="required" name="siglaUF" id="siglaUF">
							 <option value="" >Selecione</option>
							 @foreach( $estados as $uf => $estado)
							 	<option value="{{ $uf }}" {{ Input::old('siglaUF', isset($ativovinculado) ? $ativovinculado->enderecoAtual->siglaUF : null) == $uf ? ' selected="selected" ': '' }} >{{ $estado }}</option>
							 @endforeach

							</select>
							{{{ $errors->first('siglaUF', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ siglaUF -->

					<!-- municipioIBGE  -->
					<div class="form-group col-md-7 {{{ $errors->has('municipioIBGE') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="municipioIBGE">Cidade</label>
							<select class="form-control" required="required" name="municipioIBGE" id="municipioIBGE">
							@if( Input::old('municipioIBGE') )	
								<option value="{{ Input::old('municipioIBGE') }}">{{ Municipio::where('municipioIBGE','=', Input::old('municipioIBGE') )->first() ? Municipio::where('municipioIBGE','=', Input::old('municipioIBGE') )->first()->descricao : '-' }}</option>
							@else
								@if(!isset($ativovinculado))
									<option>-</option>
								@else
									<option value="{{ $ativovinculado->enderecoAtual->municipioIBGE }}">{{ $ativovinculado->enderecoAtual->municipio->descricao }}</option>
								@endif
							@endif
							</select>
							{{{ $errors->first('municipioIBGE', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ municipioIBGE -->

				</div>


			</div>
			<!-- ./ tab-endereco -->
			
		




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
	$('#btAddTel').on( "click", function() {		
		cont_tel++;
		var rowtel = '<div class="row" id="tel'+cont_tel+'">												<span class="form-group col-md-1">							<label class="control-label" for="codigoDDI">DDI</label>							<input class="form-control" type="text" name="telefones['+cont_tel+'][codigoDDI]" id="codigoDDI" value="55" />						</span>						<span class="form-group col-md-1" style="margin-left:5px;">							<label class="control-label" for="codigoDDD">DDD</label>							<input class="form-control" type="text" name="telefones['+cont_tel+'][codigoDDD]" id="codigoDDD" maxlength="2"  />						</span>						<span class="form-group col-md-4" style="margin-left:5px;">							<label class="control-label" for="numeroTel">Número</label>							<input class="form-control" type="text" name="telefones['+cont_tel+'][numeroTel]" id="numeroTel" />						</span>																		<span class="form-group col-md-2" style="margin-left:5px;">							<label class="control-label" for="ramal">Ramal</label>							<input class="form-control" type="text" name="telefones['+cont_tel+'][ramal]" id="ramal" />						</span>						<span class="form-group col-md-1" style="margin-left:5px;">							<button class="btn btn-danger" style="margin-top: 27px;" onclick="removerTel('+cont_tel+')">Remover</button>						</span>											</div>';
	
	  $('#telefones').append(rowtel);
	});

	$('#siglaUF').change(function(){
		
		$.ajax({
		  dataType: "json",
		  url: '/cidades/'+$( this ).val()
		}).done(function(retorno) {
			var optionsCidades = '<option value="">Escolha</option>';
			$('#municipioIBGE').empty();
			$.each(retorno, function(ibgeCod, descricao){
				optionsCidades = optionsCidades + '<option value="'+ibgeCod+'">'+descricao+'</option>';
			});
			$('#municipioIBGE').html(optionsCidades);
		})
		.fail(function() {
			alert( "error" );
		});

	});

	$('#siglaUFCorrespondencia').change(function(){
		
		$.ajax({
		  dataType: "json",
		  url: '/cidades/'+$( this ).val()
		}).done(function(retorno) {
			var optionsCidades = '<option value="">Escolha</option>';
			$('#municipioIBGECorrespondencia').empty();
			$.each(retorno, function(ibgeCod, descricao){
				optionsCidades = optionsCidades + '<option value="'+ibgeCod+'">'+descricao+'</option>';
			});
			$('#municipioIBGECorrespondencia').html(optionsCidades);
		})
		.fail(function() {
			alert( "error" );
		});

	});
	
@stop