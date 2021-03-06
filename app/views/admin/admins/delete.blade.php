@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- Tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">Remoção</a></li>
        </ul>
    <!-- ./ tabs -->
    {{-- Delete Post Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($admin)){{ URL::to('admin/admins/' . $admin->id . '/delete') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $admin->id }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
               <h3> Remover administrador <span class="label label-primary">{{ $admin->nome }}</span> </h3>
                <element class="btn btn-default close_popup">Cancelar</element>
                <button type="submit" class="btn btn-danger">Remover</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop