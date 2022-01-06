@extends('layouts.teacher')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"> <h4>Davomat</h4>

                </div>
                @livewire('attendance')
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
