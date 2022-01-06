@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4>Xodimlar</h4> 
               
                <div class="card-header-form">
                    <a href="{{ route('staffs.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                </div>
            </div>
            <div class="card-body">
                
                <div class="table-responsive form-inline" >
                    <table class="table table-bordered table-hover table-striped" id="table-1">
                    
                        <thead>
                            <tr>
                                <th>#</th><th>F.I.O</th><th>Lavozimi</th><th>Telefon</th><th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($staffs as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td><td>{{ $item->position }}</td><td>{{ $item->phone }}</td>
                                <td>
                                    <a href="{{ route('staffs.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('staffs.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/staffs', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-icon',
                                                'title' => 'Delete Staff',
                                                'onclick'=>'return confirm("Confirm dele    te?")'
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