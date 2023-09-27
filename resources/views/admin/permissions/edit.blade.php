@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Permission</div>
                <div class="card-body">
                    <a href="{{ route('admin.permissions.index') }}" title="Back">
                        <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </button>
                    </a>
                    <br>
                    <br>

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($permission, [
                        'method' => 'PATCH',
                        'url' => ['/admin/permissions', $permission->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include ('admin.permissions.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 p-2 rounded">
        <h2 class="text-2xl font-semibold">Permission Roles</h2>
        <div class="flex mt-4 p-2">
            @if($permission->roles)
                @foreach($permission->roles as $role)
                    <form action="{{ route('admin.permissions.roles.remove', [$permission, $role]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this role?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-primary rounded p-1 cursor-pointer">{!! $role->name !!}</button>
                    </form>
                @endforeach
            @endif
        </div>

        <div class="max-w-xl mt-6">
            <form method="post" action="{{ route('admin.permissions.roles', $permission) }}">
                @csrf
                <div class="sm:col-span-6">
                    <label for="role" class="block text-sm font-medium text-gray-700"> Permissionlarni rolega biriktirish </label>
                    <select id="role" name="role" class="form-control select2">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('role') <small class="text-red-500">{{ $message }}</small> @enderror
                <div class="sm:col-span-6 pt-3">
                    <button type="submit" class="btn btn-primary">Biriktirish</button>
                </div>
            </form>
        </div>

{{--        <div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">--}}
{{--            {!! Form::label('role', 'Permissionlarni rolega biriktirish: ', ['class' => 'control-label']) !!}--}}
{{--            <select name="role[]" class="form-control select2" multiple data-height="100%" >--}}
{{--                @foreach($roles as $role)--}}
{{--                    <option @isset($userRoles) {{ in_array($role->id, $userRoles) ? 'selected' : '' }} @endisset value="{{ $role->id }}">{{ $role->name }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--        @error('role') <small class="text-red-500">{{ $message }}</small> @enderror--}}
{{--        <div class="sm:col-span-6 pt-3">--}}
{{--            <button type="submit" class="btn btn-primary">Biriktirish</button>--}}
{{--        </div>--}}

    </div>
@endsection

@section('js')
    <script src="{{ asset('admin/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
@endsection
