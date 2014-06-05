@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
        </ul>
    <!-- ./ tabs -->
    {{-- Delete Post Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($representante)){{ URL::to('admin/representantes/' . $representante->id . '/remover') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $representante->id }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                Remover Representante <span class="label label-primary">{{$representante->nome}}</span>
                <element class="btn-cancel close_popup">Cancelar</element>
                <button type="submit" class="btn btn-danger">Remover</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop