@extends('layouts.school')

@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Yangi o'quvchi qo'shish </h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Kerakli maydonlarni to'ldiring !</p>
                    </div>
                @endif
                <div class="col-lg-12">
                    {!! Form::open(['url' => route('students.store'), 'files'=>true, 'class' => 'form-horizontal add_student_form', 'files' => true]) !!}

                    @include ('school.students.form', ['formMode' => 'create'])

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Navbatda turgan o'quvchini biriktirish</h3>
            </div>
            <div class="card-body">

                <form action="{{ route('students.addToGroup') }}" method="POST" class="exist_student_form" >
                    <!-- Dropdown -->
                    @csrf

                    <div class="form-group">

                        <label for="">O'quvchi</label>
                        <select class="form-control select2" name="waiting_student_id">
                            @foreach ($waitingStudents as $stu)
                                <option value='{{ $stu->id }}'>{{ $stu->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Guruh</label>
                        <select name="group_id" id="" class="form-control">
                            @foreach($groups as $gr)
                                <option @isset($student) {{ $student->group_id==$gr->id ? 'selected' : '' }} @endisset value="{{ $gr->id }}">
                                    {{ $gr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {!! Form::label('start_date', "Dars boshlanish sanasi", ['class' => 'control-label']) !!}
                        {!! Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required'] ) !!}
                        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
                    </div>
                    <div class="form-group">
                        <label for="">Birinchi oy uchun to'lov miqdori</label>
                        {!! Form::input('number', 'first_month_debt', null, (['class' => 'form-control']) )!!}
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
</div>
@endsection

