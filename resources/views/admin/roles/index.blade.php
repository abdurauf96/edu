@extends('layouts.admin')

@section('title')
    Roles
@endsection

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> Darajalar </h4>
                    <div class="card-header-form">
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Guard name</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ route('admin.roles.show', $item->id) }}">{{ $item->name }}</a></td>
                                    <td>{{ $item->guard_name }}</td>
                                    <td>
                                        @if($item->permissions)
                                            @foreach($item->permissions as $permission)
                                                <form action="{{ route('admin.roles.permissions.revoke', [$item, $permission]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-success rounded p-1 cursor-pointer">{!! $permission->name !!}</button>
                                                </form>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-info" href="{{ url('/admin/roles/' . $item->id . '/edit') }}" title="Edit Role"><i class="far fa-edit" aria-hidden="true"></i></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/admin/roles', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-icon btn-danger',
                                                    'title' => 'Delete Role',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection