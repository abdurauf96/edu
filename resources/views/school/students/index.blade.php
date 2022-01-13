@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('title', 'O`quvchilar')
    
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4> O'quvchilar</h4>
                <div class="card-header-form">
                    <div class="dropdown d-inline mr-2">
                        <button class="btn btn-primary note-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            O'quv yili {{  request()->get('year') ?? ""  }}
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                          <a class="dropdown-item" href="{{ route('students.index', ['year'=>2021]) }}">2021</a>
                          <a class="dropdown-item" href="{{ route('students.index', ['year'=>2022]) }}">2022</a>
                          <a class="dropdown-item" href="{{ route('students.index', ['year'=>2023]) }}">2023</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('students.index') }}">Barchasi</a>
                        </div>
                    </div>
                </div>        
            </div>
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

                                {{-- <th>Rasm</th> --}} 
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td>
                                <td> {{ $item->group->name }} </td>
                                <td> {{ $item->group->course->name }} </td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->address }}</td>

                                {{-- <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td> --}}
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
