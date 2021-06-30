@extends('layouts.admin')

@section('content')

<div class="row">
    
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header"><h3 class="box-title">  Yangi qo'shish </h3> </div>
            <div class="box-body">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="col-lg-6">
                    {!! Form::open(['url' => '/admin/students', 'files'=>true, 'class' => 'form-horizontal add_student_form', 'files' => true]) !!}

                    @include ('admin.students.form', ['formMode' => 'create'])
                   
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
    
    {{-- <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header">
            <h3 class="box-title">Mavjud o'quvchini biriktirish</h3>
            </div>
            <div class="box-body">
            
                <form action="/admin/add-student-to-group" method="POST" class="exist_student_form" >
                    <!-- Dropdown --> 
                    @csrf
                    <select id='selUser' style='width: 200px;' class="form-control" name="student_id">
                        @foreach ($students as $student)
                        <option value='{{ $student->id }}'>{{ $student->name }}</option> 
                        @endforeach
                    </select>
                    <input type="hidden" value="{{ $group_id }}" name="group_id">
                    <input type='submit' class="btn btn-primary" value='Guruhga qo`shish' >
                    
                    <br/>
                    <div id='result'></div>
                </form>
            
            </div>
            <!-- /.box-body -->
        </div>
    </div>   --}}
    
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $("#selUser").select2();
    });
</script>
@endsection