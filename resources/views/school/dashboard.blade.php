@extends('layouts.school')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="row ">
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Jami o'quvchilar</h5>
                  <h2 class="mb-3 font-18">{{ $num_students }}</h2>
                  <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="/admin/assets/img/banner/1.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15"> Kurslar</h5>
                  <h2 class="mb-3 font-18">{{ count($courses) }}</h2>
                  <p class="mb-0"><span class="col-orange">09%</span> Decrease</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="/admin/assets/img/banner/2.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">Guruhlar</h5>
                  <h2 class="mb-3 font-18">{{ $num_groups }}</h2>
                  <p class="mb-0"><span class="col-green">18%</span>
                    Increase</p>
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
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <div class="card">
        <div class="card-statistic-4">
          <div class="align-items-center justify-content-between">
            <div class="row ">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                <div class="card-content">
                  <h5 class="font-15">O'qituvchilar</h5>
                  <h2 class="mb-3 font-18">{{ count($teachers) }}</h2>
                  <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                <div class="banner-img">
                  <img src="/admin/assets/img/banner/4.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>O'qituvchilar</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tbody><tr>
                    <th>#</th>
                    <th>F.I.O</th>
                    <th>Yo'nalishi</th>
                    <th>O'quvchilar soni</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($teachers as $teacher)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $teacher->name }} </td>
                    <td>
                       @foreach ($teacher->courses as $course)
                        {{ $course->name }}
                       @endforeach
                    </td>
                    <td><span class="badge badge-success">{{ count($teacher->students) }}</span></td>
                    <td><a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-primary">Batafsil</a></td>
                  </tr>
                  @endforeach
                </tbody></table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
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
                      <td><span class="badge badge-success">{{ count($course->activeStudents) }}</span></td>
                  </tr>
                  @endforeach
                </tbody></table>
              </div>
            </div>
            
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
              <div class="card-header">
                <h4>Jami o'quvchilar haqida ma'lumot</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-md">
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td> <a href="{{ route('school.students.index', date('Y'))  }}"> Jami o'quvchilar </a></td>
                            <td><span class="badge badge-light">{{ $num_students }} ta</span></td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td> <a href="{{ route('school.students.index', date('Y'))  }}?type=active"> Ayni vaqt o'qimoqda </a></td>
                          <td><span class="badge badge-light">{{ $active_students }} ta</span></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td><a href="{{ route('school.students.index', date('Y'))  }}?type=graduated">Bitirib ketgan </a> </td>
                          <td><span class="badge badge-light">{{ $graduated_students }} ta</span></td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td><a href="{{ route('school.students.index', date('Y'))  }}?type=out"> Chiqib ketgan </a> </td>
                          <td><span class="badge badge-light">{{ $out_students }} ta</span></td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td><a href="{{ route('school.students.index', date('Y'))  }}?type=grant">Grant o'qimoqda </a> </td>
                          <td><span class="badge badge-light">{{ $grant_students }} ta</span></td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td><a href="{{ route('school.students.index', date('Y'))  }}?type=boys">Bolalar soni </a> </td>
                          <td><span class="badge badge-light">{{ $boys }} ta</span></td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td><a href="{{ route('school.students.index', date('Y'))  }}?type=girls">Qizlar soni </a></td>
                          <td><span class="badge badge-light">{{ $girls }} ta</span></td>
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