@extends('layouts.admin')

@section('title', 'Sertifikat qo`shish')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"> <h4>Sertifikat qo'shish sahifasi </h4> </div>
                <div class="card-body ">

                    <form action="{{ route('admin.sertificatForm', $student->id) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Sertifikat beriluvchi o'quvchi</label>
                                <input type="text" value="{{ $student->name }}" disabled class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Sertifikat ID</label>
                                <input type="text" class="form-control" name="sertificat_id" required>
                            </div>
                            <div class="form-group">
                                <label for="">Sertifikat berilish sanasi</label>
                                <input type="date" class="form-control" name="sertificat_date" required>
                            </div>
                            <div class="form-group">
                                <label for="">Sertifikatni yuklash</label>
                                <input type="file" class="form-control" name="sertificat_file" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Saqlash">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
