@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
@endsection
@section('title', 'O`quvchilar')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4> O'quvchilar</h4>

                <div class="card-header-form">
                    <a class="btn btn-primary" href="{{ route('school.addStudent') }}">Yangi qo'shish</a>
                    <div class="dropdown d-inline mr-2">
                        <button class="btn btn-primary note-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                          <a class="dropdown-item" href="{{ url()->current() }}?type=graduated">Bitirib ketgan</a>
                          <a class="dropdown-item" href="{{ url()->current()}}?type=active">O'qiyotgan</a>
                          <a class="dropdown-item" href="{{ url()->current()}}?type=out">Chiqib ketgan</a>
                          <a class="dropdown-item" href="{{ url()->current() }}?type=grant">Grant</a>
                          <a class="dropdown-item" href="{{ url()->current()}}?type=boys">Bollar</a>
                          <a class="dropdown-item" href="{{ url()->current() }}?type=girls">Qizlar</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ url()->current() }}">Barchasi</a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive ">
                    <table class="table table-bordered table-striped" id="table-1">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>F.I.O</th>
                                <th>Maktab</th>
                                <th>Sinf</th>
                                <th>Guruh</th>
                                <th>Kurs</th>
                                <th>Rasm</th>
                                <th>Status</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $item)

                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->school_number }}</td>
                                <td> {{ $item->class_id }} - sinf </td>
                                <td> {{ $item->group->name }}</td>
                                <td> {{ $item->group->course->name }}</td>

                                <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td>
                                <td> @if($item->status==1)
                                        <div class="badge badge-success">O'qimoqda</div>
                                    @elseif($item->status==2)
                                        <div class="badge badge-danger">Chiqib ketgan</div>
                                    @else
                                        <div class="badge badge-primary">Bitirgan</div>
                                    @endif
                                </td>
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
<script src="/admin/assets/bundles/datatables/datatables.min.js"></script>

<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/datatables.js"></script>
@endsection
