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
			<li class="active"><a href="#tab-general" data-toggle="tab">Dados da operadora</a></li>
			<li><a href="#tab-endereco-matriz" data-toggle="tab">Endereço Matriz</a></li>
			<li><a href="#tab-endereco-corresp" data-toggle="tab">Endereço Correspondência</a></li>
			<li><a href="#tab-enquadramento" data-toggle="tab">Enquadramento da empresa</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($operadora)){{ URL::to('admin/operadoras/' . $operadora->id . '/editar') }}@endif" >
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<div class="row">

					<!-- registroANS -->
					<div class="form-group col-md-6 {{{ $errors->has('registroANS') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="registroANS">Registro ANS</label>
							<input class="form-control" type="text" name="registroANS" id="registroANS" value="{{{ Input::old('registroANS', isset($operadora) ? $operadora->registroANS : null) }}}" />
							{{{ $errors->first('registroANS', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ registroANS -->

					<!-- CNPJ -->
					<div class="form-group col-md-6 {{{ $errors->has('CNPJ') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="CNPJ">CNPJ</label>
							<input class="form-control" type="text" name="CNPJ" id="CNPJ" value="{{{ Input::old('CNPJ', isset($operadora) ? $operadora->CNPJ : null) }}}" />
							{{{ $errors->first('CNPJ', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ CNPJ -->

				</div>


				<!-- razaoSocial -->
				<div class="form-group {{{ $errors->has('razaoSocial') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="razaoSocial">Razão Social</label>
						<input class="form-control" type="text" name="razaoSocial" id="razaoSocial" value="{{{ Input::old('razaoSocial', isset($operadora) ? $operadora->razaoSocial : null) }}}" />
						{{{ $errors->first('razaoSocial', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ razaoSocial -->

				<!-- nomeFantasia -->
				<div class="form-group {{{ $errors->has('nomeFantasia') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="nomeFantasia">Nome Fantasia</label>
						<input class="form-control" type="text" name="nomeFantasia" id="nomeFantasia" value="{{{ Input::old('nomeFantasia', isset($operadora) ? $operadora->nomeFantasia : null) }}}" />
						{{{ $errors->first('nomeFantasia', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ nomeFantasia -->

				<!-- eMail -->
				<div class="form-group {{{ $errors->has('eMail') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="eMail">E-Mail</label>
						<input class="form-control" type="text" name="eMail" id="eMail" value="{{{ Input::old('eMail', isset($operadora) ? $operadora->eMail : null) }}}" />
						{{ $errors->first('eMail', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ eMail -->

				<div class="row" id="telefones">
					<h4>Telefones</h4>

					<input type="hidden" name="tabela" value="operadoras" />
					<input type="hidden" name="tabela_id" value="{{ isset($operadora) ? $operadora->id : null }}" />

					<span class="pull-right"> <a name="btAddTel" class="btn btn-info" id="btAddTel">Adicionar</a> </span>
					<?php
					$telefones = null;

					if( Input::old('telefones') ){
						$telefones = Input::old('telefones');
					}else{

						if(isset($operadora)){
							if( $operadora->telefones()->where('tabela','=','operadoras')->get() ){
								$telefones = $operadora->telefones;
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

			<!-- tab-endereco-matriz -->
			<div class="tab-pane" id="tab-endereco-matriz">

				<div class="row">

					<!-- logradouro  -->
					<div class="form-group col-md-9 {{{ $errors->has('logradouro') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="logradouro">Logradouro</label>
							<input class="form-control" type="text" required="required" name="logradouroMatriz" id="logradouro" value="{{{ Input::old('logradouroMatriz', isset($operadora) ? $operadora->enderecoMatriz->logradouro : null) }}}" />
							{{{ $errors->first('logradouro', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ logradouro -->

					<!-- numLogradouro  -->
					<div class="form-group col-md-3 {{{ $errors->has('numLogradouro') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="numLogradouro">Número</label>
							<input class="form-control" required="required" type="text" name="numLogradouroMatriz" id="numLogradouro" value="{{{ Input::old('numLogradouroMatriz', isset($operadora) ? $operadora->enderecoMatriz->numLogradouro : null) }}}" />
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
							<input class="form-control" type="text" name="complementoMatriz" id="complemento" value="{{{ Input::old('complementoMatriz', isset($operadora) ? $operadora->enderecoMatriz->complemento : null) }}}" />
							{{{ $errors->first('complemento', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ complemento -->

					<!-- cep  -->
					<div class="form-group col-md-6 {{{ $errors->has('cep') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="cep">CEP</label>
							<input class="form-control" required="required" type="text" name="cepMatriz" id="cep" value="{{{ Input::old('cepMatriz', isset($operadora) ? $operadora->enderecoMatriz->cep : null) }}}" />
							{{{ $errors->first('cep', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ cep -->

				</div>

				<!-- bairro  -->
				<div class="form-group {{{ $errors->has('bairro') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="bairro">Bairro</label>
						<input class="form-control" type="text" required="required" name="bairroMatriz" id="bairro" value="{{{ Input::old('bairroMatriz', isset($operadora) ? $operadora->enderecoMatriz->bairro : null) }}}" />
						{{{ $errors->first('bairro', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ bairro -->

				<div class="row">

					<!-- siglaUF  -->
					<div class="form-group col-md-5 {{{ $errors->has('siglaUF') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="siglaUF">Estado</label>
							<select class="form-control" required="required" name="siglaUFMatriz" id="siglaUFMatriz">
							 <option value="" >Selecione</option>
							 @foreach( $estados as $uf => $estado)
							 	<option value="{{ $uf }}" {{ Input::old('siglaUFMatriz', isset($operadora) ? $operadora->enderecoMatriz->siglaUF : null) == $uf ? ' selected="selected" ': '' }} >{{ $estado }}</option>
							 @endforeach

							</select>
							{{{ $errors->first('siglaUF', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ siglaUF -->

					<!-- municipioIBGE  -->
					<div class="form-group col-md-7 {{{ $errors->has('municipioIBGE') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="municipioIBGEMatriz">Cidade</label>
							<select class="form-control" required="required" name="municipioIBGEMatriz" id="municipioIBGEMatriz">
							@if( Input::old('municipioIBGEMatriz') )	
								<option value="{{ Input::old('municipioIBGEMatriz') }}">{{ Municipio::where('municipioIBGE','=', Input::old('municipioIBGEMatriz') )->first() ? Municipio::where('municipioIBGE','=', Input::old('municipioIBGEMatriz') )->first()->descricao : '-' }}</option>
							@else
								@if(!isset($operadora))
									<option>-</option>
								@else
									<option value="{{ $operadora->enderecoMatriz->municipioIBGE }}">{{ $operadora->enderecoMatriz->municipio->descricao }}</option>
								@endif
							@endif
							</select>
							{{{ $errors->first('municipioIBGE', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ municipioIBGE -->

				</div>


			</div>
			<!-- ./ tab-endereco-matriz -->
			
			<!-- tab-endereco-corresp -->
			<div class="tab-pane" id="tab-endereco-corresp">

				<div class="row">
					<label class="control-label">Endereço igual o da matriz <input name="enderecoIgualMatriz" type="checkbox" value="1" id="enderecoIgualMatriz" {{ Input::old('enderecoIgualMatriz', isset($operadora) ? ($operadora->endereco_matriz == $operadora->endereco_corresp ? 1 : 0 ) : 0) == 1 ? 'checked="checked"' : '' }} /> </label>
				</div>

				<div id="enderecoCorrespondencia"  {{ Input::old('enderecoIgualMatriz', isset($operadora) ? ($operadora->endereco_matriz == $operadora->endereco_corresp ? 1 : 0 ) : 0) == 1 ?  'style="display:none"' : '' }} >

					<div class="row">

						<!-- logradouro  -->
						<div class="form-group col-md-9 {{{ $errors->has('logradouroCorrespondencia') ? 'error' : '' }}}">
							<div class="col-md-12">
		                        <label class="control-label" for="logradouroCorrespondencia">Logradouro</label>
								<input class="form-control" type="text" name="logradouroCorrespondencia" id="logradouroCorrespondencia" value="{{{ Input::old('logradouroCorrespondencia', isset($operadora) ? $operadora->enderecoCorresp->logradouro : null) }}}" />
								{{{ $errors->first('logradouro', '<span class="help-block">:message</span>') }}}
							</div>
						</div>
						<!-- ./ logradouro -->

						<!-- numLogradouro  -->
						<div class="form-group col-md-3 {{{ $errors->has('numLogradouroCorrespondencia') ? 'error' : '' }}}">
							<div class="col-md-12">
		                        <label class="control-label" for="numLogradouroCorrespondencia">Número</label>
								<input class="form-control" type="text" name="numLogradouroCorrespondencia" id="numLogradouroCorrespondencia" value="{{{ Input::old('numLogradouroCorrespondencia', isset($operadora) ? $operadora->enderecoCorresp->numLogradouro : null) }}}" />
								{{{ $errors->first('numLogradouro', '<span class="help-block">:message</span>') }}}
							</div>
						</div>
						<!-- ./ numLogradouro -->

					</div>

					<div class="row">

						<!-- complemento  -->
						<div class="form-group col-md-6 {{{ $errors->has('complementoCorrespondencia') ? 'error' : '' }}}">
							<div class="col-md-12">
		                        <label class="control-label" for="complemento">Complemento</label>
								<input class="form-control" type="text" name="complementoCorrespondencia" id="complementoCorrespondencia" value="{{{ Input::old('complementoCorrespondencia', isset($operadora) ? $operadora->enderecoCorresp->complemento : null) }}}" />
								{{{ $errors->first('complemento', '<span class="help-block">:message</span>') }}}
							</div>
						</div>
						<!-- ./ complemento -->

						<!-- cep  -->
						<div class="form-group col-md-6 {{{ $errors->has('cepCorrespondencia') ? 'error' : '' }}}">
							<div class="col-md-12">
		                        <label class="control-label" for="cep">CEP</label>
								<input class="form-control" type="text" name="cepCorrespondencia" id="cepCorrespondencia" value="{{{ Input::old('cepCorrespondencia', isset($operadora) ? $operadora->enderecoCorresp->cep : null) }}}" />
								{{{ $errors->first('cep', '<span class="help-block">:message</span>') }}}
							</div>
						</div>
						<!-- ./ cep -->

					</div>

					<!-- bairro  -->
					<div class="form-group {{{ $errors->has('bairro') ? 'error' : '' }}}">
						<div class="col-md-12">
	                        <label class="control-label" for="bairro">Bairro</label>
							<input class="form-control" type="text" name="bairroCorrespondencia" id="bairro" value="{{{ Input::old('bairro', isset($operadora) ? $operadora->enderecoCorresp->bairro : null) }}}" />
							{{{ $errors->first('bairro', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ bairro -->

					<div class="row">

							
						<!-- siglaUF  -->
						<div class="form-group col-md-5 {{{ $errors->has('siglaUF') ? 'error' : '' }}}">
							<div class="col-md-12">
		                        <label class="control-label" for="siglaUF">Estado</label>
								<select class="form-control" name="siglaUFCorrespondencia" id="siglaUFCorrespondencia">
								 <option value="" >Selecione</option>
								 @foreach( $estados as $uf => $estado)
								 	<option value="{{ $uf }}" {{ Input::old('siglaUFCorrespondencia', isset($operadora) ? $operadora->enderecoCorresp->siglaUF : null) == $uf ? ' selected="selected" ': '' }} >{{ $estado }}</option>
								 @endforeach

								</select>
								{{{ $errors->first('siglaUF', '<span class="help-block">:message</span>') }}}
							</div>
						</div>
						<!-- ./ siglaUF -->

						<!-- municipioIBGE  -->
						<div class="form-group col-md-7 {{{ $errors->has('municipioIBGE') ? 'error' : '' }}}">
							<div class="col-md-12">
		                        <label class="control-label" for="municipioIBGECorrespondencia">Cidade</label>
								<select class="form-control" name="municipioIBGECorrespondencia" id="municipioIBGECorrespondencia">
								@if( Input::old('municipioIBGECorrespondencia') )	
									<option value="{{ Input::old('municipioIBGECorrespondencia') }}">{{ Municipio::where('municipioIBGE','=', Input::old('municipioIBGECorrespondencia') )->first() ? Municipio::where('municipioIBGE','=', Input::old('municipioIBGECorrespondencia') )->first()->descricao : '-' }}</option>
								@else
									@if(!isset($operadora))
									<option>-</option>
									@else
										<option value="{{ $operadora->enderecoCorresp->municipioIBGE }}">{{ $operadora->enderecoCorresp->municipio->descricao }}</option>
									@endif
								@endif
								</select>
								{{{ $errors->first('municipioIBGE', '<span class="help-block">:message</span>') }}}
							</div>
						</div>
						<!-- ./ municipioIBGE -->

					</div>

				</div>
			</div>
			<!-- ./ tab-endereco-corresp -->

			<!-- tab-enquadramento -->
			<div class="tab-pane" id="tab-enquadramento">
				
				<!-- naturezaJuridica  -->
				<div class="form-group col-md-5 {{{ $errors->has('naturezaJuridica') ? 'error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="naturezaJuridica">Natureza Jurídica</label>
						<select class="form-control" name="naturezaJuridica" id="naturezaJuridica">
						 <option value="" >Selecione</option>
						 @foreach( NaturezaJuridica::lists('descricao','codigo') as $codigo => $descricao)
						 	<option value="{{ $codigo }}" {{ Input::old('naturezaJuridica', isset($operadora) ? $operadora->naturezaJuridica : null) == $codigo ? ' selected="selected" ': '' }} >{{ $descricao }}</option>
						 @endforeach

						</select>
						{{{ $errors->first('naturezaJuridica', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ naturezaJuridica -->

				
				<!-- modalidade -->
					<div class="form-group col-md-6 {{{ $errors->has('modalidade') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="modalidade">Modalidade</label>
							<select class="form-control" name="modalidade" id="modalidade">
								 <option value="" >Selecione</option>
								 @foreach( $modalidades as $codigo => $modalidade)
								 	<option value="{{ $codigo }}" {{ Input::old('modalidade', isset($operadora) ? $operadora->modalidade : null) == $codigo ? ' selected="selected" ': '' }} >{{ $modalidade }}</option>
								 @endforeach

							</select>
							{{{ $errors->first('modalidade', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
				<!-- ./ modalidade -->

				<!-- segmentacao -->
				<div class="form-group col-md-12 {{{ $errors->has('segmentacao') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="segmentacao">Segmentação</label>
						<select class="form-control" name="segmentacao" id="segmentacao">
							 <option value="" >Selecione</option>
							 @foreach( $segmentos as $codigo => $segmento)
							 	<option value="{{ $codigo }}" {{ Input::old('segmentacao', isset($operadora) ? $operadora->segmentacao : null) == $codigo ? ' selected="selected" ': '' }} >{{ $segmento }}</option>
							 @endforeach

						</select>
						{{{ $errors->first('segmentacao', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ segmentacao -->

				<!-- totalmentePulverizado -->
					<div class="form-group col-md-6 {{{ $errors->has('totalmentePulverizado') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="totalmentePulverizado">Totalmente Pulverizado</label>
	                        <select name="totalmentePulverizado" id="totalmentePulverizado" class="form-control" >
	                        	<option value="S" {{ Input::old('totalmentePulverizado', isset($operadora) ? $operadora->totalmentePulverizado : 'S') == 'S' ? ' selected="selected" ': '' }} >Sim</option>
	                        	<option value="N" {{ Input::old('totalmentePulverizado', isset($operadora) ? $operadora->totalmentePulverizado : 'S') == 'N' ? ' selected="selected" ': '' }}>Não</option>
	                        </select>
							{{{ $errors->first('totalmentePulverizado', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
				<!-- ./ totalmentePulverizado -->

				<!-- totalAcoesQuotas -->
					<div class="form-group col-md-6 {{{ $errors->has('totalAcoesQuotas') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="totalAcoesQuotas">Total de Ações/Quotas</label>
							<input class="form-control" type="text" name="totalAcoesQuotas" id="totalAcoesQuotas" value="{{{ Input::old('totalAcoesQuotas', isset($operadora) ? number_format( $operadora->totalAcoesQuotas, 0, '','' ) : null) }}}" />
							{{{ $errors->first('totalAcoesQuotas', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
				<!-- ./ totalAcoesQuotas -->



				<div>							
						<!-- siglaUF  -->
						<div class="form-group col-md-5 {{{ $errors->has('siglaUF') ? 'error' : '' }}}">
							<div class="col-md-12">
		                        <label class="control-label" for="siglaUF">Estado atuação</label>
								<select class="form-control" name="siglaUF" id="siglaUF">
								 <option value="" >Selecione</option>
								 @foreach( $estados as $uf => $estado)
								 	<option value="{{ $uf }}" {{ Input::old('siglaUF', isset($operadora) ? $operadora->siglaUF : null) == $uf ? ' selected="selected" ': '' }} >{{ $estado }}</option>
								 @endforeach

								</select>
								{{{ $errors->first('siglaUF', '<span class="help-block">:message</span>') }}}
							</div>
						</div>
						<!-- ./ siglaUF -->

						<!-- municipioIBGE  -->
						<div class="form-group col-md-7 {{{ $errors->has('municipioIBGE') ? 'error' : '' }}}">
							<div class="col-md-12">
		                        <label class="control-label" for="municipioIBGE">Cidade atuação</label>
								<select class="form-control" name="municipioIBGE" id="municipioIBGE">
								@if( Input::old('municipioIBGE') )	
									<option value="{{ Input::old('municipioIBGE') }}">{{ Municipio::where('municipioIBGE','=', Input::old('municipioIBGE') )->first() ? Municipio::where('municipioIBGE','=', Input::old('municipioIBGE') )->first()->descricao : '-' }}</option>
								@else
									@if(!isset($operadora))
									<option>-</option>
									@else
										<option value="{{ $operadora->municipioIBGE }}">{{ Municipio::where('municipioIBGE','=', $operadora->municipioIBGE )->first()->descricao}}</option>
									@endif
								@endif
								</select>
								{{{ $errors->first('municipioIBGE', '<span class="help-block">:message</span>') }}}
							</div>
						</div>
						<!-- ./ municipioIBGE -->

					</div>
				
			</div>
			<!-- ./ tab-enquadramento -->




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

	$('#siglaUFMatriz').change(function(){
		
		$.ajax({
		  dataType: "json",
		  url: '/cidades/'+$( this ).val()
		}).done(function(retorno) {
			var optionsCidades = '<option value="">Escolha</option>';
			$('#municipioIBGEMatriz').empty();
			$.each(retorno, function(ibgeCod, descricao){
				optionsCidades = optionsCidades + '<option value="'+ibgeCod+'">'+descricao+'</option>';
			});
			$('#municipioIBGEMatriz').html(optionsCidades);
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

	$('#enderecoIgualMatriz').on('click', function(){
		$('#enderecoCorrespondencia').toggle(!this.checked);
	});

@stop