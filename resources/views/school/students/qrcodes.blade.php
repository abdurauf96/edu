@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header"> <h4> QR Kodlar</h4>
                <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <input type="text" name="q" value="{{ request()->q ?? null }}" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive ">
                    <table class="table table-bordered table-striped ">
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
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">
    $(function () {
     
      $('body').delegate('.downloadQrcode', 'click', function(){
          var id=$(this).data('id');
          $('.qrcode_res'+id).html("<img src='/admin/images/check.png' width='40' >");
      })
    })
</script>
@endsection
