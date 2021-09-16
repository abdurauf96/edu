@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header"> <h3> QR Kodlar</h3>
        
            </div>
            <div class="box-body">

                <div class="table-responsive dataTables_wrapper form-inline" role="grid">
                    <table class="table table-bordered table-striped dataTable" id="example1_wrapper">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>F.I.O</th>
                                <th>Rasm</th>
                                <th>QR Code</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $item)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $item->name }}</td>
                                <td> <a href="{{ route('downloadImage', $item->image) }}"><img src="/admin/images/students/{{ $item->image }}" alt="" width="100"> </a> </td>
                                <td> <a class="downloadQrcode" data-id="{{ $item->id }}" href="{{ route('downloadQrcode', $item->id) }}">Yuklab olish</a> </td>
                                <td class="qrcode_res{{ $item->id }}">@if($item->qrcode_status==1)
                                    <img src="/admin/images/check.png" width="40" alt=""> 
                                    @else
                                    <img src="/admin/images/close.png" alt="" width="40"> 
                                @endif</td>  
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript">
    $(function () {
      $("#example1_wrapper").dataTable();
      $('body').delegate('.downloadQrcode', 'click', function(){
          var id=$(this).data('id');    
          $('.qrcode_res'+id).html("<img src='/admin/images/check.png' width='40' >");
      })
    })
</script>
@endsection
