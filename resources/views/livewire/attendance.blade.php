<div>

    <div class="card-body">
        <div class="col-12" style="display: flex">
            <div class="col-lg-3">
                <label for="">Guruhlar</label>
                <select style="width: 200px" class="form-control"   wire:model="group_id" >
                    <option >Guruhni tanlang</option>
                    @foreach(auth()->user()->groups as $group)
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-3">
                <label for="">Sana</label>
                <input type="date" class="form-control" wire:model="date">
            </div>
        </div>
        <hr>
        <div class="col-lg-12">
            <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                <table class="table table-bordered table-striped " >

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>F.I.O</th>
                        <th>Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($this->students as $item)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $item->name }}</td>
                            <td>@if($item->isByDateHere($date))  <span class='badge badge-primary'>Kelgan</span>  @else <span class="badge badge-danger">Kelmagan</span> @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>



