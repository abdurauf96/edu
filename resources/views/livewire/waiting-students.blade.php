<div class="box">
    <div class="box-header" style="display: flex; justify-content: space-between">
        <div>
            Navbatda turgan o'quvchilar ro'yhati
        </div>
        <input type="text" wire:model="key" placeholder="Qidiruv...">
            <select style="width: 200px" class="form-control "  id="" wire:model="course_id" >
                <option value="">Kurslar</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
    <div class="box-body">
        <div class="table-responsive dataTables_wrapper form-inline" role="grid">
            <table class="table table-bordered table-striped " >

                <thead>
                <tr>
                    <th>#</th>
                    <th>F.I.O</th>
                    <th>Kurs</th>
                    <th>Telefon 1 </th>
                    <th>Telefon 2 </th>
                    <th>O'qish vaqti </th>
                    <th>Qo'ng'iroq natijasi</th>
                    <th>Amallar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($waitingStudents as $item)
                    <tr>
                        <td>{{ $loop->iteration  }}</td>
                        <td>{{ $item->name }}</td><td>{{ $item->course->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->phone2 }}</td>
                        <td>{{ $item->course_time==1 ? 'Abetgacha': 'Abetdan keyin' }}</td>
                        <td>
                            <form wire:submit.prevent="saveStatus" >
                                @if($item->call_result!='')
                               <span style="margin-right: 20px" class="label label-success"> {{ $item->call_result }} </span>
                                @endif
                                <div class="input-group input-group-sm">

                                    <input type="text" class="form-control" wire:model="results.{{ $item->id }}" :key="{{ $item->id }}">
                                    <span class="input-group-btn">
                                      <button type="submit" class="btn btn-info btn-flat">Saqlash</button>
                                    </span>
                                </div>
                            </form>

                        </td>
                        <td>
                            <a href="{{ url('/school/waiting-students/' . $item->id) }}" title="View WaitingStudent"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/school/waiting-students/' . $item->id . '/edit') }}" title="Edit WaitingStudent"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/school/waiting-students', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-sm',
                                    'title' => 'Delete WaitingStudent',
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
    {{ $waitingStudents->links() }}
</div>
