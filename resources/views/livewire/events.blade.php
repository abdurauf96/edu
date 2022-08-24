
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Monitoring oynasi</h4>
            </div>
            <div class="card-body">
                <form class="form-inline" style="display: flex; justify-content:space-around">
                    <div class="form-item">
                        <label >Tashkilotlar</label>
                        <select name="type" class="form-control select2 " wire:model="organization_id">
                            <option value="">Tanlang</option>
                            @foreach ($organizations as $organization)
                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-item">
                        <label class="custom-switch">
                            <span class="custom-switch-description">Faqat o'quvchilar</span>
                            <input type="checkbox" wire:model="onlyStudents" name="custom-switch-checkbox" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </div>
                    <div class="form-item">
                        <label >Xodisa turi</label>
                        <div class="custom-switches-stacked mt-2">
                            <label class="custom-switch">
                            <input type="radio" name="option" wire:model="event" value="1" class="custom-switch-input" checked>
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Kelish</span>
                            </label>
                            <label class="custom-switch">
                            <input type="radio" name="option" value="0" wire:model="event" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Ketish</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-item ">
                        <label>Oraliqni boshlanishi  </label>
                        <div class="input-group mb-2 ">
                            <div class="input-group date">
                                <input type="date" class="form-control pull-right" value="" wire:model="start_date" name="start_date" >
                            </div>
                        </div>
                    </div>


                    <div class="form-item">
                        <label>Oraliqni tugashi  </label>
                        <div class="input-group date">
                            <input type="date" class="form-control pull-right" value="" wire:model="end_date" name="end_date" >
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header" style="display: flex; align-items:center; justify-content:space-around">
                <h3> Natijalar</h3>
                <h4>Bugun kelgan xodimlar soni : {{ $statistika['numberTodayStaffs'] }}</h4>
                <h4>Bugun kelgan o'quvchilar soni : {{ $statistika['numberTodayStudents'] }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped ">

                        <thead>
                        <tr>
                            <th>T/r</th>
                            <th>Shaxs</th>
                            <th>Tashkilot</th>
                            <th>Xodisa</th>
                            <th>Vaqt</th>
                            <th>Sana</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($event->type=='staff')
                                        <a href="{{ route('staffs.show', $event->person_id) }}"> {{ $event->name  }} </a>
                                    @else
                                        <a href="{{ route('students.show', $event->person_id) }}"> {{ $event->name  }} </a>
                                    @endif
                                </td>
                                <td> {{ $event->organization->name ?? 'O`quvchi' }} </td>
                                <td> @if($event->status==1) <span class='label label-success'>Keldi </span> @else <span class='label label-danger'>Chiqib ketdi </span> @endif </td>
                                <td> {{ $event->time }} </td>
                                <td> {{ $event->created_at->format('d-M-Y') }} </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                {{ $events->onEachSide(0)->links('vendor.livewire.bootstrap') }}
            </div>
        </div>
    </div>
</div>

