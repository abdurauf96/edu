@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
@endsection
@section('title', 'Ko`rish')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-body">

                <a href="{{ url('/school/teachers') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/school/teachers/' . $teacher->id . '/edit') }}" title="Edit Teacher"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/teachers', $teacher->id],
                    'style' => 'display:inline'
                ]) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> O`chirish', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-sm',
                            'title' => 'Delete Teacher',
                            'onclick'=>'return confirm("Confirm delete?")'
                    ))!!}
                {!! Form::close() !!}
                <br/>
                <br/>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $teacher->id }}</td>
                            </tr>
                            <tr><th> F.I.O </th><td> {{ $teacher->name }} </td></tr>
                            <tr><th> Tug'ilgan yili </th><td> {{ $teacher->birthday }} </td></tr>
                            <tr><th> Manzili </th><td> {{ $teacher->address }} </td></tr>
                            <tr><th> Telefon raqami </th><td> {{ $teacher->phone }} </td></tr>
                            <tr><th> Status </th><td> {{ $teacher->status == 1 ? 'Faol' : 'Faol emas' }} </td></tr>
                            <tr><th> Mutahasisligi </th><td> @foreach ($teacher->courses as $course)
                                {{ $course->name }}  @if(!$loop->last) , @endif
                            @endforeach</td></tr>
                        </tbody>
                    </table>
                </div>

                <hr>
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body no-padding">
                      <table class="table table-striped">
                        <tbody><tr>
                          <th style="width: 10px">#</th>
                          <th>Jami o'quvchilar soni</th>
                          <th>{{ $teacher->students_count }} ta</th>
                          <th style="width: 40px"></th>
                        </tr>
                        <tr>
                          <td>1.</td>
                          <td>Qarzdorlar</td>
                          <td>
                            <div class="progress progress-xs">
                              <div class="progress-bar progress-bar-danger" style="width: {{ $teacher->get_percent_debt_students() }}%"></div>
                            </div>
                          </td>
                          <td><span class="badge bg-red">{{ $teacher->debt_students_count }}ta</span></td>
                        </tr>
                        <tr>
                          <td>2.</td>
                          <td>To'lov qilganlar</td>
                          <td>
                            <div class="progress progress-xs">
                              <div class="progress-bar progress-bar-green" style="width: {{ 100- $teacher->get_percent_debt_students() }}%"></div>
                            </div>
                          </td>
                          <td><span class="badge bg-green">{{ $teacher->students_count - $teacher->debt_students_count }} ta</span></td>
                        </tr>
                      </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>

                <hr>
                <div class="card">
                    <div class="card-header">
                      <h4>{{ $teacher->name }} o'quvchilari</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive  ">
                            <table class="table table-bordered table-striped " id="table-1">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>F.I.O</th>
                                        <th>Manzil</th>
                                        <th>Tug'ilgan yili</th>
                                        <th>Telefon</th>
                                        <th>Passport</th>
                                        <th>Xolati</th>
                                        <th>Rasm</th>
                                        {{-- <th>Amallar</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($teacher->students as $student)
                                    <tr>
                                        <td>{{ $loop->iteration  }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->address }}</td>
                                        <td>{{ $student->year }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->passport }}</td>
                                        <td>@if($student->debt>0) <div class="badge badge-danger">Qarzi bor ({{ $student->debt }}) </div> @else <div class="badge badge-success"> Qarzi yo'q</div>  @endif</td>
                                        <td><img src="/admin/images/students/{{ $student->image }}" width="100" alt=""></td>
                                        {{-- <td>

                                            <a href="{{ url('/school/students/' . $student->id . '/edit') }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>

                                        </td>
                                    </tr> --}}
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="/admin/assets/bundles/datatables/datatables.min.js"></script>
    <script src="/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
    <script src="/admin/assets/js/page/datatables.js"></script>

@endsection
