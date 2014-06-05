@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Remoção</a></li>
        </ul>
    <!-- ./ tabs -->
    {{-- Delete Post Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($resp)){{ URL::to('admin/resps/' . $resp->id . '/delete') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $resp->id }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
               <h3> Remover responsável <span class="label label-primary">{{ $resp->nome }}</span> </h3>
                <element class="btn btn-default close_popup">Cancelar</element>
                <button type="submit" class="btn btn-danger">Remover</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop