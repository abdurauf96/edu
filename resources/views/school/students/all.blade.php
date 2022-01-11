@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('title', 'Barcha o`quvchilar')
    
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4> Barcha o'quvchilar</h4></div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-bordered table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Guruh</th>
                                <th>Kurs</th>
                                <th>Telefon</th>
                                <th>Manzil</th>
                                <th>O'quv yili</th>
                                <!-- {{-- <th>Rasm</th> --}}  -->
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach ($students as $item)
                            <tr>
                                <td>{{ $item->id  }}</td>
                                <td>{{ $item->name }}</td>
                                    <td> {{ $item->group->name }} </td>
                                <td> {{ $item->group->course->name }} </td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->study_year }}</td>

                                <!-- {{-- <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td> --}} -->
                                <td>
                                    <a href="{{ route('students.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('students.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/students', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        @if(Auth::user()->hasRole('admin'))
                                        {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-icon',
                                                'title' => 'Delete Student',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        @endif
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

@endsection

@section('js')
<!-- JS Libraies -->
<script src="/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/assets/bundles/datatables/datatables.min.js"></script>

<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/datatables.js"></script>
@endsection
