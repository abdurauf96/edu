@extends('layouts.school')

@section('content')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Classes</div>
                    <div class="card-body">
                        <a href="{{ url('/school/classes/create') }}" class="btn btn-success btn-sm" title="Add New Class">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/school/classes') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($classes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ url('/school/classes/' . $item->id) }}" title="View Organization"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/school/classes/' . $item->id . '/edit') }}" title="Edit Organization"><button class="btn btn-primary btn-xs"><i class="far fa-edit" aria-hidden="true"></i></button></a>
                                            <form method="POST" action="{{ url('/school/classes' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Organization" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                            </form>
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
