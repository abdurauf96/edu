@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"> O'quv markazlar
                {{-- <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm" title="Add New Course">
                    <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish
                </a> --}}

            </div>

            <div class="box-body">

                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>Status</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($schools as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>@if($item->status==1) <span class='label label-success'>Faol </span> @else <span class="label label-danger">Faol emas </span> @endif</td>

                                <td>


                                    {!! Form::open([
                                        'method' => 'POST',
                                        'url' => route('activateSchool', $item->id),
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button('Faollashtirish', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-primary btn-sm',
                                                'title' => 'Activate School',
                                                'onclick'=>'return confirm("Faollashtirmoqchimisiz?")'
                                        )) !!}
                                    {!! Form::close() !!}

                                    <a class="btn btn-primary" href="{{ route('admin.schoolDetail', $item->id) }}">Batafsil</a>
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
