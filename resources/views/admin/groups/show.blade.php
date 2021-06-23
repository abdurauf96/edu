@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
           
            <div class="box-body">

                <a href="{{ url('/admin/groups') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                <a href="{{ url('/admin/groups/' . $group->id . '/edit') }}" title="Edit Group"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/groups', $group->id],
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
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>ID</th><td>{{ $group->id }}</td>
                            </tr>
                            <tr><th> Nomi </th><td> {{ $group->name }} </td></tr><tr><th> O'qituvchi </th><td> {{ $group->teacher->name }} </td></tr><tr><th> Kurs </th><td> {{ $group->course->name }} </td></tr>
                            <tr><th> Darslar boshlanish sanasi </th><td> {{ $group->start_date }} </td></tr>
                            <tr><th> Darslar yakunlanish sanasi </th><td> {{ $group->end_date }} </td></tr>
                            <tr><th> Darslar davomiyligi </th><td> {{ $group->duration }} </td></tr>
                            <tr><th> Dars vaqti </th><td> {{ $group->time }} </td></tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="students-title">
                    <p>Guruh o'quvchilari</p>
                
                    <a class="btn btn-success" href="{{ url('/admin/groups/' . $group->id . '/add-student') }}" title="Add Student"><i class="fa fa-user-plus" aria-hidden="true"></i> O'quvchi qo'shish</a>
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
                                <th>Code</th> 
                                <th>Rasm</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($group->students as $student)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->address }}</td>
                                <td>{{ $student->year }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->passport }}</td>
                                <td>{{ $student->code }}</td>
                                <td><img src="/admin/images/students/{{ $student->image }}" width="100" alt=""></td>
                                <td>
                                    
                                    <a href="{{ url('/admin/students/' . $student->id . '/edit?group_id='.$group->id) }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    <a href="{{ url('/admin/groups/'.$group->id.'/student/'.$student->id) }}" title="Delete student from group"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
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
<script type="text/javascript">
    $(function () {
      $("#example1_wrapper").dataTable();
    })
</script>
@endsection