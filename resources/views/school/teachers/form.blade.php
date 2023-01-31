@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
@endsection

<div class="form-group">

    @if($formMode=='create')
        <label for="" class="control-label">Xodim</label>
        <select class="form-control select2"  name="staff_id" data-height="100%" required data-placeholder="Xodimlardan tanlang...">
            <option value=""></option>
            @foreach ($staffs as $s)
                <option  value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>
    @else
        <label for="" class="control-label">O'qituvchi</label>
    <input type="text" class="form-control" value="{{ $teacher->name }}" name="name">
    @endif

</div>

<div class="form-group{{ $errors->has('course_id') ? 'has-error' : ''}}">
    {!! Form::label('course_id', 'Mutahassisliklari', ['class' => 'control-label']) !!}

   <select name="course_id[]" class="form-control select2" id="" multiple data-placeholder="Yo'nalishni tanlang" required data-height="100%">
       @foreach ($courses as $course)
           <option @isset($course_ids) {{ in_array($course->id, $course_ids) ? 'selected' : '' }} @endisset value="{{ $course->id }}">{{ $course->name }}</option>
       @endforeach
   </select>
</div>

<div class="form-group{{ $errors->has('birthday') ? 'has-error' : ''}}">
    {!! Form::label('birthday', 'Tug`ilgan yili', ['class' => 'control-label']) !!}
    {!! Form::date('birthday', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
    {!! Form::text('email', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group" >
    <label for="" class="control-label">Status</label>

    <select name="status" id="" class="select2 form-control">
        <option @isset($teacher) {{ $teacher->status ==1 ? 'selected' : '' }} @endisset value="1">Faol</option>
        <option @isset($teacher) {{ $teacher->status ==0 ? 'selected' : '' }} @endisset value="0">Faol emas</option>
    </select>
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
