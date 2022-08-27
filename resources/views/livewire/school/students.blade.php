<div class="card">
    <div class="card-header"> <h4> O'quvchilar</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title">Reception </div>
                <div class="form-group" wire:ignore>
                    <select class="form-control select2"  id="creator_id">
                        <option value="">Barchasi</option>
                        @foreach($creators as $creator)
                            <option value="{{ $creator->id }}">{{ $creator->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 p-icon p-round" wire:ignore>
                <div class="section-title">Status bo'yicha </div>
                <div class="pretty p-switch" wire:ignore>
                    <input type="radio" wire:model="status" name="switch" value="1">
                    <div class="state p-success">
                        <label>O'qiyotganlar</label>
                    </div>
                </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="0">
                    <div class="state p-success">
                        <label>Bitirib ketganlar</label>
                    </div>
                </div>
                <div class="pretty p-switch">
                    <input type="radio" wire:model="status" name="switch" value="2">
                    <div class="state p-success">
                        <label>Chiqib ketganlar</label>
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
                    <th>Guruh</th>
                    <th>Kurs</th>
                    <th>QR Code</th>
                    {{-- <th>ID Card</th> --}}
                    <th>To'lov xolati</th>
                    <th>Amallar</th>
                    <th>Davomat</th>
                    <th>Qarz</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $item)

                    <tr>
                        <td>{{ $item->id  }}</td>
                        <td>{{ $item->name }}</td>
                        <td> {{ $item->group->name }} </td>
                        <td> {{ $item->group->course->name }}</td>
                        <td><a class="btn btn-icon btn-info " href="{{ route('downloadQrcode', $item->id) }}"><i class="fas fa-download"></i> </a></td>
                        {{-- <td>
                            @php if(isset($item->idcard) and  file_exists(public_path().'/admin/images/idcards/'.$item->idcard)) : @endphp
                                <a class="btn btn-icon btn-primary " href="{{ route('downloadCard', $item->idcard) }}"><i class="fas fa-download"></i> </a>
                            @else
                                <a class="btn btn-icon btn-info " href="{{ route('generateStudentCard', $item->id) }}">Generate </a>
                            @endif
                        </td> --}}
                        <td>@if($item->debt>0)
                                <div class="badge badge-danger">{{ number_format($item->debt) }}(qarzdor)</div>
                            @elseif($item->debt==0)
                                <div class="badge badge-success"> {{ number_format(abs($item->debt)) }} Qarzi yo'q </div>
                            @else
                                <div class="badge badge-success"> {{ number_format(abs($item->debt)) }} xaqdor </div>
                            @endif
                        </td>
                        {{-- <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td> --}}
                        <td>
                            <a href="{{ route('students.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('students.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/school/students', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            @role('admin')
                                {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-icon',
                                        'title' => 'Delete Student',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            @endrole
                            {!! Form::close() !!}
                        </td>
                        <td>
                            <a class="btn btn-icon btn-success" href="{{ route('userEvents', ['type'=>'student', 'id'=>$item->id]) }}">Ko'rish</a>
                            @if($item->getLastEventStatus())
                                <a class="btn btn-icon btn-danger" href="{{ route('studentEvent', $item->id) }}"> OUT</a>
                            @else
                                <a class="btn btn-icon btn-success" href="{{ route('studentEvent', $item->id) }}"> IN</a>
                            @endif
                        </td>
                        <td>
                            <form action="/student/pay" method="POST" >
                                @csrf
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" name="debt" required>
                                    <input type="hidden" class="form-control" name="student_id" value="{{ $item->id }}" >
                                    <span class="input-group-btn">
                                              <button type="submit" class="btn btn-info btn-flat">OK</button>
                                            </span>
                                </div>
                            </form>
                        </td>
                        <td>
                            @if(empty($item->test_status))
                                <button wire:click="doActive({{ $item->id }})" class="btn btn-primary">Active qilish</button>
                            @else
                                <button wire:click="doActive({{ $item->id }})" class="btn btn-success">Aktiv xolatda</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


        {{ $students->onEachSide(0)->links() }}

    </div>
</div>
@push('js')
    <script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
    <script src="/admin/assets/bundles/sweetalert/sweetalert.min.js"></script>
    <script>
        $('#creator_id').change(function (e) {
            @this.set('creator_id', $(this).val() );
        });

        window.addEventListener('StatusChanged', event => {
            swal('Good Job', 'Status o`zgardi!', 'success');
        })

    </script>
@endpush
