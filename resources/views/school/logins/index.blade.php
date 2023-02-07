@extends('layouts.school')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Logins</div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Username</th> <th>Kirish vaqti</th> <th>IP</th> <th>Longitude</th> <th>Latitude</th> <th>City</th> <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($logins as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->login_at->format('d.m.Y H:i') }}</td>
                                        <td>{{ $item->ip }}</td>
                                        <td>{{ $item->longitude }}</td>
                                        <td>{{ $item->latitude }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>
                                            <form method="POST" action="{{ url('/school/logins' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Login" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
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
