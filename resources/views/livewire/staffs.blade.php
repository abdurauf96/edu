<div>
    <div class="row">
        <form class="col-lg-4">
            <div class="form-item">
                <label >Tashkilotlar</label>
                <select name="type" class="form-control select2 " wire:model="organization_id">
                    <option value="">Barchasi</option>
                    @foreach ($organizations as $organization)
                        <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>
        <div class="col-lg-4">
            <div class="form-item">
                <label >Qidiruv</label>
                <input type="search" class="form-control" wire:model="key" placeholder="search...">
            </div>
        </div>
    </div>

    <br>
    <div class="table-responsive form-inline" >
        <table class="table table-bordered table-hover table-striped">

            <thead>
                <tr>
                    <th>#</th>
                    <th>F.I.O</th>
                    <th>Lavozimi</th>
                    <th>Telefon</th>
                    <th>Tashkilot</th>
                    <th>QR Code</th>
                    <th>ID Card</th>
                    <th>Amallar</th>
                </tr>
            </thead>
            <tbody>
            @foreach($staffs as $item)
                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->position }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->organization->name ?? null }}</td>

                    <td><a class="btn btn-icon btn-info " href="{{ route('downloadStaffQrcode', $item->id) }}"><i class="fas fa-download"></i> </a></td>
                    <td>
                        @php if(isset($item->idcard) and  file_exists(public_path().'/admin/images/idcards/'.$item->idcard)) : @endphp
                            <a class="btn btn-icon btn-primary " href="{{ route('downloadCard', $item->idcard) }}">Download </a>
                        @else
                            <a class="btn btn-icon btn-info " href="{{ route('generateStaffCard', $item->id) }}">Generate </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('staffs.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('staffs.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'url' => ['/school/staffs', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-icon',
                                    'title' => 'Delete Staff',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}

                        <a href="{{ route('userEvents', ['type'=>'staff', 'id'=>$item->id]) }}" class="btn btn-icon btn-primary">Davomat</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $staffs->links('vendor.livewire.bootstrap') }}
</div>
