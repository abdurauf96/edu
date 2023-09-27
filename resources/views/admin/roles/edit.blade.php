@extends('layouts.admin')

@section('title')
    Tahrirlash
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-12">
            <div class="card">
                <div class="card-header">Tahrirlash</div>
                <div class="card-body">
                    <a href="{{ url('/admin/roles') }}" title="Back">
                        <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back
                        </button>
                    </a>
                    <br/>
                    <br/>

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($role, [
                        'method' => 'PATCH',
                        'url' => ['/admin/roles', $role->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include ('admin.roles.form', ['formMode' => 'edit'])

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Role Permissions</div>
                <div class="card-body">
                    @if($role->permissions)
                        @foreach($role->permissions as $permission)
                            <form action="{{ route('admin.roles.permissions.revoke', [$role, $permission]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-success rounded p-1 cursor-pointer">{!! $permission->name !!}</button>
                            </form>
                        @endforeach
                    @endif
                </div>
                <div class="card-footer">
                    <form method="post" action="{{ route('admin.roles.permissions', $role) }}">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="permission" class="block text-sm font-medium text-gray-700">Name</label>
                            <select id="permission" name="permission" class="form-control select2">
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('permission') <small class="text-red-500">{{ $message }}</small> @enderror
                        <div class="sm:col-span-6 pt-5">
                            <button type="submit" class="btn btn-primary rounded-md">Biriktirish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('admin/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
@endsection
