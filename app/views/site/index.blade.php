@extends('site.layouts.default')
{{-- Web site Title --}}
@section('title')
HOME
@parent
@stop

{{-- Content --}}
@section('content')
<h1 style="text-align:center">
<a href="{{{ URL::to('user/login') }}}" class="btn btn-success">Acesse o sistema</a>
</h1>
@stop
