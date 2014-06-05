@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">Lançamento</a></li>
			
		</ul>
	<!-- ./ tabs -->
	
	{{-- Edit Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($balancete)){{ URL::to('admin/balancetes/' . $balancete->id . '/editar') }}@endif" >
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<div class="row">
					<span class="col-md-2"><label for="tipo_ativos"> 	<input id="tipo_ativos" type="radio"   name="tipo" value="A" {{ Session::get('tipo')=='A'?' checked="checked"':'' }} /> Ativos</label></span>
					<span class="col-md-2"><label for="tipo_passivos"> 	<input id="tipo_passivos" type="radio" name="tipo" value="P" {{ Session::get('tipo')=='P'?' checked="checked"':'' }} /> Passivo</label></span>
					<span class="col-md-2"><label for="tipo_receitas"> 	<input id="tipo_receitas" type="radio" name="tipo" value="R" {{ Session::get('tipo')=='R'?' checked="checked"':'' }} /> Receita</label></span>
					<span class="col-md-2"><label for="tipo_despesas"> 	<input id="tipo_despesas" type="radio" name="tipo" value="D" {{ Session::get('tipo')=='D'?' checked="checked"':'' }} /> Despesa</label></span>
					<span class="col-md-3">
						<label>Trimestre:</label>
						<select id="trimestre" name="trimestre" class="form-control" style="margin-top:9px;" >
                                @for($i=2013;$i<= date('Y')+1;$i++)
                                    @for($k=1;$k<= 4;$k++)
                                        <option value="{{$i.'0'.$k}}" {{ Session::get('trimestre') == ($i.'0'.$k)?' selected="selected" ':'' }}>{{'0'.$k.'/'.$i}}</option>
                                    @endfor
                                @endfor

                        </select>
                    </span>
				</div>

				<div class="row">

					<!-- conta -->
					<div class="form-group col-md-3 {{{ $errors->has('conta') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="conta">Conta</label>
							<input class="form-control" type="text" name="conta" id="conta" value="{{{ Input::old('conta', isset($balancete) ? $balancete->conta : null) }}}" />
							{{{ $errors->first('conta', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ conta -->

					<!-- contaTasy -->
					<div class="form-group col-md-3 {{{ $errors->has('contaTasy') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="contaTasy">Conta Tasy</label>
							<input class="form-control" type="text" name="contaTasy" id="contaTasy" value="{{{ Input::old('contaTasy', isset($balancete) ? $balancete->contaTasy : null) }}}" />
							{{{ $errors->first('contaTasy', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ contaTasy -->

					<!-- descricao -->
					<div class="form-group col-md-6 {{{ $errors->has('descricao') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="descricao">Descrição</label>
							<input class="form-control" type="text" name="descricao" id="descricao" value="{{{ Input::old('descricao', isset($balancete) ? $balancete->descricao : null) }}}" />
							{{{ $errors->first('descricao', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ descricao -->

				</div>

				<div class="row">

					<!-- saldoAnterior -->
					<div class="form-group col-md-3 {{{ $errors->has('saldoAnterior') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="saldoAnterior">Saldo Anterior</label>
							<input class="form-control" type="text" name="saldoAnterior" id="saldoAnterior" value="{{{ Input::old('saldoAnterior', isset($balancete) ? DataFormat::moneyBR( $balancete->saldoAnterior ) : null) }}}" />
							{{{ $errors->first('saldoAnterior', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ saldoAnterior -->

					<!-- debito -->
					<div class="form-group col-md-3 {{{ $errors->has('debito') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="debito">Débito</label>
							<input class="form-control" type="text" name="debito" id="debito" value="{{{ Input::old('debito', isset($balancete) ? DataFormat::moneyBR( $balancete->debito ) : null) }}}" />
							{{{ $errors->first('debito', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ debito -->

					<!-- credito -->
					<div class="form-group col-md-3 {{{ $errors->has('credito') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="credito">Crédito</label>
							<input class="form-control" type="text" name="credito" id="credito" value="{{{ Input::old('credito', isset($balancete) ? DataFormat::moneyBR( $balancete->credito ) : null) }}}" />
							{{{ $errors->first('credito', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ credito -->

					<!-- saldoFinal -->
					<div class="form-group col-md-3 {{{ $errors->has('saldoFinal') ? 'error' : '' }}}">
	                    <div class="col-md-12">
	                        <label class="control-label" for="saldoFinal">Saldo Final</label>
							<input class="form-control" type="text" name="saldoFinal" id="saldoFinal" value="{{{ Input::old('saldoFinal', isset($balancete) ? DataFormat::moneyBR( $balancete->saldoFinal ) : null) }}}" />
							{{{ $errors->first('saldoFinal', '<span class="help-block">:message</span>') }}}
						</div>
					</div>
					<!-- ./ saldoFinal -->

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