@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4> Bot orqali ariza qoldirgan o'quvchilar</h4>
        
            </div>
            <div class="card-body">

                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                               
                                <th>Telefon</th>
                                <th>Kurs</th>

                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($botStudents as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->fio }}</td>
                                <td> {{ $item->phone }} </td>
                                <td> {{ $item->course->name }} </td>
                               
                                <td>
                                    
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/students', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Student',
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
