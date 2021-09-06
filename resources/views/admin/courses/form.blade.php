<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Kurs nomi', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Kurs ta`rifi', ['class' => 'control-label']) !!}
    {!! Form::text('description', null,  ['class' => 'form-control']) !!}
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Kurs davomiyligi', ['class' => 'control-label']) !!}
    {!! Form::text('duration', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('duration', 'Kurs narxi', ['class' => 'control-label']) !!}
    {!! Form::number('price', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
    {!! Form::label('code', 'Kursning maxsus kodi', ['class' => 'control-label']) !!}
    {!! Form::text('code', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
</div>
