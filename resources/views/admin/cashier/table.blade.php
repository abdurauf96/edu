@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">Filter 
                <hr>
                @foreach ($courses as $course)
                <a href="?course_id={{ $course->id }}" class="btn {{ \Request::get('course_id')==$course->id? 'btn-primary' : 'btn-info' }} btn-sm" title="Add New Payment">
                    {{ $course->name }}
                </a>    
                @endforeach
                <hr>
                @foreach ($months as $month)
                <a href="?month_id={{ $month->id }}" class="btn btn-md {{ \Request::get('month_id')==$month->id? 'btn-primary' : 'btn-info' }} " >
                    {{ $month->name }}
                </a>    
                @endforeach
            </div>
            <div class="box-body">
                
                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">
                    
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>O'quvchi</th>
                                <th>Guruh</th>
                                <th>O'qituvchi</th>
                                <th>To'lov miqdori</th>
                                <th>To'lov turi</th>
                                <th>To'lov oyi</th>
                                <th>Sana</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->student->group->name }}</td>
                                <td>{{ $item->student->group->teacher->name }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->month->name}} uchun</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ url('/admin/payments/' . $item->id) }}" title="View Payment"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                    <a href="{{ url('/admin/payments/' . $item->id . '/edit') }}" title="Edit Payment"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/admin/payments', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Payment',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
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
<script type="text/javascript">
    $(function () {
      $("#example1_wrapper").dataTable();
    })
</script>
@endsection