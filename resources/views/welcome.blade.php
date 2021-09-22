@extends('layouts.site')

@section('content')
@if(Session::has('msg'))
    {{ session::get('msg') }}
@endif
    <p>wellcome</p> 
@endsection