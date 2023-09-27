@extends('layouts.admin')

@section('title')
    Permissions
@endsection

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Permissions</h4>
                    <div class="card-header-form">
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus" aria-hidden="true"></i>Yangi qo'shish</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Roles</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ route('admin.permissions.show', $item->id) }}">{{ $item->name }}</a></td>
                                    <td>
                                        @if($item->roles)
                                            @foreach($item->roles as $role)
                                                <form action="{{ route('admin.permissions.roles.remove', [$item, $role]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-primary rounded p-1 cursor-pointer">{!! $role->name !!}</button>
                                                </form>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-icon btn-info" href="{{ route('admin.permissions.edit', $item->id) }}" title="Edit Permission"><i class="far fa-edit" aria-hidden="true"></i></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => [ route('admin.permissions.destroy', $item->id) ],
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
                        <div class="pagination"> {!! $permissions->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
