@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
        </ul>
    <!-- ./ tabs -->
    {{-- Delete Post Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($ativovinculado)){{ URL::to('admin/ativovinculados/' . $ativovinculado->id . '/delete') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $ativovinculado->id }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                Remover Ativo Vinculado <span class="label label-primary">{{$ativovinculado->rgi}}</span>
                <element class="btn-cancel close_popup">Cancelar</element>
                <button type="submit" class="btn btn-danger">Remover</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop