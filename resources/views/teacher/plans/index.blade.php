@extends('layouts.teacher')
@section('title')
    Kurs rejalari
@endsection
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h4> {{ $course->name }} kurs rejalari </h4>
                    <div class="card-header-form">
                        <a href="{{ route('teacher.plans.create',['course_id'=>$course->id])  }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped " id="example1_wrapper">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reja sarlavhasi</th>
                                    <th>Reja davomiyligi</th>
                                    <th>Reja mavzulari</th>
                                    <th>Reja tartib raqami</th>
                                    <th>Amallar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($course->plans as $plan)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $plan->title }}</td>
                                    <td>{{ $plan->duration }} oy </td>
                                    <td>{!! $plan->description !!}</td>
                                    <td>{{ $plan->order }}</td>
                                    <td>

                                        <a href="{{ route('teacher.plans.edit', $plan->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'url' => [route('teacher.plans.destroy', $plan->id)],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-icon',
                                                    'title' => 'Delete Course',
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
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(function () {
      $("#example1_wrapper").dataTable();
    })
</script>
@endsection
