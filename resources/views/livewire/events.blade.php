
<div class="row">
    <div class="container">
        <h2>Monitoring oynasi</h2>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Filter</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form">
            <div class="box-body col-md-12">
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Turi</label>
                    <select name="type" class="form-control select2" wire:model="type">
                        <option value=""></option>
                        <option value="staff">Xodimlar</option>
                        <option value="student">O'quvchilar</option>
                    </select>
                </div>

                <div class="form-group  col-md-3">
                    <label>Oraliqni boshlanishi  </label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="" wire:model="start_date" name="start_date" >
                    </div>
                </div>
                <div class="form-group  col-md-3">
                    <label>Oraliqni tugashi  </label>
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control pull-right" value="" wire:model="end_date" name="end_date" >
                    </div>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="exampleInputFile"></label>--}}
{{--                    <div class="">--}}
{{--                        <input type="submit" class="btn btn-primary" value="Natijani ko'rish">--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </form>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3> Natijalar</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">

                        <thead>
                        <tr>
                            <th>T/r</th>
                            <th>Shaxs</th>
                            <th>Turi</th>
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
                                <td>{{ $event->type=='staff' ? 'Xodim' : 'O\'quvchi' }}</td>
                                <td> @if($event->status==1) <span class='label label-success'>Keldi </span> @else <span class='label label-danger'>Chiqib ketdi </span> @endif </td>
                                <td> {{ $event->time }} </td>
                                <td> {{ $event->created_at->format('d-M-Y') }} </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>
