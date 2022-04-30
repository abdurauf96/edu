@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h3> O'quvchi guruxini almashtirish</h3></div>
            <div class="card-body ">
                <form action="{{ route('changeStudentGroup') }}" method="post" class="row">
                  @csrf
                  <div class="col-lg-6 col-md-6 col-xs-12"> 
                    <div class="form-group" >
                      <label>O'quvchini tanlang</label>
                      <select id="student" name="student_id" class="form-control select2 " >
                        <option value="">O'quvchilar</option>
                        @foreach ($students as $student)
                        <option data-group_id="{{ $student->group->id }}" value="{{ $student->id }}" >{{ $student->name }}</option>
                        @endforeach
                        </select> 
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Joriy guruxi</label>
                      <select id="student_group" class="form-control" disabled >
                        <option value="">Joriy guruh</option>
                        @foreach ($groups as $group)
                        <option value={{ $group->id }}>{{ $group->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-xs-12"> 
                   
                    <div class="form-group">
                      <label>Qaysi yo'nalishga o'tmoqda ? </label>
                      <select id="courses" class="form-control select2 "  >
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Qaysi guruhga qo'shilmoqda ? </label>
                      <select name="new_group_id" id="groups" class="form-control " >
                        @foreach ($groups as $group)
                        
                        <option data-course_id={{ $group->course->id }} value="{{ $group->id }}">{{ $group->name  }} ({{ $group->course->name }}) </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Yangi guruhda dars boshlash sanasi </label>
                      <input type="date" class="form-control" required name="start_date">
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <input type="submit" class="btn btn-primary" value="Tasdiqlash">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
     $(document).ready(function(){

        $('#student').change(function() {
            var student_id=$(this).val();
            var group_id=$(this).find(':selected').data('group_id');
            $('#student_group').val(group_id);
            $('#student_group').select2().trigger('change');
        })

        $('#courses').change(function() {
            var course_id=$(this).val();
            console.log(course_id);
            var $options = $('#groups')
            .val('')
            .find('option')
            .show();
            if (course_id != '0')
                $options.not('[data-course_id="' + course_id + '"],[data-course_id=""]').hide();
        })
    });
</script>
@endsection
