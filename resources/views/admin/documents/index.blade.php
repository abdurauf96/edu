@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Darsliklar</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/documents/create') }}" class="btn btn-success btn-sm" title="Add New Document">
                            <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish
                        </a>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Darslik nomi</th>
                                        <th>Darslik fayli</th>
                                        <th>Darslik uchun ssilka</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($documents as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><a class="btn btn-info" href="{{ $item->file !='' ? '/documents/'.$item->file : '#' }}">Yuklab olish</a></td>
                                        <td><a href="{{ $item->link }}"> Darslikni ko'rish </a></td>
                                        <td>
                                            <a href="{{ url('/admin/documents/' . $item->id . '/edit') }}" title="Edit Document"><button class="btn btn-primary btn-xs"><i class="far fa-edit" ></i></button></a>

                                            <form method="POST" action="{{ url('/admin/documents' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
