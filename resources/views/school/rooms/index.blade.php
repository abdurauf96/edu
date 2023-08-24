@extends('layouts.school')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Xonalar</div>
                    <div class="card-body">
                        <a href="{{ url('/school/rooms/create') }}" class="btn btn-success btn-sm" title="Add New Room">
                            <i class="fa fa-plus" aria-hidden="true"></i> Yangi yaratish
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Xona raqami</th><th>Xona sig'imi</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($rooms as $item)
                                    <tr>
                                        <td>{{ $loop->iteration  }}</td>
                                        <td>{{ $item->room_number }}</td><td>{{ $item->room_capacity }}</td>
                                        <td>
                                            <a href="{{ url('/school/rooms/' . $item->id) }}" title="View Room"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/school/rooms/' . $item->id . '/edit') }}" title="Edit Room"><button class="btn btn-primary btn-xs"><i class="far fa-edit" aria-hidden="true"></i></button></a>

                                            <form method="POST" action="{{ url('/school/rooms' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Room" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
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
