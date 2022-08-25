@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> O'quv markazlar
                {{-- <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm" title="Add New Course">
                    <i class="fa fa-plus" aria-hidden="true"></i> Yangi qo'shish
                </a> --}}

            </div>
            @if(session('message'))
            <div class="alert alert-success alert-dismissible">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>×</span>
                  </button>
                  {{ session('message') }}
                </div>
            </div>
            @endif
            <div class="card-body">

                <div class="table-responsive" >
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomi</th>
                                <th>O'quvchilar soni</th>
                                <th>Status</th>
                                <th>Statusni o'zgartirish</th>
                                <th>Markaz haqida</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($schools as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ $item->students_count }}</td>
                                <td>@if($item->status==1) <span class="badge badge-success">Faol </span> @else <span class="badge badge-danger">Faol emas </span> @endif</td>

                                <td>
                                    {!! Form::open([
                                        'method' => 'POST',
                                        'url' => route('admin.activateSchool', $item->id),
                                        'style' => 'display:inline'
                                    ]) !!}
                                        {!! Form::button($item->status==1 ? 'Toxtatish' : 'Faollashtirish', array(
                                                'type' => 'submit',
                                                'class' => $item->status==1 ? 'btn btn-danger' : 'btn btn-success',
                                                'title' => 'Activate School',
                                                'onclick'=>'return confirm("Rostan o`zgartirmoqchimisiz?")'
                                        )) !!}
                                    {!! Form::close() !!}
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.schoolDetail', $item->id) }}">Batafsil</a>
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
