@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<style>
    .filter-students{
        display: flex;
        justify-content: space-between;
        margin-left: 150px;
        //border: 1px solid red;
    }
    .filter-students-item{
        margin-left: 15px;
    }
    .filter-students-item label{
        font-size: 15px;
    }
</style>
@endsection
@section('title', 'O`quvchilar')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> 
                <h4> O'quvchilar</h4>
                <div class="filter-students">
                    
                    <div class="form-group filter-students-item">
                        <label>Kurslar</label>
                        <select name="course_id" class="form-control courses">
                            <option value="">Kurslar</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group filter-students-item">
                        <label>Guruhlar</label>
                        <select name="group_id" class="form-control groups">
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" data-course_id="{{ $group->course_id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive students">
                    <table class="table table-bordered table-striped" id="table-1">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>F.I.O</th>
                                <th>Guruh</th>
                                <th>Kurs</th>
                                <th>To'lov xolati</th>
                                <th>Davomat</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody >
                        @foreach($students as $item)
                            <tr>
                                <td>{{ $item->id  }}</td>
                                <td>{{ $item->name }}</td>
                                <td> {{ $item->group->name }} </td>
                                <td> {{ $item->group->course->name }} </td>
                           
                                <td>@if($item->debt>0)  <div class="badge badge-danger">{{ number_format($item->debt) }}(qarzdor)</div> @else <div class="badge badge-success"> {{ number_format(abs($item->debt)) }} xaqdor </div>  @endif </td>
                                {{-- <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td> --}}
                                <td>
                                    <a class="btn btn-icon btn-success" href="{{ route('userEvents', ['type'=>'student', 'id'=>$item->id]) }}">Ko'rish</a>
                                </td>
                                <td>
                                    <a href="{{ route('students.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('students.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'url' => ['/school/students', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                        @if(Auth::user()->hasRole('admin'))
                                        {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-icon',
                                                'title' => 'Delete Student',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        @endif
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
<!-- JS Libraies -->
<script src="/admin/assets/bundles/datatables/datatables.min.js"></script>

<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/datatables.js"></script>
<script>
    $('.courses').change(function() {
            var course_id=$(this).val();
            var $options = $('.groups')
            .val('')
            .find('option')
            .show();
            if (course_id != '')
                $options.not('[data-course_id="' + course_id + '"],[data-course_id=""]').hide();
    })
    $('.groups').change(function(){
        var group_id=$(this).val();
        console.log(group_id);
        $.ajax({
            type: 'POST',
            url: "{{ route('getStudentsByGroup') }}",
            data: {
                "group_id":group_id,
                "_token":"{{ csrf_token() }}"
            },
            success: function(res){
                $('.students').html(res);
            }
        })
    })
</script>
@endsection
