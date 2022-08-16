@extends('layouts.school')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Darsliklar</div>
                    <div class="card-body">
                        <a href="{{ url('/school/documents/create') }}" class="btn btn-success btn-sm" title="Add New Document">
                            <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish
                        </a>

                        <form method="GET" action="{{ url('/school/documents') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th>
                                        <th>Xujjat nomi</th>
                                        <th>Yuklab olish</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($documents as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><a class="btn btn-info" href="/documents/{{ $item->file }}">Yuklab olish</a></td>
                                        <td>
                                            <a href="{{ url('/school/documents/' . $item->id . '/edit') }}" title="Edit Document"><button class="btn btn-primary btn-xs"><i class="far fa-edit" ></i></button></a>

                                            <form method="POST" action="{{ url('/school/documents' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Document" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
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
