@extends('layouts.student')


@section('content')
    
<div class="section-body">

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-4">
            <div class="card author-box">
                <div class="card-body">
                    <div class="author-box-center">
                        <img alt="image" src="/admin/images/students/{{ auth()->user()->image }}" class="rounded-circle author-box-picture">
                        <div class="clearfix"></div>
                        <div class="author-box-name">
                        <a href="#">{{ auth()->user()->name }}</a>
                        </div>
                        {{-- <div class="author-box-job">Web Developer</div> --}}
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Shaxsiy ma'lumotlari</h4>
                </div>
                <div class="card-body">
                    <div class="py-4">
                        <p class="clearfix">
                            <span class="float-left">
                                Yo'nalishi
                            </span>
                            <span class="float-right text-muted">
                                {{ auth()->user()->group->course->name }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Guruhi
                            </span>
                            <span class="float-right text-muted">
                                {{ auth()->user()->group->name }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Tug'ilgan kuni
                            </span>
                            <span class="float-right text-muted">
                                {{ auth()->user()->year }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Telefon
                            </span>
                            <span class="float-right text-muted">
                                {{ auth()->user()->phone }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Passport ma'lumoti
                            </span>
                            <span class="float-right text-muted">
                                {{ auth()->user()->passport }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Manzil
                            </span>
                            <span class="float-right text-muted">
                                {{ auth()->user()->address }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Akamademiyada xolati
                            </span>
                            <span class="float-right badge badge-pill badge-info">
                                @switch(auth()->user()->status)
                                    @case(1)
                                        O'qimoqda
                                        @break
                                    @case(2)
                                        O'qish tugatilmay to'xtatilgan
                                        @break
                                    @default
                                        Tamomlagan
                                @endswitch
                            </span>
                        </p>  
                        <p class="clearfix">
                            <span class="float-left">
                                Qarzdorlik xolati
                            </span>
                            @if(auth()->user()->debt>0)
                            <span class="float-right badge badge-pill badge-danger">
                                Qarzdor
                            </span>
                            @else
                            <span class="float-right badge badge-pill badge-success">
                                Qarzdorlik yo'q
                            </span>
                            @endif
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Username
                            </span>
                            <span class="float-right text-muted">
                                {{ auth()->user()->username }}
                            </span>
                        </p>   
                        <p class="clearfix">
                           
                            <img width="200" src="/admin/images/qrcodes/{{ auth()->user()->code }}" alt="">
                        </p>    
                                    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                  <h4>Amalga oshirilgan to'lovlar</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover mb-0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Sana</th>
                          <th>To'lov usuli</th>
                          <th>Miqdor</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach (auth()->user()->payments as $payment)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            
                            <td>{{ $payment->created_at->format('d M, Y') }}</td>
                            <td>{{ $payment->type }}</td>
                            <td>{{ $payment->amount }}</td>
                          </tr>
                          @endforeach
                          <tr>
                            <th>Jami</th>
                            
                            <th>{{ number_format(25450000, 0, ' ', ' ') }}</th>
                            
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>

            <div class="card">
                
                <div class="card-body">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    To'lov qilish</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('modals')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="formModal">To'lov ma'lumotlari</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('student.redirectToPaymentSystem') }}" method="post">
            @csrf
            
            <div class="form-group">
              <label>To'lov miqdori</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <i class="fas fa-dollar-sign"></i>
                  </div>
                </div>
                <input type="number" name="amount" class="form-control" placeholder="To'lov miqdori">
              </div>
            </div>
           
            <div class="form-group">
                <label for="">To'lov tizimi</label>
                <div class="input-group">
                    <div class="pretty p-icon p-round">
                        <input type="radio" name="paysys" value="payme">
                        <div class="state p-primary-o">
                        <i class="icon material-icons">done</i>
                        <label>Payme</label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-round">
                        <input type="radio" name="paysys" value="click">
                        <div class="state p-primary-o">
                        <i class="icon material-icons">done</i>
                        <label>Click</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Davom etish</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
