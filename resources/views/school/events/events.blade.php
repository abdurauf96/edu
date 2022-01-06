@extends('layouts.school')

@section('css')
    @livewireStyles
    <style>
    .form-item{
        display:flex;
        align-items:center;
        justify-content: space-around;
        /* border: 1px solid red; */
        /* width: 30% */
    }
    label{
        margin-right: 15px;
    }
    </style>
@endsection

@section('content')
    @livewire('events')
@endsection

@section('js')

    @livewireScripts

@endsection


