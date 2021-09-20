@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">Permissions</div>
            <div class="box-body">
                <a href="{{ url('/school/permissions/create') }}" class="btn btn-success add_new btn-sm" title="Add New Permission">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                </a>


                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th><th>Name</th><th>Label</th><th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><a href="{{ url('/school/permissions', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->label }}</td>
                                <td>
                                    <a href="{{ url('/school/permissions/' . $item->id) }}" title="View Permission"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    <a href="{{ url('/school/permissions/' . $item->id . '/edit') }}" title="Edit Permission"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/permissions', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Permission',
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
@endsection
