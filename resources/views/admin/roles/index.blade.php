@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">Darajalar</div>
            <div class="box-body">
                <a href="{{ url('/admin/roles/create') }}" class="btn btn-success btn-sm" title="Add New Role">
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
                        @foreach($roles as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td><a href="{{ url('/admin/roles', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->label }}</td>
                                <td>
                                    <a href="{{ url('/admin/roles/' . $item->id) }}" title="View Role"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    <a href="{{ url('/admin/roles/' . $item->id . '/edit') }}" title="Edit Role"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/admin/roles', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
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
@endsection
