
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datepicker/css/yearpicker.css" />
@endsection
<div class="col-md-6">
    <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Guruh nomi', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('course_id') ? 'has-error' : ''}}">
        {!! Form::label('course_id', 'Kursni tanlang', ['class' => 'control-label']) !!}
    <select name="course_id" class="form-control" id="">
        @foreach ($courses as $course)
            <option @isset($group) {{ $group->course_id==$course->id ? 'selected' : '' }} @endisset value="{{ $course->id }}">{{ $course->name }}</option>
        @endforeach
    </select>
    </div>
    <div class="form-group{{ $errors->has('teacher_id') ? 'has-error' : ''}}">
        {!! Form::label('teacher_id', 'O`qituvchini biriktiring', ['class' => 'control-label']) !!}
        <select name="teacher_id" class="form-control" id="">
            @foreach ($teachers as $teacher)
                <option @isset($group) {{ $group->teacher_id==$teacher->id ? 'selected' : '' }} @endisset value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group{{ $errors->has('start_date') ? 'has-error' : ''}} " style="width:300px">
        {!! Form::label('start_date', 'Kurs boshlanish sanasi', ['class' => 'control-label']) !!}
        <input type="date" name="start_date" required @if(isset($group) and $group->start_date!='')  value="{{ $group->start_date->format('Y-m-d') }}" @endif class="form-control">
        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
    </div>

</div>
<div class="col-md-6">
    <div class="form-group{{ $errors->has('time') ? 'has-error' : ''}}">
        {!! Form::label('status', 'Dars kunlari', ['class' => 'control-label']) !!}
       <select name="course_days" id="" class="form-control select2" required>
           <option ></option>
           <option @isset($group)
               {{ $group->course_days==1 ? 'selected' : ''}}
           @endisset value="1">Dush-Chor-Jum</option>
           <option  @isset($group)
           {{ $group->course_days==2 ? 'selected' : '' }}
            @endisset value="2">Sesh-Pay-Shan</option>
           <option  @isset($group)
                    {{ $group->course_days==3 ? 'selected' : '' }}
                    @endisset value="3">Xar kuni</option>
       </select>
    </div>

    <div class="form-group{{ $errors->has('time') ? 'has-error' : ''}}">
        {!! Form::label('time', 'Dars vaqti', ['class' => 'control-label']) !!}
        {!! Form::input('time', 'time', null, ('' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
        {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group{{ $errors->has('duration') ? 'has-error' : ''}}">
        {!! Form::label('room_number', 'Xona raqami', ['class' => 'control-label']) !!}
        {!! Form::number('room_number', null,  ['class' => 'form-control', 'required'=>'required']) !!}
        {!! $errors->first('room_number', '<p class="help-block">:message</p>') !!}
    </div>

    <div class="form-group{{ $errors->has('time') ? 'has-error' : ''}}">
        {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
       <select name="status" id="status" class="form-control select2" required>
           <option @isset($group)
               {{ $group->status==1 ? 'selected' : ''}}
           @endisset value="1">Active</option>
            <option @isset($group)
            {{ $group->status==2 ? 'selected' : '' }}
           @endisset value="2"> Bitirgan</option>
       </select>
    </div>
    <div class="form-group">
        <label for="">Oxirgi oyda chiqarilib yuboriladigan qarz miqdori</label>
        {!! Form::input('number', 'last_month_debt', null, (['class' => 'form-control']) )!!}
    </div>

    @if($formMode === 'edit')
    <div class="form-group">
        {!! Form::label('finish_date', 'Yakunlanish sanasi', ['class' => 'control-label']) !!}
        <input type="date" name="end_date" @if(isset($group) and $group->end_date!='')  value="{{ $group->end_date->format('Y-m-d') }}" @endif class="form-control">
    </div>
    @endif

    <div class="form-group">
        {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

