@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
<script type="text/javascript">
var cont_tel = 0;

function removerTel(qual) {
	$("#tel"+qual).remove();
}
</script>
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Dados da representante</a></li>
			<li><a href="#tab-endereco" data-toggle="tab">Endereço</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($representante)){{ URL::to('admin/representantes/' . $representante->id . '/editar') }}@endif" >
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<div class="row">
					
					<!-- CPF -->
					<div class="form-group col-md-6 {{{ $errors->has('CPF') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="CPF">CPF</label>
							<input class="form-control" type="text" name="CPF" id="CPF" value="{{{ Input::old('CPF', isset($representante) ? $representante->CPF : null) }}}" />
							{{{ $errors->first('CPF', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ CPF -->

					

				</div>
				<!-- nome -->
				<div class="form-group {{{ $errors->has('nome') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="nome">Nome</label>
						<input class="form-control" type="text" name="nome" id="nome" value="{{{ Input::old('nome', isset($representante) ? $representante->nome : null) }}}" />
						{{{ $errors->first('nome', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ nome -->

				<!-- email -->
				<div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="email">E-Mail</label>
						<input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', isset($representante) ? $representante->email : null) }}}" />
						{{ $errors->first('email', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ email -->

				<div class="row">
					
					<!-- RG -->
					<div class="form-group col-md-4 {{{ $errors->has('RG') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="RG">RG</label>
							<input class="form-control" type="text" name="RG" id="RG" value="{{{ Input::old('RG', isset($representante) ? $representante->RG : null) }}}" />
							{{{ $errors->first('RG', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ RG -->

					<!-- dataExpedicao -->
					<div class="form-group col-md-4 {{{ $errors->has('dataExpedicao') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="dataExpedicao">Data Expedição</label>
							<input class="form-control" type="text" name="dataExpedicao" id="dataExpedicao" value="{{{ Input::old('dataExpedicao', isset($representante) ? $representante->dataExpedicao : null) }}}" />
							{{{ $errors->first('dataExpedicao', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ dataExpedicao -->

					<!-- orgaoExpeditor -->
					<div class="form-group col-md-4 {{{ $errors->has('orgaoExpeditor') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="orgaoExpeditor">Órgão Expeditor</label>
							<input class="form-control" type="text" name="orgaoExpeditor" id="orgaoExpeditor" value="{{{ Input::old('orgaoExpeditor', isset($representante) ? $representante->orgaoExpeditor : null) }}}" />
							{{{ $errors->first('orgaoExpeditor', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ orgaoExpeditor -->



				</div>
				
				<!-- cargo -->
				<div class="form-group {{ $errors->has('cargo') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="cargo">Cargo</label>
						<select class="form-control" type="text" name="cargo" id="cargo">
							<option value="">Selecione</option>
							@foreach( $cargos as $id => $cargo)
							 	<option value="{{ $id }}" {{ Input::old('cargo', isset($admin) ? $admin->cargo : null) == $id ? ' selected="selected" ': '' }} >{{ $cargo }}</option>
							@endforeach
						</select> 
					</div>
				</div>
				<!-- ./ cargo -->

				<!-- pais -->
				<div class="form-group {{ $errors->has('pais') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="pais">País</label>
						<select class="form-control" type="text" name="pais" id="pais">
							<option value="">Selecione</option>
							<option value="32" selected="selected" >Brasil</option>
							
						</select> 
					</div>
				</div>
				<!-- ./ pais -->

				<!-- tipoRepresentante -->
				<div class="form-group {{{ $errors->has('tipoRepresentante') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="tipoRepresentante">Tipo representante</label>
						<select class="form-control" type="text" name="tipoRepresentante" id="tipoRepresentante">
								<option value="RN117" 	{{ Input::old('tipoRepresentante', isset($representante) ? $representante->tipoRepresentante : 'RN117') == 'RN117' ? 'selected="selected"':'' }}>RN117</option>
								<option value="ANS" 	{{ Input::old('tipoRepresentante', isset($representante) ? $representante->tipoRepresentante : '') == 'ANS' ? 'selected="selected"':'' }}>ANS</option>
						</select> 
						{{ $errors->first('tipoRepresentante', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ tipoRepresentante -->

				<div class="row" id="telefones">
					<h4>Telefones</h4>

					<input type="hidden" name="tabela" value="representantes" />
					<input type="hidden" name="tabela_id" value="{{ isset($representante) ? $representante->id : null }}" />

					<span class="pull-right"> <a name="btAddTel" class="btn btn-info" id="btAddTel">Adicionar</a> </span>
					<?php
					$telefones = null;

					if( Input::old('telefones') ){
						$telefones = Input::old('telefones');
					}else{

						if(isset($representante)){
							if( $representante->telefones()->where('tabela','=','representantes')->get() ){
								$telefones = $representante->telefones;
							}

						}
					}
					if($telefones){

							$cont_tel = 0;
							foreach ($telefones as $telefone) {
								$cont_tel++;
								?>
								<div class="row" id="tel{{$cont_tel}}">
									
									<span class="form-group col-md-1">
										<label class="control-label" for="codigoDDI">DDI</label>
										<input class="form-control" type="text" name="telefones[{{ $cont_tel }}][codigoDDI]" id="codigoDDI" value="{{ $telefone['codigoDDI'] }}" />
									</span>

									<span class="form-group col-md-1" style="margin-left:5px;">
										<label class="control-label" for="codigoDDD">DDD</label>
										<input class="form-control" type="text" name="telefones[{{ $cont_tel }}][codigoDDD]" id="codigoDDD" value="{{ $telefone['codigoDDD'] }}" maxlength="2" />
									</span>

									<span class="form-group col-md-4" style="margin-left:5px;">
										<label class="control-label" for="numeroTel">Número</label>
										<input class="form-control" type="text" name="telefones[{{ $cont_tel }}][numeroTel]" id="numeroTel" value="{{ $telefone['numeroTel'] }}" />
									</span>
									
									
									<span class="form-group col-md-2" style="margin-left:5px;">
										<label class="control-label" for="ramal">Ramal</label>
										<input class="form-control" type="text" name="telefones[{{ $cont_tel }}][ramal]" id="ramal" value="{{ $telefone['ramal'] }}" />
									</span>

									<span class="form-group col-md-1" style="margin-left:5px;">
										<button class="btn btn-danger" style="margin-top: 27px;" onclick="removerTel({{$cont_tel}})">Remover</button>
									</span>
									
								</div>
								<?php
							}
							echo "<script>cont_tel = ".$cont_tel.";</script>";
						
					}
					?>
					

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
							<input class="form-control" type="text" required="required" name="logradouro" id="logradouro" value="{{ Input::old('logradouro', isset($representante) ? $representante->enderecoAtual->logradouro : null) }}" />
							{{{ $errors->first('logradouro', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ logradouro -->

					<!-- numLogradouro  -->
					<div class="form-group col-md-3 {{{ $errors->has('numLogradouro') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="numLogradouro">Número</label>
							<input class="form-control" required="required" type="text" name="numLogradouro" id="numLogradouro" value="{{{ Input::old('numLogradouro', isset($representante) ? $representante->enderecoAtual->numLogradouro : null) }}}" />
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
							<input class="form-control" type="text" name="complemento" id="complemento" value="{{{ Input::old('complemento', isset($representante) ? $representante->enderecoAtual->complemento : null) }}}" />
							{{{ $errors->first('complemento', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ complemento -->

					<!-- cep  -->
					<div class="form-group col-md-6 {{{ $errors->has('cep') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="cep">CEP</label>
							<input class="form-control" required="required" type="text" name="cep" id="cep" value="{{{ Input::old('cep', isset($representante) ? $representante->enderecoAtual->cep : null) }}}" />
							{{{ $errors->first('cep', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ cep -->

				</div>

				<!-- bairro  -->
				<div class="form-group {{{ $errors->has('bairro') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="bairro">Bairro</label>
						<input class="form-control" type="text" required="required" name="bairro" id="bairro" value="{{{ Input::old('bairro', isset($representante) ? $representante->enderecoAtual->bairro : null) }}}" />
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
							 	<option value="{{ $uf }}" {{ Input::old('siglaUF', isset($representante) ? $representante->enderecoAtual->siglaUF : null) == $uf ? ' selected="selected" ': '' }} >{{ $estado }}</option>
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
								@if(!isset($representante))
									<option>-</option>
								@else
									<option value="{{ $representante->enderecoAtual->municipioIBGE }}">{{ $representante->enderecoAtual->municipio->descricao }}</option>
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