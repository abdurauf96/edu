@extends('layouts.school')
@section('css')
    <link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/admin/assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
    @livewireStyles
@endsection
@section('title', 'Sertifikat yaratish')

@section('content')
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4>Sertifikat yaratish</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('createSertificate', $student->id) }}" method="POST">
                        @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Ism</label>
                            <input type="text" class="form-control" required placeholder="Ismini kiriting..." name="name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Familiya</label>
                            <input type="text" class="form-control" required placeholder="Familiyasini kiriting..." name="surname">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputState">Yo'nalish</label>
                            <select id="inputState" class="form-control" required name="course">
                                <option value="">Tanlang...</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}_{{ $course->code }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            @error('course')<div class="invalid-feedback">Tanlanishi shart</div>@enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">Sertifikat turi</label>
                            <select id="inputState" class="form-control" required name="type">
                                <option value="">Tanlang...</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                            </select>
                            @error('type')<div class="invalid-feedback">Tanlanishi shart</div>@enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label>Berilish sanasi</label>
                            <input type="date" name="date" class="form-control" required>
                            @error('type')<div class="invalid-feedback">Tanlanishi shart</div>@enderror
                        </div>
                        <input type="hidden" value="{{ $student->id }}" name="student_id">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Yaratish</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

@endsection
