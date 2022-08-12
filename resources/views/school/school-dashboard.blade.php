@extends('layouts.school')

@section('title')
    Dashboard
@endsection

@section('content')

<div class="section-body">
  <div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4>Sinflar bo'yicha</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tbody>
                  <tr>
                    @foreach ($classes as $class)
                    <th>{{ $class->name }}</th>
                    @endforeach
                  </tr>
                  <tr>
                    @foreach ($classes as $c)
                      <td>{{ $c->students_count }}</td>
                    @endforeach
                  </tr>
                  
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-15">Guruhlar</h5>
                    <h2 class="mb-3 font-18">{{ $num_groups }}</h2>
                    <a href="{{ route('groups.index') }}" class="mb-0">Batafsil</a>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img">
                    <img src="/admin/assets/img/banner/3.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4>Kurslar</h4>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <tbody><tr>
                  <th>#</th>
                  <th>Kurs nomi</th>
                  <th>O'quvchilar soni</th>
                </tr>
                @foreach ($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->name }}</td>
                    <td><span class="badge badge-success">{{ count($course->activeStudents()) }}</span></td>
                </tr>
                @endforeach
              </tbody></table>
            </div>
          </div>

        </div>
      </div>
      <div class="col-12 col-md-4 col-lg-4">
          <div class="card">
            <div class="card-header">
              <h4>O'quvchilar haqida ma'lumot</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tbody>
                      <tr>
                          <td>1</td>
                          <td> <a href="{{ route('students.index')  }}"> Jami o'quvchilar </a></td>
                          <td><span class="badge badge-light">{{ $all_students }} ta</span></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td> <a href="{{ route('students.index')  }}?type=active"> Ayni vaqt o'qimoqda </a></td>
                        <td><span class="badge badge-light">{{ $active_students }} ta</span></td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td><a href="{{ route('students.index')  }}?type=graduated">Bitirib ketgan </a> </td>
                        <td><span class="badge badge-light">{{ $graduated_students }} ta</span></td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td><a href="{{ route('students.index')  }}?type=boys">Bolalar soni </a> </td>
                        <td><span class="badge badge-light">{{ $boys }} ta</span></td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td><a href="{{ route('students.index')  }}?type=girls">Qizlar soni </a></td>
                        <td><span class="badge badge-light">{{ $girls }} ta</span></td>
                      </tr>
                      <tr>
                          <td>6</td>
                          <td> <a href="{{ route('groups.index', date('Y'))  }}"> Guruhlar soni </a></td>
                          <td><span class="badge badge-light">{{ $num_groups }} ta</span></td>
                      </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </div>
    
</div>
@endsection
