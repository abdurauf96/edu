<div class="card">
    <div class="card-header"> <h4> Sertifikat olgan o'quvchilar</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-title">Qidiruv </div>
                <div class="form-group" wire:ignore>
                    <input class="form-control" type="search" wire:model="search" placeholder="search...">
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
                    <th>Sertifikat berilgan sana</th>
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
                        <td>{{ $item->sertificat_date }}</td>
                        <td>
                            <a target="_blank" class="btn btn-warning" href="/admin/sertificats/{{ $item->sertificat_file }}">Sertifikat</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $students->onEachSide(0)->links() }}
        </div>

    </div>
</div>
