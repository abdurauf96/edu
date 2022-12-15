@extends('layouts.school')
@section('css')
    <link rel="stylesheet" href="/admin/assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
    @livewireStyles
@endsection
@section('title', 'O`quvchilar')

@section('content')
<div class="row">
    <div class="col-12">
        @livewire('school.school-students')
    </div>
</div>

@endsection

@section('js')
    @livewireScripts
@endsection
