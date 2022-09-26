@extends('layouts.school')
@section('title', 'Tahrirlash')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Tahrirlash </div>
                <div class="card-body">
                    <a href="{{ route('profile.index') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                    <br />
                    <br />

                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form action="{{ route('profile.update', $school->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="section-title">1. Markaz (Maktab) nomi</label>
                                <input type="text" class="form-control" name="company_name" required value="{{ $school->company_name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="section-title">2. Markaz raxbari</label>
                                <input type="text" class="form-control" name="director" required value="{{ $school->director }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="section-title">3. Tuman</label>
                                <select class="form-control" name="district_id" required>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $school->district_id==$district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="section-title">4. Manzil</label>
                                <input type="text" class="form-control" name="addres" required value="{{ $school->addres }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="section-title">5. Telefon</label>
                                <input type="text" class="form-control" name="phone" required value="{{ $school->phone }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="section-title">6. Email</label>
                                <input type="text" class="form-control" name="email" required value="{{ $school->email }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="section-title">7. Domain</label>
                                <input type="text" class="form-control" name="domain" value="{{ $school->domain }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="section-title">8. Kompyuterlar soni</label>
                                <input type="text" class="form-control" name="computers_qty" value="{{ $school->computers_qty }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Yangilash</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
