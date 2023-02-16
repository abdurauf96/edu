@extends('layouts.school')
@section('css')
    @livewireStyles
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @livewire('school.payments-graphic')
        </div>
    </div>
@endsection
@section('js')
    @livewireScripts
@endsection
