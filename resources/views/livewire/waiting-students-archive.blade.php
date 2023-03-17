<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between">

            <h4>Navbatda turgan o'quvchilar ro'yhati</h4>

        <input type="text" wire:model="key" placeholder="Qidiruv..." class="form-control" style="width: 300px">
            <select style="width: 200px" class="form-control "  id="" wire:model="course_id" >
                <option value="">Kurslar</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
    <div class="card-body">
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
                    <th>Yozilgan vaqti </th>
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
                        <td>
                            @if($item->course_time==1) Obedgacha @elseif($item->course_time==2) Obeddan keyin @else Kechki @endif
                        </td>
                        <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
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
                            <button wire:click="restore({{ $item->id }})" href="#" class="btn btn-icon btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        {{ $waitingStudents->links() }}
    </div>

</div>
