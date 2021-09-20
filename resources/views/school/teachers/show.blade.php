@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
           
            <div class="box-body">

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
                            <tr><th> Mutahasisligi </th><td> @foreach ($teacher->courses as $course)
                                {{ $course->name }}  @if(!$loop->last) , @endif
                            @endforeach</td></tr>
                        </tbody>
                    </table>
                </div>

                <hr>
                <div class="box">
                   
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                      <table class="table table-striped">
                        <tbody><tr>
                          <th style="width: 10px">#</th>
                          <th>Jami o'quvchilar soni</th>
                          <th>{{ count($teacher->students) }} ta</th>
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
                          <td><span class="badge bg-red">{{ count($teacher->is_debt_students()) }}ta</span></td>
                        </tr>
                        <tr>
                          <td>2.</td>
                          <td>To'lov qilganlar</td>
                          <td>
                            <div class="progress progress-xs">
                              <div class="progress-bar progress-bar-green" style="width: {{ 100- $teacher->get_percent_debt_students() }}%"></div>
                            </div>
                          </td>
                          <td><span class="badge bg-green">{{ count($teacher->students)-count($teacher->is_debt_students()) }} ta</span></td>
                        </tr>
                      </tbody></table>
                    </div>
                    <!-- /.box-body -->
                </div>

                <hr>
                <div class="students-title">
                    <p>{{ $teacher->name }} o'quvchilari</p>
                </div>
                
                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">
                    
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
                                <td>@if($student->is_debt()) <span class="label label-danger">Qarzi bor </span> @else <span class="label label-success"> Qarzi yo'q</span>  @endif</td>
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
@endsection

@section('js')
<script type="text/javascript">
    $(function () {
      $("#example1_wrapper").dataTable();
    })
</script>
@endsection