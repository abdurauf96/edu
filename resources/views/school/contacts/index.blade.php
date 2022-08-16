@extends('layouts.school')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Contact</div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th><th>Sarlavha</th><th>Ma'lumotlar</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($contacts as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->title }}</td><td>{!! $item->body !!}</td>
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
