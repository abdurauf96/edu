@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
@endsection
    {!! Form::label('organization_id', 'Tashkilot', ['class' => 'control-label']) !!}
    <select class="select2 form-control" name="organization_id" id="">
        @foreach ($organizations as $organization )
            <option  @isset($staff) {{ $staff->organization_id==$organization->id ? 'selected' : '' }} @endisset value="{{ $organization->id }}">{{ $organization->name }}</option>
        @endforeach
    </select>
    <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'F.I.O', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('position') ? 'has-error' : ''}}">
        {!! Form::label('position', 'Lavozimi', ['class' => 'control-label']) !!}
        {!! Form::text('position', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('position', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
        {!! Form::label('phone', 'Telefon', ['class' => 'control-label']) !!}
        {!! Form::text('phone', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('year') ? 'has-error' : ''}}">
        {!! Form::label('year', 'Tug`ilgan yili', ['class' => 'control-label']) !!}
        {!! Form::date('year', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('year', '<p class="help-block">:message</p>') !!}
    </div>


    <div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
        {!! Form::label('image', 'Rasmi', ['class' => 'control-label']) !!}
        {!! Form::file('image', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('passport') ? 'has-error' : ''}}">
        {!! Form::label('passport', 'Passport malumotlari', ['class' => 'control-label']) !!}
        {!! Form::text('passport', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('passport', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group{{ $errors->has('addres') ? 'has-error' : ''}}">
        {!! Form::label('addres', 'Manzili', ['class' => 'control-label']) !!}
        {!! Form::text('addres', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('addres', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group">
        {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
    </div>

    @section('js')
    <script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
    @endsection