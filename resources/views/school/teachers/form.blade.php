@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
@endsection

<div class="form-group">
    <label for="" class="control-label">Xodim</label>
    <select class="form-control select2" name="staff_id" data-height="100%" required data-placeholder="Yo'nalishni tanlang">
        @foreach ($staffs as $staff)
            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
        @endforeach
    </select>
</div>


<div class="form-group{{ $errors->has('course_id') ? 'has-error' : ''}}">
    {!! Form::label('course_id', 'Mutahassisliklari', ['class' => 'control-label']) !!}

   <select name="course_id[]" class="form-control select2" id="" multiple data-placeholder="Yo'nalishni tanlang" required data-height="100%">
       @foreach ($courses as $course)
           <option @isset($course_ids) {{ in_array($course->id, $course_ids) ? 'selected' : '' }} @endisset value="{{ $course->id }}">{{ $course->name }}</option>
       @endforeach
   </select>
</div>

<div class="form-group{{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div> 


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
</div>

@section('js')
    <script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
    <script>
         $('.select2').select2();
    </script>
@endsection
