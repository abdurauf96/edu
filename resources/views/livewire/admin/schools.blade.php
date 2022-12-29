
<div class="card">
    <div class="card-header" style="justify-content: space-between"> <h4> O'quv markazlar </h4>
        <a href="#" wire:click="exportToExcel" class="btn btn-warning btn-sm" title="Add New Course">
            <i class="fa fa-download" aria-hidden="true"></i> Yuklab olish
        </a>
    </div>
    @if(session('message'))
        <div class="alert alert-success alert-dismissible col-lg-4">
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
                    <th>Xudud</th>
                    <th>Markaz nomi</th>
                    <th>Maktab direktori</th>
                    <th>Maktab manzili</th>
                    <th>Telefon</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Statusni o'zgartirish</th>
                    <th>Batafsil</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($schools as $school)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td>{{ $school->district->name ?? '' }}</td>
                        <td>{{ $school->company_name }}</td>
                        <td>{{ $school->director }}</td>
                        <td>{{ $school->addres }}</td>
                        <td>{{ $school->phone }}</td>
                        <td>{{ $school->email }}</td>
                        <td>@if($school->status==1) <span class="badge badge-success">Faol </span> @else <span class="badge badge-danger">Faol emas </span> @endif</td>
                        <td>
                            {!! Form::open([
                                'method' => 'POST',
                                'url' => route('admin.activateSchool', $school->id),
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button($school->status==1 ? 'Toxtatish' : 'Faollashtirish', array(
                                    'type' => 'submit',
                                    'class' => $school->status==1 ? 'btn btn-danger' : 'btn btn-success',
                                    'title' => 'Activate School',
                                    'onclick'=>'return confirm("Rostan o`zgartirmoqchimisiz?")'
                            )) !!}
                            {!! Form::close() !!}
                        </td>
                      
                        <td>
                            <a class="btn btn-info" href="{{ route('admin.schoolDetail', $school->id) }}">Batafsil</a>
                        </td>
                        <td>
                            <button wire:click="delete({{ $school->id }})" class="btn btn-danger" ><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $schools->links() }}
        </div>

    </div>
</div>
