<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Kurs nomi', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Kurs davomiyligi(Oy)', ['class' => 'control-label']) !!}
    {!! Form::number('duration', null, ['class' => 'form-control', 'required'=>'required'] ) !!}
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Kurs ta`rifi', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'required'=>'required'] ) !!}
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Kurs haqida', ['class' => 'control-label']) !!}
    <textarea name="body" id="body">{{ $course->body ?? '' }}</textarea>
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Image', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Kurs narxi', ['class' => 'control-label']) !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Kurs narxi (Yozuv bilan)', ['class' => 'control-label']) !!}
    {!! Form::text('price_as_text', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="">Status</label>
    <select name="status" id="" class="form-control">
        <option @isset($course) {{ $course->status==1 ? 'selected' : '' }} @endisset value="true">Faol</option>
        <option @isset($course) {{ $course->status!=1 ? 'selected' : '' }} @endisset value="false">Faol emas</option>
    </select>
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    <label for="">Bot uchun</label>
    <input @isset($course) {{ $course->is_for_bot==1 ? 'checked' : '' }} @endisset type="checkbox" value="1" name="is_for_bot">
</div>

 <div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('code', 'maxsus kod sertifikat uchun', ['class' => 'control-label']) !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
</div>
@section('js')
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
     CKEDITOR.replace( 'body' );
    </script>
@endsection
