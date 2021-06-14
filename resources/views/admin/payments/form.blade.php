<div class="col-md-6">
    <div class="form-group{{ $errors->has('student_id') ? 'has-error' : ''}}">
        {!! Form::label('student_id', 'O`quvchilar', ['class' => 'control-label']) !!}
        <select class="form-control select2" name="student_id" placeholder="oquvchi" required>
           <option></option>
            @foreach ($students as $student)
            <option @isset($payment)
                {{ $payment->student_id==$student->id ? 'selected' : '' }}
            @endisset value='{{ $student->id }}'>{{ $student->name }}</option> 
            @endforeach
        </select>
    </div>
    <div class="form-group{{ $errors->has('course_id') ? 'has-error' : ''}}">
        {!! Form::label('course_id', 'Kurslar', ['class' => 'control-label']) !!}
        <select id="courses" name="course_id" class="form-control select2 " required>
            <option></option>
            @foreach ($courses as $course)
                <option @isset($payment)
                {{ $payment->course_id==$course->id ? 'selected' : '' }}
            @endisset value="{{ $course->id }}">{{ $course->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group{{ $errors->has('group_id') ? 'has-error' : ''}}">
        {!! Form::label('group_id', 'Guruhlar', ['class' => 'control-label']) !!}
        <select name="group_id" id="groups" class="form-control select2" required >
            <option></option>
            @foreach ($groups as $group)
                <option @isset($payment)
                {{ $payment->group_id==$group->id ? 'selected' : '' }}
            @endisset value="{{ $group->id }}" data-course_id="{{ $group->course->id }}">{{ $group->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group{{ $errors->has('month') ? 'has-error' : ''}}">
        {!! Form::label('month', 'Qaysi oy uchun', ['class' => 'control-label']) !!}
        <select name="month_id" class="form-control select2" required >
            <option></option>
            
            @foreach ($months as $month)
            <option @if(isset($payment))  {{ $payment->month==$month->number? 'selected' : '' }} @endif value="{{ $month->number }}">{{ $month->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-md-6">
    <div class="form-group{{ $errors->has('amount') ? 'has-error' : ''}}">
        {!! Form::label('amount', 'To`lov miqdori', ['class' => 'control-label']) !!}
        {!! Form::number('amount', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
        {!! Form::label('type', 'To`lov turi', ['class' => 'control-label']) !!}
        <select name="type"  class="form-control select2" required >
            <option></option>
            <option @isset($payment)
                {{ $payment->type=='Naqd'? 'selected' : '' }}
            @endisset value="Naqd">Naqd</option>
            <option @isset($payment)
            {{ $payment->type=='Karta'? 'selected' : '' }}
        @endisset value="Karta">Karta orqali</option>
            <option @isset($payment)
            {{ $payment->type=='Bank'? 'selected' : '' }}
        @endisset value="Bank">Bank orqali</option>
        </select>
    
    </div>
    <div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('description', 'To`lov haqida qisqacha', ['class' => 'control-label']) !!}
       <textarea name="description" class="form-control" id="" cols="30" rows="2">@isset($payment)
        {{ $payment->description }}
            @endisset
        </textarea>
        
    </div>
    <div class="form-group">
        {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'To`lovni amalga oshirish', ['class' => 'btn btn-success']) !!}
    </div>
</div>




@section('js')
    <script>
         $('.select2').select2({
            placeholder: "Tanlang...",
            allowClear: true
         });

         $('#courses').change(function() {
            
            var course_id=$(this).val();
            console.log(course_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                data: {course_id:course_id},
                url: '/get-groups',
                success:function(data){
                    $('#groups').html(data);
                }
            })
       
        })

    </script>
@endsection