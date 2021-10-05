@extends('layouts.school')

@section('content')

<div class="row">

    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header"><h3 class="box-title"> {{ $group->name }} ({{ $group->course->name }}) guruhiga yangi o'quvchi qo'shish </h3> </div>
            <div class="box-body">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="col-lg-6">
                    {!! Form::open(['url' => '/school/students', 'files'=>true, 'class' => 'form-horizontal add_student_form', 'files' => true]) !!}

                    @include ('school.students.form', ['formMode' => 'create'])

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header">
            <h3 class="box-title">Navbatda turgan o'quvchini biriktirish</h3>
            </div>
            <div class="box-body">

                <form action="/school/add-student-to-group" method="POST" class="exist_student_form" >
                    <!-- Dropdown -->
                    @csrf
                    <div class="form-group">
                        <input type="hidden" value="{{$group->id}}" name="group_id">
                        <select class='select2' style='width: 200px;' class="form-control" name="waiting_student_id">
                            @foreach ($waitingStudents as $stu)
                                <option value='{{ $stu->id }}'>{{ $stu->name }}</option>
                            @endforeach
                        </select>
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

@section('js')
<script>
    $(document).ready(function(){

        $('.select2').select2({
            placeholder: "Tanlang...",
            allowClear: true,
            required: true
        });
    });
</script>
@endsection
