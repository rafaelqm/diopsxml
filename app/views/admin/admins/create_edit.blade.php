@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Dados do administrador</a></li>
			
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($admin)){{ URL::to('admin/admins/' . $admin->id . '/editar') }}@endif" >
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<div class="row">
					<!-- CPF -->
					<div class="form-group col-md-4 {{ $errors->has('CPF') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="CPF">CPF</label>
							<input class="form-control" type="text" name="CPF" id="CPF" value="{{{ Input::old('CPF', isset($admin) ? $admin->CPF : null) }}}" />
							{{ $errors->first('CPF', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<!-- ./ CPF -->

					<!-- estrangeiro -->
					<div class="form-group col-md-4 {{ $errors->has('estrangeiro') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="estrangeiro">Estrangeiro</label>
							<select class="form-control" type="text" name="estrangeiro" id="estrangeiro">
								<option value="">Selecione</option>
								<option value="0" {{ Input::old('estrangeiro', isset($admin) ? $admin->estrangeiro : 0) == '0' ? 'selected="selected"':'' }}>Não</option>
								<option value="1" {{ Input::old('estrangeiro', isset($admin) ? $admin->estrangeiro : 0) == '1' ? 'selected="selected"':'' }}>Sim</option>
							</select> 
							{{ $errors->first('estrangeiro', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<!-- ./ estrangeiro -->	
				</div>

				<!-- nome -->
				<div class="form-group {{ $errors->has('nome') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="nome">Nome/Razão Social</label>
						<input class="form-control" type="text" name="nome" id="nome" value="{{{ Input::old('nome', isset($admin) ? $admin->nome : null) }}}" />
						{{ $errors->first('nome', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ nome -->

				<!-- nomeMae -->
				<div class="form-group {{ $errors->has('nomeMae') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="nomeMae">Nome Mãe</label>
						<input class="form-control" type="text" name="nomeMae" id="nomeMae" value="{{{ Input::old('nomeMae', isset($admin) ? $admin->nomeMae : null) }}}" />
						{{ $errors->first('nomeMae', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ nomeMae -->

				<!-- cargoFuncao -->
				<div class="form-group {{ $errors->has('cargoFuncao') ? 'error' : '' }}}">
                    <div class="col-md-12">
                        <label class="control-label" for="cargoFuncao">Cargo</label>
						<select class="form-control" type="text" name="cargoFuncao" id="cargoFuncao">
							<option value="">Selecione</option>
							@foreach( $cargos as $id => $cargo)
							 	<option value="{{ $id }}" {{ Input::old('cargoFuncao', isset($admin) ? $admin->cargoFuncao : null) == $id ? ' selected="selected" ': '' }} >{{ $cargo }}</option>
							@endforeach
						</select> 
					</div>
				</div>
				<!-- ./ cargoFuncao -->

				<div class="row">
					<!-- dataIniMandato -->
					<div class="form-group col-md-6 {{ $errors->has('dataIniMandato') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="dataIniMandato">Início Mandato</label>
							<input class="form-control" type="text" name="dataIniMandato" id="dataIniMandato" value="{{{ Input::old('dataIniMandato', isset($admin) ? DataFormat::makeBR( $admin->dataIniMandato ) : null) }}}" />
							{{ $errors->first('dataIniMandato', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<!-- ./ dataIniMandato -->

					<!-- dataFimMandato -->
					<div class="form-group col-md-6 {{ $errors->has('dataFimMandato') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="dataFimMandato">Término Mandato</label>
							<input class="form-control" type="text" name="dataFimMandato" id="dataFimMandato" value="{{{ Input::old('dataFimMandato', isset($admin) ? ($admin->dataFimMandato!='0000-00-00' ? DataFormat::makeBR($admin->dataFimMandato) : '' ) : null) }}}" />
							{{ $errors->first('dataFimMandato', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<!-- ./ dataFimMandato -->	
				</div>


				<div class="row">

					<!-- resposavelTecnico -->
					<div class="form-group col-md-4 {{ $errors->has('resposavelTecnico') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="resposavelTecnico">Responsável Técnico</label>
							<select class="form-control" type="text" name="resposavelTecnico" id="resposavelTecnico">
								<option value="0" {{ Input::old('resposavelTecnico', isset($admin) ? $admin->resposavelTecnico : 0) == '0' ? 'selected="selected"':'' }}>Não</option>
								<option value="1" {{ Input::old('resposavelTecnico', isset($admin) ? $admin->resposavelTecnico : 0) == '1' ? 'selected="selected"':'' }}>Sim</option>
							</select> 
							{{ $errors->first('resposavelTecnico', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<!-- ./ resposavelTecnico -->	

					<!-- tipo -->
					<div class="form-group col-md-4 {{ $errors->has('tipo') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="tipo">Tipo</label>
							<select class="form-control" type="text" name="tipo" id="tipo">
								<option value="">Selecione</option>
								<option value="M" {{ Input::old('tipo', isset($admin) ? $admin->tipo : '') == 'M' ? 'selected="selected"':'' }}>Médico</option>
								<option value="O" {{ Input::old('tipo', isset($admin) ? $admin->tipo : '') == 'O' ? 'selected="selected"':'' }}>Dentista</option>
							</select> 
							{{ $errors->first('tipo', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<!-- ./ tipo -->

					<!-- crm -->
					<div class="form-group col-md-4 {{ $errors->has('crm') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="crm">CRM/CRO</label>
							<input class="form-control" type="text" name="crm" id="crm" value="{{{ Input::old('crm', isset($admin) ? $admin->crm : null) }}}" />
							{{ $errors->first('crm', '<span class="help-block">:message</span>') }}
						</div>
					</div>
					<!-- ./ crm -->	
				</div>

				
				
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