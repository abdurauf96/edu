@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
@endsection
<div class="col-md-6">
    <div class="form-group{{ $errors->has('student_id') ? 'has-error' : ''}}">
        {!! Form::label('student_id', 'To\'lovchi', ['class' => 'control-label']) !!}
        <select class="form-control select2" name="student_id" placeholder="oquvchi" required>
           <option></option>
            @foreach ($students as $student)
            <option @isset($payment)
                {{ $payment->student_id==$student->id ? 'selected' : '' }}
            @endisset value='{{ $student->id }}'>{{ $student->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group{{ $errors->has('amount') ? 'has-error' : ''}}">
        {!! Form::label('amount', 'To`lov miqdori', ['class' => 'control-label']) !!}
        {!! Form::number('amount', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="col-md-6">

    <div class="form-group{{ $errors->has('type') ? 'has-error' : ''}}">
        {!! Form::label('type', 'To`lov turi', ['class' => 'control-label']) !!}
        <select name="type"  class="form-control select2" required >
            <option></option>
            <option @isset($payment)
                {{ $payment->type=='Naqd'? 'selected' : '' }}
            @endisset value="Naqd">Naqd</option>
            <option @isset($payment)
            {{ $payment->type=='paynet'? 'selected' : '' }}
        @endisset value="paynet">Paynet</option>
            <option @isset($payment)
            {{ $payment->type=='payme'? 'selected' : '' }}
        @endisset value="payme">Payme</option>
        <option @isset($payment)
            {{ $payment->type=='click'? 'selected' : '' }}
        @endisset value="click">Click</option>
            <option @isset($payment)
                    {{ $payment->type=='terminal'? 'selected' : '' }}
                    @endisset value="terminal">Terminal</option>
        </select>

    </div>

    <div class="form-group">
        <label for="" class="control-label">To'lov sanasi</label>
        <input type="date" name="created_at" class="form-control" required>
    </div>

    <div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
        {!! Form::label('description', 'To`lov haqida qisqacha', ['class' => 'control-label']) !!}
       <textarea name="description" class="form-control" id="" cols="30" required rows="2">@isset($payment)
        {{ $payment->description }}
            @endisset
        </textarea>

    </div>
    <div class="form-group">
        {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'To`lovni amalga oshirish', ['class' => 'btn btn-success']) !!}
    </div>
</div>
@section('js')
<script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
@endsection
