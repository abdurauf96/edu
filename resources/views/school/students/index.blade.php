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
                    <div class="dropdown d-inline mr-2">
                        <button class="btn btn-primary note-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            O'quv yili {{ \Request::segment(4)  ?? ""  }}
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                          <a class="dropdown-item" href="{{ route('school.students.index', 2021) }}">2021</a>
                          <a class="dropdown-item" href="{{ route('school.students.index', 2022) }}">2022</a>
                          <a class="dropdown-item" href="{{ route('school.students.index', 2023) }}">2023</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('school.students.index') }}">Barchasi</a>
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
                                <th>Guruh</th>
                                <th>Kurs</th>
                                <th>QR Code</th>
                                {{-- <th>ID Card</th> --}}
                                <th>To'lov xolati</th>
                                <th>Amallar</th>
                                <th>Davomat</th>
                                <th>Qarz</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $item)

                            <tr>
                                <td>{{ $item->id  }}</td>
                                <td>{{ $item->name }}</td>
                                <td> {{ $item->group->name }} </td>
                                <td> {{ $item->group->course->name }}</td>
                                <td><a class="btn btn-icon btn-info " href="{{ route('downloadQrcode', $item->qrcode) }}"><i class="fas fa-download"></i> </a></td>
                                {{-- <td>
                                    @php if(isset($item->idcard) and  file_exists(public_path().'/admin/images/idcards/'.$item->idcard)) : @endphp
                                        <a class="btn btn-icon btn-primary " href="{{ route('downloadCard', $item->idcard) }}"><i class="fas fa-download"></i> </a>
                                    @else
                                        <a class="btn btn-icon btn-info " href="{{ route('generateStudentCard', $item->id) }}">Generate </a>
                                    @endif
                                </td> --}}
                                <td>@if($item->debt>0) 
                                    <div class="badge badge-danger">{{ number_format($item->debt) }}(qarzdor)</div> 
                                    @elseif($item->debt==0)
                                    <div class="badge badge-success"> {{ number_format(abs($item->debt)) }} Qarzi yo'q </div>
                                    @else
                                    <div class="badge badge-success"> {{ number_format(abs($item->debt)) }} xaqdor </div> 
                                    @endif
                                </td>
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
                                <td>
                                    <a class="btn btn-icon btn-success" href="{{ route('userEvents', ['type'=>'student', 'id'=>$item->id]) }}">Ko'rish</a>
                                    @if($item->getLastEventStatus())
                                    <a class="btn btn-icon btn-danger" href="{{ route('studentEvent', $item->id) }}"> OUT</a>
                                    @else
                                    <a class="btn btn-icon btn-success" href="{{ route('studentEvent', $item->id) }}"> IN</a>
                                    @endif
                                </td>
                                <td>
                                    <form action="/student/pay" method="POST" >
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <input type="number" class="form-control" name="debt" required>
                                            <input type="hidden" class="form-control" name="student_id" value="{{ $item->id }}" >
                                            <span class="input-group-btn">
                                              <button type="submit" class="btn btn-info btn-flat">OK</button>
                                            </span>
                                        </div>
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

@section('js')
<!-- JS Libraies -->
<script src="/admin/assets/bundles/datatables/datatables.min.js"></script>

<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/datatables.js"></script>
@endsection
