@extends('layouts.school')
@section('css')

    @livewireStyles

@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4>Xodimlar</h4>

                <div class="card-header-form">
                    <a href="{{ route('staffs.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                </div>
            </div>
            <div class="card-body">

                @livewire('staffs', ['organizations'=>$organizations])

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

    @livewireScripts

@endsection

