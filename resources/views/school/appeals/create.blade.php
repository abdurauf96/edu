@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<style>
    .form-item{
        margin-bottom: 50px;
    }
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Anketani to'ldirish</h4>
                <div class="card-header-form">
                    <a href="{{ route('appeals.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                </div>
                
            </div>
            <div class="card-body">
            <form action="{{ route('appeals.store') }}" method="POST" >
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="section-title">1. F.I.O</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="section-title">2. Telefon</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="section-title">3. Manzil</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="section-title">4. O'qish/Ish joyi</label>
                        <input type="text" class="form-control" name="study_type">
                    </div>
                </div>
                

                <div class="form-item ">
                    <div class="section-title mt-0">5. Dars qaysi vaqtda bo'lishini xoxlaysiz?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="lesson_time" value="1" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Ertalabki  </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="lesson_time" value="2" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Tushlikdan so'ng </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="lesson_time" value="3" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Kechki</label>
                        </div>
                    </div>
                </div>

                <div class="form-item">
                    <div class="section-title mt-0">6. Kompyuter bilan ishlash darajangiz?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="comp_level" value="1" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Umuman bilmayman </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="comp_level" value="2" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>O'rtacha bilaman </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="comp_level" value="3" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Yaxshi bilaman </label>
                        </div>
                    </div>
                </div>

                <div class="form-item">
                    <div class="section-title mt-0">7. Dasturlash tushunchasi?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="prog_level" value="1" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Umuman tushuncham yo'q </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="prog_level" value="2" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Ozroq xabarim bor </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="prog_level" value="3" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Kod yozolaman </label>
                        </div>
                    </div>
                </div>

                <div class="form-item">
                    <div class="section-title mt-0">8. Shaxsiy kompyuteringiz bormi?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="has_comp" value="0" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Yo'q </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="has_comp" value="1" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Bor</label>
                        </div>
                    </div>
                </div>
                <div class="form-item">
                    <div class="section-title mt-0">9. Qaysi yo'nalishga yozilmoqchisiz?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="direction" value="1" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Dasturlash </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="direction" value="2" required>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Dizayn</label>
                        </div>
                    </div>
                </div>

                <input type="hidden" value="reception" name="type">

                <button type="submit" class="btn btn-primary">Saqlash</button>
            </form>
            </div>
        </div>
    
    </div>
</div>
@endsection

