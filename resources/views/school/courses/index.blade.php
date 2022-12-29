@extends('layouts.school')
@section('title')
    Kurslar
@endsection
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h4>Kurslar</h4>
                    <div class="card-header-form">
                        <a href="{{ route('courses.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped " id="example1_wrapper">
                            <thead>
                                <tr>
                                    <th>#</th><th>Nomi</th><th>Davomiyligi</th> <th>Narxi</th>
                                    <th>Status</th> <th>Bot uchun</th> <th>Ta`rifi</th> <th>Image</th> <th>Amallar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($courses as $item)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->duration }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->status ==true ? 'Faol' : 'Faol emas' }}</td>
                                        <td>{{ $item->is_for_bot ==true ? 'Yes' : 'No ' }}</td>
                                    <td>{{  $item->description  }}</td>
                                    <td> <img src="/{{ $item->image }}" width="100" alt=""> </td>
                                    <td>
                                       <a href="{{ route('courses.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('courses.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => ['/school/courses', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-icon',
                                                    'title' => 'Delete Course',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                           
                                        <a href="{{ route('coursePlans', $item->id) }}" class="btn btn-icon btn-warning">
                                            <i class="fas fa-notes-medical"></i> Kurs rejalari </a>
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
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(function () {
      $("#example1_wrapper").dataTable();
    })
</script>
@endsection
