@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4>To'lovlar yechilishi</h4>
                <a style="margin-left: 30px" class="btn btn-warning" href="{{ route('school.addMonthlyPayment') }}">Oylik to'lov yozish</a>
            </div>
            <div class="card-body">
                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">
                        <thead>
                            <tr>
                                <th>#</th><th>Xodisa</th><th>To'lov yozilgan o'quvchilar soni</th><th>Sana</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($paymentActivities as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->message }}</td><td>{{ $item->quantity }}</td>
                                <td>{{ $item->created_at->format('d M,Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $paymentActivities->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script type="text/javascript">
    $(function () {
      $("#example1_wrapper").dataTable();
    })
</script>
@endsection
