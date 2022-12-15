<div class="card">
    <div class="card-header">
        <h4> O'quvchilar</h4>
        <a class="btn btn-primary" href="{{ route('students.create') }}">Yangi qo'shish</a>
        <a href="#" wire:click="export"  class="btn btn-warning btn-icon icon-left"><i class="fas fa-file-excel"></i>Yuklab olish</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title">O'qish oralig'i </div>
                <div style="display: flex; justify-content: space-around">
                    <div class="form-group" wire:ignore>
                        <div class="form-group">
                            <input type="date" class="form-control" wire:model="start_date">
                        </div>
                    </div>
                    <div class="form-group" wire:ignore>
                        <div class="form-group">
                            <input type="date" class="form-control" wire:model="finished_date">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 p-icon p-round" wire:ignore>
                <div class="section-title">Status bo'yicha </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="3">
                    <div class="state p-success">
                        <label>Barchasi</label>
                    </div>
                </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="1">
                    <div class="state p-success">
                        <label>O'qimoqda</label>
                    </div>
                </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="0">
                    <div class="state p-success">
                        <label>Bitirganlar</label>
                    </div>
                </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="2">
                    <div class="state p-success">
                        <label>Chiqib ketgan</label>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="section-title">Qidiruv </div>
                <div class="form-group">
                    <input type="search" class="form-control" wire:model="search" placeholder="search...">
                </div>
            </div>
        </div>
        <div class="table-responsive ">
            <table class="table table-bordered table-striped" id="table-1">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>F.I.O</th>
                    <th>Maktab</th>
                    <th>Sinf</th>
                    <th>Guruh</th>
                    <th>Kurs</th>
                    <th>Rasm</th>
                    <th>Status</th>
                    <th>Bitirgan sanasi</th>
                    <th>Amallar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $item)

                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->school_number }}</td>
                        <td> {{ $item->clas->name }}  </td>
                        <td> {{ $item->group->name ?? 'Guruhga bog\'lanmagan'}}</td>
                        <td> {{ $item->group->course->name ?? 'Guruh yoki kursga bog\'lanmagan' }}</td>

                        <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td>
                        <td> @if($item->status==1)
                                <div class="badge badge-success">O'qimoqda</div>
                            @elseif($item->status==2)
                                <div class="badge badge-danger">Chiqib ketgan</div>
                            @else
                                <div class="badge badge-primary">Bitirgan</div>
                            @endif
                        </td>
                        <td>{{ $item->finished_date }}</td>
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
                <tr> <th>O'quvchilar soni</th> - <td>{{ count($students) }}</td> </tr>
                </tbody>
            </table>

        </div>
        {{ $students->onEachSide(0)->links() }}
    </div>
</div>


