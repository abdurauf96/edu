@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">Oylar 
                <a href="{{ url('/school/months/create') }}" class="btn btn-success btn-sm" title="Add New Month">
                        <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish
                </a>
            </div>
            <div class="box-body">
                
                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">
                    
                        <thead>
                            <tr>
                                <th>#</th><th>Oy nomi</th>
                                <th>Raqami</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($months as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->number }}</td>
                                <td>
                                    {{-- <a href="{{ url('/school/months/' . $item->id) }}" title="View Month"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a> --}}
                                    <a href="{{ url('/school/months/' . $item->id . '/edit') }}" title="Edit Month"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/months', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete Month',
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