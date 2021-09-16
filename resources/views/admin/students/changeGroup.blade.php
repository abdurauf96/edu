@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
     
        <div class="box">
            <div class="box-header"> <h3> O'quvchi guruxini almashtirish</h3></div>
            <div class="box-body" data-select2-id="15">
                <div class="row">
                  <div class="col-md-6" data-select2-id="14">
                  <form action="{{ route('changeStudentGroup') }}" method="post">
                    @csrf
                    <div class="form-group" data-select2-id="13">
                      <label>O'quvchini tanlang</label>
                      
                      <select id="student" name="student_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                        <option value="">O'quvchilar</option>
                        @foreach ($students as $student)
                        <option data-group_id="{{ $student->group->id }}" value="{{ $student->id }}" >{{ $student->name }}</option>
                        @endforeach
                        </select>
                        
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>Joriy guruxi</label>
                      <select id="student_group" class="form-control select2 " disabled style="width: 100%;"  tabindex="-1" aria-hidden="true">
                        <option value="">Joriy guruh</option>
                        @foreach ($groups as $group)
                        <option value={{ $group->id }}>{{ $group->name }}</option>
                        @endforeach
                        
                      </select>
                    </div>
                    <h4>O'tish kerak bo'lgan kurs va gurux</h4>
                    <div class="form-group">
                      <label>Kurs </label>
                      <select id="courses" class="form-control select2 "  style="width: 100%;"   >
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label>Guruh </label>
                      <select name="new_group_id" id="groups" class="form-control "  style="width: 100%;" >
                        @foreach ($groups as $group)
                        <option data-course_id={{ $group->course->id }} value="{{ $group->id }}">{{ $group->name }} ({{ $group->course->name }}) </option>
                        @endforeach
                      </select>
                    </div>
                    <!-- /.form-group -->
                    <input type="submit" class="btn btn-primary" value="Tasdiqlash">
                  </form>
                  </div>
                 
                </div>
                <!-- /.row -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
     $(document).ready(function(){

        $('.select2').select2({
            placeholder: "Tanlang...",
            allowClear: true,
            required: true
        });

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
