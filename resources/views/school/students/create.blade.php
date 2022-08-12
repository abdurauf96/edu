@extends('layouts.school')

@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title"> {{ $group->name }} ({{ $group->course->name }}) guruhiga yangi o'quvchi qo'shish </h3> </div>
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="col-lg-12">
                    {!! Form::open(['url' => '/school/students', 'files'=>true, 'class' => 'form-horizontal add_student_form', 'files' => true]) !!}

                    @include ('school.students.form', ['formMode' => 'create'])

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
    @if(auth()->guard('user')->user()->school->isAcademy())
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Navbatda turgan o'quvchini biriktirish</h3>
            </div>
            <div class="card-body">

                <form action="/school/add-student-to-group" method="POST" class="exist_student_form" >
                    <!-- Dropdown -->
                    @csrf
                    <div class="form-group">
                        <input type="hidden" value="{{$group->id}}" name="group_id">
                        <select class="form-control select2" name="waiting_student_id">
                            @foreach ($waitingStudents as $stu)
                                <option value='{{ $stu->id }}'>{{ $stu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('start_date', "Dars boshlanish sanasi", ['class' => 'control-label']) !!}
                        {!! Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required'] ) !!}
                        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
                    </div>
                
                    <div class="form-group">
                        <input type='submit' class="btn btn-primary" value='Guruhga qo`shish' >
                    </div>
                    <br/>
                    <div id='result'></div>
                </form>

            </div>
            <!-- /.box-body -->
        </div>
    </div>
    @endif
</div>
@endsection

