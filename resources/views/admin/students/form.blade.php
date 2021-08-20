<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'F.I.O', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Telefon raqami', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('year') ? 'has-error' : ''}}" style="width:300px">
    {!! Form::label('year', 'Tug\'ilgan yili', ['class' => 'control-label']) !!}
    {!! Form::date('year', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Manzili', ['class' => 'control-label']) !!}
    {!! Form::text('address', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('passport') ? 'has-error' : ''}}">
    {!! Form::label('passport', 'Passport malumotlari', ['class' => 'control-label']) !!}
    {!! Form::text('passport', null, ('required' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
    {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="">Jinsi</label> &nbsp; &nbsp;
    <input type="radio" value="1"  @if(isset($student))
        {{ $student->sex==1 ? 'checked' : '' }} @else checked
    @endif name="sex"  > O'g'il &nbsp;&nbsp;
    <input type="radio" @isset($student)
    {{ $student->sex==0 ? 'checked' : '' }}
@endisset value="0" name="sex"> Qiz
</div>

<div class="form-group">
    <label for="">Grant</label> &nbsp; &nbsp;
    <input type="checkbox" value="1"  @if(isset($student))
        {{ $student->type==1 ? 'checked' : '' }}
    @endif name="type"  >
</div>

<div class="form-group{{ $errors->has('passport') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Rasm', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
</div>
<input type="hidden" value="{{ $group->id }}" name="group_id">

<div class="form-group">
    <label for="">Status</label>
    <select  name="status" class="form-control select2" id="" required>
        <option @isset ($student)
            {{ $student->status==1 ? 'selected': '' }}
        @endisset  value="1">O'qimoqda</option>
        <option @isset ($student)
        {{ $student->status==0 ? 'selected': '' }}
    @endisset value="0">Bitirib ketgan</option>

    </select>
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
</div>


