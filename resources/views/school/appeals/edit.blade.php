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
                <h4>Anketani tahrirlash</h4>
                <div class="card-header-form">
                    <a href="{{ route('appeals.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                </div>
                
            </div>
            <div class="card-body">
            <form action="{{ route('appeals.update', $appeal->id) }}" method="POST" >
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="section-title">1. F.I.O</label>
                        <input type="text" class="form-control" name="name" required value="{{ $appeal->name }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="section-title">2. Telefon</label>
                        <input type="text" class="form-control" name="phone" required value="{{ $appeal->phone }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="section-title">3. Manzil</label>
                        <input type="text" class="form-control" name="address" required value="{{ $appeal->address }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="section-title">4. O'qish/Ish joyi</label>
                        <input type="text" class="form-control" name="study_type" value="{{ $appeal->work_place }}">
                    </div>
                </div>
                

                <div class="form-item ">
                    <div class="section-title mt-0">5. Dars qaysi vaqtda bo'lishini xoxlaysiz?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="lesson_time" value="1" required {{ $appeal->lesson_time==1 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Ertalab 08:00 - 13:00 </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="lesson_time" value="2" required {{ $appeal->lesson_time==2 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Abetdan keyin 13:00 - 17:00 </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="lesson_time" value="3" required {{ $appeal->lesson_time==3 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Kunning kechgi qismida 17:00 - 20:00 </label>
                        </div>
                    </div>
                </div>

                <div class="form-item">
                    <div class="section-title mt-0">6. Kompyuter bilan ishlash darajangiz?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="comp_level" value="1" required {{ $appeal->comp_level==1 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Umuman bilmayman </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="comp_level" value="2" required {{ $appeal->comp_level==2 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>O'rtacha bilaman </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="comp_level" value="3" required {{ $appeal->comp_level==3 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Yaxshi bilaman </label>
                        </div>
                    </div>
                </div>

                <div class="form-item">
                    <div class="section-title mt-0">7. Dasturlash tushunchasi?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="prog_level" value="1" required {{ $appeal->prog_level==1 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Umuman tushuncham yo'q </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="prog_level" value="2" required {{ $appeal->prog_level==2 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Ozroq xabarim bor </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="prog_level" value="3" required {{ $appeal->prog_level==3 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Kod yozolaman </label>
                        </div>
                    </div>
                </div>

                <div class="form-item">
                    <div class="section-title mt-0">8. Shaxsiy kompyuteringiz bormi?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="has_comp" value="0" required {{ $appeal->has_comp==0 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Yo'q </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="has_comp" value="1" required {{ $appeal->has_comp==1 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Bor</label>
                        </div>
                    </div>
                </div>
                <div class="form-item">
                    <div class="section-title mt-0">9. Qaysi yo'nalishga yozilmoqchisiz?</div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="direction" value="1" required {{ $appeal->direction==1 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Dasturlash </label>
                        </div>
                    </div>
                    <div class="pretty p-icon p-curve p-tada">
                        <input type="radio" name="direction" value="2" required {{ $appeal->direction==2 ? 'checked': '' }}>
                        <div class="state p-primary-o">
                          <i class="icon material-icons">done</i>
                          <label>Dizayn</label>
                        </div>
                    </div>
                </div>

                <input type="hidden" value="reception" name="type">

                <button type="submit" class="btn btn-primary">Yangilash</button>
            </form>
            </div>
        </div>
    
    </div>
</div>
@endsection

