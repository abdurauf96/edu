@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/izitoast/css/iziToast.min.css">
@endsection
@section('title', 'Ko`rish')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ url('/school/groups') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/school/groups/' . $group->id . '/edit') }}" title="Edit Group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['school/groups', $group->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Group',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>
                <div class="table-responsive">
                    <table class="table" >
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $group->id }}</td>
                            </tr>
                            <tr><th> Nomi </th><td> {{ $group->name }} </td></tr><tr><th> O'qituvchi </th><td> {{ $group->teacher_name }} </td></tr><tr><th> Kurs </th><td> {{ $group->course_name }} </td></tr>
                            <tr><th> Darslar boshlanish sanasi </th><td> {{ $group->start_date }} </td></tr>
                            <tr><th> Darslar yakunlanish sanasi </th><td> {{ $group->end_date }} </td></tr>
                            <tr><th> Xona </th><td> {{ $group->room_number }} </td></tr>
                            <tr><th> Dars kunlari </th><td>
                                    @switch($group->course_days)
                                        @case(1)
                                            Dush/Chor/Juma @break
                                        @case(2)
                                            Sesh/Pay/Shan @break
                                        @case(3)
                                            Dush/Sesh/Chor/Pay/Juma @break
                                        @endswitch
                                </td></tr>
                            <tr><th> Dars vaqti </th><td> {{ $group->time }} </td></tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="students-title card-header">
                    <h4>Guruh o'quvchilari</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped " id="table-1">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>F.I.O</th>
                                <th>Dars boshlagan sanasi</th>
                                <th>Telefon</th>
                                <th>To'lov holati</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($group->students as $student)
                            <tr>
                                <td>{{ $student->id  }}</td>
                                <td><a href="{{ route('students.show', $student->id) }}">{{ $student->name }}</a></td>
                                <td>{{ $student->start_date }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>@if($student->debt>0) <div class="badge badge-danger">{{ number_format($student->debt) }}(qarzdor)</div> @else <div class="badge badge-success"> qarzi yo'q </div>  @endif</td>
                                <td>
                                    <a href="{{ url('/school/students/' . $student->id . '/edit') }}" title="Edit Student"><button class="btn btn-icon btn-info"><i class="far fa-edit"></i></button></a>
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

@endsection

