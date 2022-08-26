<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    {!! Form::label('email', 'Email: ', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    {!! Form::label('password', 'Password: ', ['class' => 'control-label']) !!}
    @php
        $passwordOptions = ['class' => 'form-control'];
        if ($formMode === 'create') {
            $passwordOptions = array_merge($passwordOptions, ['required' => 'required']);
        }
    @endphp
    {!! Form::password('password', $passwordOptions) !!}
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">
    {!! Form::label('role', 'Role: ', ['class' => 'control-label']) !!}
    <select name="roles[]" class="form-control" multiple data-height="100%" >
        @foreach($roles as $role)
            <option @isset($userRoles) {{ in_array($role->id, $userRoles) ? 'selected' : '' }} @endisset value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label class="control-label" for="">O'quv markaz  </label>
    <select name="school_id" id="" class="form-control">
        @foreach ($schools as $school)
        <option @isset($user) {{ $user->school_id==$school->id ? 'selected' : '' }} @endisset value="{{ $school->id }}">{{ $school->company_name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Yangilash' : 'Saqlash', ['class' => 'btn btn-primary']) !!}
</div>
