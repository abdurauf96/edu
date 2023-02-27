@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datepicker/css/yearpicker.css" />
@endsection


<div class="form-group">
    <label for="">Guruh</label>
    <select name="group_id" id="" class="form-control">
        @foreach($groups as $gr)
            <option @isset($student) {{ $student->group_id==$gr->id ? 'selected' : '' }} @endisset value="{{ $gr->id }}">
                {{ $gr->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'F.I.O', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="invalid-feedback">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
    {!! Form::label('phone', 'Telefon raqami', ['class' => 'control-label']) !!}
    {!! Form::text('phone', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('phone', '<p class="invalid-feedback">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('year') ? 'has-error' : ''}}" style="width:300px">
    {!! Form::label('year', 'Tug\'ilgan yili', ['class' => 'control-label']) !!}
    {!! Form::date('year', null, ('required' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
    {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <label for="">Tuman, SHahar</label>
    <select name="district_id" class="form-control select2" required>
        @foreach ($districts as $district)
            <option @isset($student) {{ $student->district_id==$district->id ? 'selected' : '' }} @endisset value="{{ $district->id }}">{{ $district->name }} </option>
        @endforeach
    </select>
</div>

<div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Manzili', ['class' => 'control-label']) !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'required'=>'required'] ) !!}
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <label for="">O'qish joyi</label> &nbsp; &nbsp;
    <input type="radio" value="1"  @if(isset($student))
    {{ $student->study_type==1 ? 'checked' : '' }} @else checked
           @endif name="study_type"  > Maktab &nbsp;&nbsp;
    <input type="radio" @isset($student)
    {{ $student->study_type==2 ? 'checked' : '' }}
    @endisset value="2" name="study_type"> Kolej &nbsp;&nbsp;
    <input type="radio" @isset($student)
    {{ $student->study_type==3 ? 'checked' : '' }}
    @endisset value="3" name="study_type"> Universitet &nbsp;&nbsp;
    <input type="radio" @isset($student)
    {{ $student->study_type==4 ? 'checked' : '' }}
    @endisset value="4" name="study_type"> Ishchi
</div>

<div class="form-group">
    <label>O'qish turi</label> <br>
    <div class="vars" style="display: flex; flex-direction:column">
        <div class="">
            <input type="radio" name="type" value="1" @if(isset($student))
            {{ $student->type==1 ? 'checked' : '' }} @else checked
            @endif >
            <span for="">Oddiy</span>
        </div>

        <div class="">
            <input type="radio" value="0.9"  @if(isset($student))
            {{ $student->type==0.9 ? 'checked' : '' }}
            @endif name="type"  >
            <span for="">Grant (10%)</span>
        </div>
        <div class="">
            <input type="radio" value="0.85"  @if(isset($student))
            {{ $student->type==0.85 ? 'checked' : '' }}
            @endif name="type"  >
            <span for="">Grant (15%)</span>
        </div>
        <div class="">
                <input type="radio" value="0.7"  @if(isset($student))
                    {{ $student->type==0.7 ? 'checked' : '' }}
                @endif name="type"  >
                <span for="">Grant (30%)</span>
        </div>
        <div>
            <input type="radio" value="0.5"  @if(isset($student))
                {{ $student->type==0.5 ? 'checked' : '' }}
            @endif name="type"  >
            <span for="">Grant (50%)</span>
        </div>
        <div class="">
            <input type="radio" value="0"  @if(isset($student))
                {{ $student->type==0 ? 'checked' : '' }}
            @endif name="type"  >
            <span for="">Grant (100%)  </span>
        </div>
    </div>
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

<div class="form-group{{ $errors->has('passport') ? 'has-error' : ''}}">
    {!! Form::label('passport', 'Passport seriya va raqami', ['class' => 'control-label']) !!}
    {!! Form::text('passport', null,['class' => 'form-control']) !!}
    {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Rasm', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group" >
    {!! Form::label('start_date', 'Dars boshlash sanasi', ['class' => 'control-label']) !!}
    <input type="date" name="start_date" required @if(isset($student) and $student->start_date!='')  value="{{ $student->start_date->format('Y-m-d') }}" @endif class="form-control">
</div>

<div class="form-group">
    <label for="">Status</label>
    <select  name="status" class="form-control select2" id="status" required>
        <option @isset ($student)
            {{ $student->status==1 ? 'selected': '' }}
        @endisset  value="1">O'qimoqda</option>
        <option @isset ($student)
        {{ $student->status==0 ? 'selected': '' }}
    @endisset value="0">Bitirib ketgan</option>
    <option @isset ($student)
    {{ $student->status==2 ? 'selected': '' }}
    @endisset value="2">Chiqib ketgan</option>
    </select>
</div>
0
<div class="form-group" @if(!$errors->has('outed_date')) style="width:300px; display: none" @endif  id="outed_date" >
    {!! Form::label('outed_date', 'Chiqib ketgan sanasi', ['class' => 'control-label']) !!}
    {!! Form::date('outed_date', null, ['class' => 'form-control']) !!}
    @error('outed_date') <div class="invalid-feedback">Maydon to'ldirilishi shart</div> @enderror
</div>
@if($formMode === 'create')
<div class="form-group">
    <label for="">Birinchi oy uchun to'lov miqdori</label>
    {!! Form::input('number', 'first_month_debt', null, (['class' => 'form-control']) )!!}
</div>
@endif
<div class="form-group">
        {!! Form::label('future_work', "Kursni tamomlab ishga kirgan joyi", ['class' => 'control-label']) !!}
        {!! Form::text('future_work', null,  ['class' => 'form-control']) !!}
        {!! $errors->first('future_work', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
</div>


@section('js')
<script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
<!-- Moment Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
 <!-- Year Picker Js -->
<script src="/admin/assets/bundles/datepicker/js/yearpicker.js"></script>
<script>
  $(".yearpicker").yearpicker({
      startYear: 2019,
      endYear: 2050,
   });

   $('#status').change(function(){
       if($(this).val()==2){
            $('#outed_date').css('display', 'block');
       }else{
            $('#outed_date').css('display', 'none');
       }
   })
</script>
@endsection
