@extends('layouts.school')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Tashkilotlar</div>
                <div class="card-body">
                    <a href="{{ url('/school/organizations/create') }}" class="btn btn-success" title="Add New Organization">
                        <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tashkilot</th>
                                    <th>Xodimlar soni</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($organizations as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->staffs()->count() }}</td>
                                    <td>
                                        <a href="{{ url('/school/organizations/' . $item->id) }}" title="View Organization"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                        <a href="{{ url('/school/organizations/' . $item->id . '/edit') }}" title="Edit Organization"><button class="btn btn-primary btn-xs"><i class="far fa-edit" aria-hidden="true"></i></button></a>

                                        <form method="POST" action="{{ url('/school/organizations' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
