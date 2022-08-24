@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        @livewire('school.payments')
    </div>
</div>

@endsection

@section('js')
    @livewireScripts
@endsection
