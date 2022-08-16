@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Contact</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/contacts/create') }}" class="btn btn-success btn-sm" title="Add New Contact">
                            <i class="fa fa-plus" aria-hidden="true"></i> Yangi yaratish
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Sarlavha</th><th>Ma'lumotlar</th><th>Amallar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->title }}</td><td>{!! $item->body !!}</td>
                                        <td>
                                            <a href="{{ url('/admin/contacts/' . $item->id) }}" title="View Contact"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/admin/contacts/' . $item->id . '/edit') }}" title="Edit Contact"><button class="btn btn-primary btn-xs"><i class="far fa-edit" aria-hidden="true"></i></button></a>

                                            <form method="POST" action="{{ url('/admin/contacts' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete Contact" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
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
