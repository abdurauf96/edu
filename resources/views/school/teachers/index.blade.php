@extends('layouts.school')
@section('title', 'O`qituvchilar')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> 
                <h4>O'qituvchilar</h4>
                <div class="card-header-form">
                    <a href="{{ route('teachers.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                    <div class="dropdown d-inline mr-2">
                        <button class="btn btn-primary note-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                          <a class="dropdown-item" href="{{ route('teachers.index') }}">Joriy</a>
                          <a class="dropdown-item" href="{{ route('teachers.index', ['status'=>'not-actives']) }}">Avvalgi</a>
                         
                          <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('teachers.index', ['status'=>'all']) }}">Barchasi</a>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="card-body ">

                <div class="table-responsive  " role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">
                    
                        <thead>
                            <tr>
                                <th>#</th><th>F.I.O</th><th>Mutahasisligi</th><th>Telefon raqami</th><th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td><td>@foreach ($item->courses as $course)
                                    {{ $course->name }}  @if(!$loop->last) , @endif
                                @endforeach</td><td>{{ $item->phone }}</td>
                                <td>
                                    <a href="{{ route('teachers.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('teachers.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/teachers', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-icon',
                                                'title' => 'Delete Teacher',
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