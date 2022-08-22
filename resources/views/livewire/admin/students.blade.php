<div class="card">
    <div class="card-header"> <h4> O'quvchilar</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title">O'quv markazlar bo'yicha </div>
                <div class="form-group" wire:ignore>
                    <select class="form-control select2"  id="school_id">
                        <option value="">Markazni tanlang</option>
                        @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->company_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-8 p-icon p-round">
                <div class="section-title">Status bo'yicha </div>
                <div class="pretty p-switch">
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
        </div>



        <div class="table-responsive ">
            <table class="table table-bordered table-striped" id="table-1">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>F.I.O</th>
                    <th>O'quv markaz</th>
                    <th>Yo'nalish</th>
                    <th>O'qish xolati</th>
                    <th>Sertifikat xolati</th>
                    <th>Sertifikat</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $item)

                    <tr>
                        <td>{{ $item->id  }}</td>
                        <td>{{ $item->name }}</td>
                        <td> {{ $item->getSchool->company_name }} </td>
                        <td> {{ $item->group->course->name }}</td>

                        <td>@if($item->status==2)
                                <div class="badge badge-danger">Chiqib ketgan</div>
                            @elseif($item->status==1)
                                <div class="badge badge-success"> O'qiyapti </div>
                            @else
                                <div class="badge badge-warning"> Bitirgan </div>
                            @endif
                        </td>
                       <td>
                           <div class="badge badge-success">Berilmagan </div>
                       </td>
                        <td>
                            @if(true)
                            <a class="btn btn-warning" href="">Yuklab olish</a>
                            @else
                                <a href="">Generate</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $students->onEachSide(0)->links() }}
        </div>

    </div>
</div>
@push('js')
    <script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
    <script>
        $('#school_id').change(function (e) {
            @this.set('school_id', $(this).val() );
        });

    </script>
@endpush
