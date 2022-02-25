@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datepicker/css/yearpicker.css" />
@endsection

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
    {!! Form::date('year', null, ('required' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
    {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('address') ? 'has-error' : ''}}">
    {!! Form::label('address', 'Manzili', ['class' => 'control-label']) !!}
    {!! Form::text('address', null, ('required' == 'required') ? ['class' => 'form-control'] : ['class' => 'form-control']) !!}
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
    <label>O'qish turi</label> <br>
    <div class="vars" style="display: flex; flex-direction:column">
        <div class="">
            <input type="radio" name="type" value="1" @if(isset($student))
            {{ $student->type==1 ? 'checked' : '' }} @else checked
            @endif >
            <span for="">Oddiy</span> 
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
            <span for="">Grant (100%)</span>
        </div>
    </div>
</div>

<div class="form-group{{ $errors->has('passport') ? 'has-error' : ''}}">
    {!! Form::label('image', 'Rasm', ['class' => 'control-label']) !!}
    {!! Form::file('image', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('study_year1|}=[-p0 ,
]') ? 'has-error' : ''}}">
    {!! Form::label('study_year', "O'quv yili", ['class' => 'control-label']) !!}
    {!! Form::text('study_year', null, ('required' == 'required') ? ['class' => 'form-control yearpicker', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('study_year', '<p class="help-block">:message</p>') !!}
</div>

@isset($group)
<input type="hidden" value="{{ $group->id }}" name="group_id">
@endisset
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

<div class="form-group" style="width:300px; display: none" id="outed_date">
    {!! Form::label('outed_date', 'Chiqib ketgan sanasi', ['class' => 'control-label']) !!}
    {!! Form::date('outed_date', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group" style="width:300px; display: none" id="finished_date">
    {!! Form::label('finished_date', 'Bitirib ketgan sanasi', ['class' => 'control-label']) !!}
    {!! Form::date('finished_date', null, ['class' => 'form-control']) !!}
</div>

<input type="hidden" value="{{ url()->previous() }}" name="last_route">
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
            $('#finished_date').css('display', 'none');
       } else if($(this).val()==0){
            $('#finished_date').css('display', 'block');
            $('#outed_date').css('display', 'none');
       }else{
            $('#outed_date').css('display', 'none');
            $('#finished_date').css('display', 'none');
       }
   })
</script>
@endsection
