@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
@livewireStyles
@endsection
@section('title', 'Izohlar')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            @if(session('text'))
            <div class="col-3 alert alert-success">
                <h2>{{ session('text') }}</h2>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Student : {{ $student->name }}</h4>
                </div>
                <form action="{{ route('sendcomment') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label>Izoh</label>
                            <textarea name="body" class="form-control" style=""></textarea>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Date table  --}}
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="45%">Izoh</th>
                                    <th width="25%">Izoh qoldiruvchi</th>
                                    <th width="20%">Izhoh vaqti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($student->comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->body }}</td>
                                    <td>{{ $comment->userauth->name }}</td>
                                    <td>{{ $comment->created_at->format('H:i:s / d-M-Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@livewireScripts
@endsection
