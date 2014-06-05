@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Dados do responsável</a></li>
			
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($resp)){{ URL::to('admin/resps/' . $resp->id . '/editar') }}@endif" >
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<div class="row">

					<!-- numRegistro -->
					<div class="form-group col-md-4 {{{ $errors->has('numRegistro') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="numRegistro">Registro</label>
							<input class="form-control" type="text" name="numRegistro" id="numRegistro" value="{{{ Input::old('numRegistro', isset($resp) ? $resp->numRegistro : null) }}}" />
							{{{ $errors->first('numRegistro', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ numRegistro -->

					<!-- tipoPessoa -->
					<div class="form-group col-md-4 {{{ $errors->has('tipoPessoa') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="tipoPessoa">Pessoa</label>
							<select class="form-control" type="text" name="tipoPessoa" id="tipoPessoa">
								<option value="">Selecione</option>
								<option value="F" {{ Input::old('tipoPessoa', isset($resp) ? $resp->tipoPessoa : null) == 'F' ? 'selected="selected"':'' }}>Física</option>
								<option value="J" {{ Input::old('tipoPessoa', isset($resp) ? $resp->tipoPessoa : null) == 'J' ? 'selected="selected"':'' }}>Jurídica</option>
							</select> 
							{{{ $errors->first('tipoPessoa', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ tipoPessoa -->

					<!-- cpfCnpj -->
					<div class="form-group col-md-4 {{{ $errors->has('cpfCnpj') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="cpfCnpj">CPF/CNPJ</label>
							<input class="form-control" type="text" name="cpfCnpj" id="cpfCnpj" value="{{{ Input::old('cpfCnpj', isset($resp) ? $resp->cpfCnpj : null) }}}" />
							{{{ $errors->first('cpfCnpj', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ cpfCnpj -->

				</div>


				<!-- nome -->
				<div class="form-group {{{ $errors->has('nome') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="nome">Nome/Razão Social</label>
						<input class="form-control" type="text" name="nome" id="nome" value="{{{ Input::old('nome', isset($resp) ? $resp->nome : null) }}}" />
						{{{ $errors->first('nome', '<span class="help-block">:message</span>') }}}
					</div>
				</div>
				<!-- ./ nome -->

				<!-- tipo -->
				<div class="form-group {{{ $errors->has('tipo') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="tipo">Tipo</label>
						<select class="form-control" type="text" name="tipo" id="tipo">
							<option value="">Selecione</option>
							<option value="T" {{ Input::old('tipo', isset($resp) ? $resp->tipo : null) == 'T' ? 'selected="selected"':'' }}>Atuária</option>
							<option value="C" {{ Input::old('tipo', isset($resp) ? $resp->tipo : null) == 'C' ? 'selected="selected"':'' }}>Contabilidade</option>
							<option value="U" {{ Input::old('tipo', isset($resp) ? $resp->tipo : null) == 'U' ? 'selected="selected"':'' }}>Auditoria</option>
						</select> 
					</div>
				</div>
				<!-- ./ tipo -->
				
				
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