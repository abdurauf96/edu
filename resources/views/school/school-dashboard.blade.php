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
            <h4>Statistika</h4>
          </div>
          <div class="card-body">
              <div class="row">
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
                                          <td><span class="badge badge-light">{{ $students['count_active'] }} ta</span></td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td> <a href="{{ route('students.index')  }}?type=active"> Ayni vaqt o'qimoqda </a></td>
                                          <td><span class="badge badge-light">{{ $students['count_active'] }} ta</span></td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td><a href="{{ route('students.index')  }}?type=graduated">Bitirib ketgan </a> </td>
                                          <td><span class="badge badge-light">{{ $students['count_outed'] }} ta</span></td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td><a href="{{ route('students.index')  }}?type=graduated">Chiqib ketgan </a> </td>
                                          <td><span class="badge badge-light">{{ $students['count_graduated'] }} ta</span></td>
                                      </tr>
                                      <tr>
                                          <td colspan="3"><h6>Shundan</h6></td>
                                      </tr>
                                      <tr>
                                          <td>4</td>
                                          <td><a href="{{ route('students.index')  }}?type=boys">Bolalar soni </a> </td>
                                          <td><span class="badge badge-light">{{ $students['count_boys'] }} ta</span></td>
                                      </tr>
                                      <tr>
                                          <td>5</td>
                                          <td><a href="{{ route('students.index')  }}?type=girls">Qizlar soni </a></td>
                                          <td><span class="badge badge-light">{{ $students['count_girls'] }} ta</span></td>
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
                                      <tr>
                                          <td colspan="3"><h6>Guruhlar</h6></td>
                                      </tr>
                                      <tr>
                                          <td>#</td>
                                          <td>Guruhlar soni</td>
                                          <td><span class="badge badge-success">{{ $num_groups }}</span> </td>
                                      </tr>
                                      </tbody></table>
                              </div>
                          </div>

                      </div>
                  </div>
                  <div class="col-12 col-md-4 col-lg-4">
                      <div class="card">
                          <div class="card-header">
                              <h4>Sinflar bo'yicha statistika</h4>
                          </div>
                          <div class="card-body p-0">
                              <div class="table-responsive">
                                  <table class="table table-striped table-md">
                                      <tbody><tr>
                                          <th>#</th>
                                          <th>Sinf</th>
                                          <th>O'quvchilar soni</th>
                                      </tr>
                                      @foreach ($classes as $class)
                                          <tr>
                                              <td>{{ $loop->iteration }}</td>
                                              <td>{{ $class->name }}</td>
                                              <td><span class="badge badge-success">{{ $class->students_count }}</span></td>
                                          </tr>
                                      @endforeach
                                      </tbody></table>
                              </div>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>


</div>
@endsection
