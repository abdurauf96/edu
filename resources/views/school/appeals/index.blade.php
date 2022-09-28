@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">@endsection
@section('title', 'Arizalar')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4> Ariza qoldirgan o'quvchilar</h4>
                <div class="card-header-form">
                    <a class="btn btn-icon icon-left btn-primary" href="{{ route('appeals.create') }}">
                        <i class="fas fa-user-plus"></i> Yangi qo'shish</a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive ">
                    <table class="table table-bordered table-striped" id="table-1">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Telefon</th>
                                <th>Manzil</th>
                                <th>Yo'nalish</th>
                                <th>Ariza turi</th>

                                <td>Sana</td>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($appeals as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td>
                                <td> {{ $item->phone }} </td>
                                <td> {{ $item->address }} </td>
                                <td>{{ $item->course->name ?? ''}}</td>
                                <td>{{ $item->type }} orqali</td>

                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('appeals.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('appeals.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/appeals', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        @if(Auth::user()->hasRole('admin'))
                                        {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-icon',
                                                'title' => 'Delete Appeal',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        @endif
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $appeals->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- JS Libraies -->
<script src="/admin/assets/bundles/datatables/datatables.min.js"></script>

<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/datatables.js"></script>
@endsection
