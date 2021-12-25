@extends('layouts.school')

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
                        <a href="{{ route('roles.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    
                
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th><th>Name</th><th>Label</th><th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><a href="{{ url('/school/roles', $item->id) }}">{{ $item->name }}</a></td><td>{{ $item->label }}</td>
                                    <td>
                                        <a class="btn btn-icon btn-primary" href="{{ url('/school/roles/' . $item->id) }}" title="View Role"><i class="fas fa-eye" aria-hidden="true"></i></a>
                                        <a class="btn btn-icon btn-info" href="{{ url('/school/roles/' . $item->id . '/edit') }}" title="Edit Role"><i class="far fa-edit" aria-hidden="true"></i></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/school/roles', $item->id],
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
