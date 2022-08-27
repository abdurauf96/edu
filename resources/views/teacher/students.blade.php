@extends('layouts.teacher')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/admin/assets/bundles/izitoast/css/iziToast.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> O'quvchilar</h4>
                    <div class="card-header-form">

                        <div class="dropdown d-inline mr-2">
                            <button class="btn btn-primary note-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Guruhlar bo'yicha
                            </button>
                            <div class="dropdown-menu" >
                                @foreach ($groups as $group)
                                <a class="dropdown-item" href="?group_id={{ $group->id }}">{{ $group->name }}</a>
                                @endforeach
                              <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('teacher.students') }}">Barchasi</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.studentsAttandance') }}" method="POST">
                        @csrf
                    <div class="table-responsive dataTables_wrapper " >
                        <table class="table table-bordered table-striped dataTable" id="table-1">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Guruh</th>
                                <th>Telefon</th>
                                <th>Manzil</th>
                                <th>Rasm</th>
                                <th>Davomat</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($students as $item)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td> {{ $item->group->name }} </td>

                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>

                                    <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td>

                                    <td>

                                        <label class="custom-switch mt-2">
                                            <input type="checkbox"  class="custom-switch-input" value="{{ $item->id }}" name="student_id" {{ $item->isByDateHere(date('Y-m-d')) ? 'checked' : '' }}>
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">{{ $item->isByDateHere(date('Y-m-d')) ? 'here' : 'absent' }}</span>
                                        </label>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<!-- JS Libraies -->
<script src="/admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="/admin/assets/bundles/datatables/datatables.min.js"></script>
<script src="/admin/assets/bundles/jquery-ui/jquery-ui.min.js"></script>
 <!-- JS Libraies -->
 <script src="/admin/assets/bundles/izitoast/js/iziToast.min.js"></script>
<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/datatables.js"></script>
<script>
    $('.custom-switch-input').click(function(){
        if ($(this).is(':checked')) {
            $(this).siblings('.custom-switch-description').html('here')
            var status=1;
        }else{
            $(this).siblings('.custom-switch-description').html('absent')
            var status=0;
        }
        var student_id=$(this).val();
        console.log(status);
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}",
                "student_id": student_id,
                "status":status
            },
            url: "{{ route('teacher.studentsAttandance') }}",
            type: 'POST',
            success:function(res){
                iziToast.success({
                    title: 'Belgilandi! ',
                    // message: 'This awesome plugin is made iziToast toastr',
                    position: 'topRight'
                });
            },
            error:function(){
                console.log('error');
            }
        })
    })
</script>
@endsection
