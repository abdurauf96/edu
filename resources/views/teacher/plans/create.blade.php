@extends('layouts.teacher')

@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/summernote/summernote-bs4.css">
@endsection

@section('title')
   {{ $course->name }} kursiga reja kiritish
@endsection
@section('content')
<div class="section-body">
<div class="row">
    <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header">{{ $course->name }} kursiga reja kiritish </div>
            <div class="card-body">
                <a href="{{ route('teacher.plans.index', ['course_id'=>$course->id]) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <br />
                <br />

                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('teacher.plans.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <input type="hidden" value="{{ $course->id }}" name="course_id">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Reja sarlavhasi</label>
                            <input type="text" class="form-control" id="inputEmail4" name="title" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Reja muddati (Oy) </label>
                            <input type="number" class="form-control" name="duration">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Reja nomeri </label>
                            <input type="number" class="form-control" name="order">
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Reja mavzulari haqida batafsil ma'lumot</label>
                        <textarea class="summernote" name="description"></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <input class="btn btn-primary" type="submit" value="Saqlash" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script src="/admin/assets/bundles/summernote/summernote-bs4.js"></script>
<!-- Template JS File -->
@endsection
