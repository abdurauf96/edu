<div class="form-group">
    <label for="">Kurs</label>
    <select name="course_id" class="form-control select2" id="">

        @foreach($courses as $course)
            <option @isset($waitingstudent) {{ $waitingstudent->course_id==$course->id? 'selected' : '' }} @endisset value="{{ $course->id  }}">{{ $course->name }} </option>
        @endforeach
    </select>
</div>
<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'F.I.O', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Telefon raqam', ['class' => 'control-label']) !!}
    {!! Form::number('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Telefon raqam 2', ['class' => 'control-label']) !!}
    {!! Form::number('phone2', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('year') ? 'has-error' : ''}}">
    {!! Form::label('year', 'Tug`ilgan yili', ['class' => 'control-label']) !!}
    {!! Form::date('year', null, ['class' => 'form-control', 'required' => 'required'] ) !!}
    {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label for="">Tuman, SHahar</label>
    <select name="district_id" class="form-control select2" required>
        @foreach ($districts as $district)
            <option @isset($student) {{ $waitingstudent->district_id==$district->id ? 'selected' : '' }} @endisset value="{{ $district->id }}">{{ $district->name }} </option>
        @endforeach
    </select>
</div>

<div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Manzil', ['class' => 'control-label']) !!}
    {!! Form::text('address', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('passport') ? 'has-error' : ''}}">
    {!! Form::label('passport', 'Passport malumotlari', ['class' => 'control-label']) !!}
    {!! Form::text('passport', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('passport') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Rasm', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <label for="">Jinsi</label> &nbsp; &nbsp;
    <input type="radio" value="1"  @if(isset($waitingstudent))
    {{ $waitingstudent->sex==1 ? 'checked' : '' }} @else checked
           @endif name="sex"  > O'g'il &nbsp;&nbsp;
    <input type="radio" @isset($waitingstudent)
    {{ $waitingstudent->sex==0 ? 'checked' : '' }}
    @endisset value="0" name="sex"> Qiz
</div>

<div class="form-group">
    <label for="">O'qish turi</label> <br>
    <span>Grant &nbsp; &nbsp; </span>
    <input type="checkbox" value="0"  @if(isset($waitingstudent))
    {{ $waitingstudent->type!=1 ? 'checked' : '' }}
    @endif name="type"  >
</div>

<div class="form-group">
    <label for="">O'qish oralig'i</label> &nbsp; &nbsp;
    <input type="radio" value="1"  @if(isset($waitingstudent))
    {{ $waitingstudent->course_time==1 ? 'checked' : '' }} @else checked
           @endif name="course_time"  > Obedgacha &nbsp;&nbsp;
    <input type="radio" @isset($waitingstudent)
    {{ $waitingstudent->course_time==2 ? 'checked' : '' }}
    @endisset value="2" name="course_time"> Obeddan keyin
    <input type="radio" @isset($waitingstudent)
    {{ $waitingstudent->course_time==3 ? 'checked' : '' }}
    @endisset value="3" name="course_time"> Kechki
</div>

<div class="form-group">
    <label for="">O'qish joyi</label> &nbsp; &nbsp;
    <input type="radio" value="1"  @if(isset($waitingstudent))
    {{ $waitingstudent->study_type==1 ? 'checked' : '' }} @else checked
           @endif name="study_type"  > Maktab &nbsp;&nbsp;
    <input type="radio" @isset($waitingstudent)
    {{ $waitingstudent->study_type==2 ? 'checked' : '' }}
    @endisset value="2" name="study_type"> Kolej &nbsp;&nbsp;
    <input type="radio" @isset($waitingstudent)
    {{ $waitingstudent->study_type==3 ? 'checked' : '' }}
    @endisset value="3" name="study_type"> Universitet &nbsp;&nbsp;
    <input type="radio" @isset($waitingstudent)
    {{ $waitingstudent->study_type==4 ? 'checked' : '' }}
    @endisset value="4" name="study_type"> Ishchi
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
</div>
