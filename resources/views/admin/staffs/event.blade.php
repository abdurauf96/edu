@extends('layouts.reception')

@section('content')

<section class="content">

    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img style="width:300px !important" class="profile-user-img img-responsive img-circle"  src="/admin/images/staffs/{{ $staff->image }}" alt="User profile picture">

            <h3 class="profile-username text-center">{{ $staff->name }}</h3>

            {{-- <p class="text-muted text-center">Software Engineer</p> --}}

            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                    <b>Lavozimi</b> <a class="pull-right">{{ $staff->position}}</a>
                </li>
              <li class="list-group-item">
                <b>Tug'ilgan yili</b> <a class="pull-right">{{ $staff->year}}</a>
              </li>
              <li class="list-group-item">
                <b>Manzili</b> <a class="pull-right">{{ $staff->addres }}</a>
              </li>
              <li class="list-group-item">
                <b>Telefon</b> <a class="pull-right">{{ $staff->phone }}</a>
              </li>
              <li class="list-group-item">
                <b>Passport ma'lumotlari</b> <a class="pull-right">{{ $staff->passport }}</a>
              </li>
            </ul>
            
            
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
       
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </section>

@endsection