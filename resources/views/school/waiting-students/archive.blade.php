@extends('layouts.school')
@section('css')
    @livewireStyles
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            @livewire('waiting-students-archive')
        </div>
    </div>
@endsection

@section('js')
    @livewireScripts
@endsection
