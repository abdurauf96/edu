@extends('layouts.school')

@section('content')
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
              <h4>Umumiy statistika</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tbody>
                    <tr>
                        <td>1</td>
                        <td>O'qiyatgan o'quvchilar </td>
                        <td><span class="badge badge-success">{{ $students['count_active'] }}</span></td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Bolalar soni </td>
                        <td><span class="badge badge-success">{{ $students['count_boys'] }}</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Qizlar soni </td>
                        <td><span class="badge badge-success">{{ $students['count_girls'] }}</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Grantlar soni </td>
                        <td><span class="badge badge-success">{{ $students['count_grants'] }}</span></td>
                    </tr>


                    </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>

    <div class="col-6">
      <div class="card">
          <div class="card-header">
            <h4>Kurslar bo'yicha statistika</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <thead>
                  <th>T/R</th>
                  <th colspan="2">Bitirib ketganlar</th>
                  <th>O'qiyotganlar</th>
                  <th>Chiqib ketganlar</th>
                  <th>Jami</th>
                </thead>
                <tbody>
                <tr bgcolor="gray">
                    <td>Yo'nalishlar</td>
                    <td>2021</td>
                    <td>2022</td>
                </tr>
                  @foreach ($courses as $course)
                  <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->graduated_students_2021_count }} </td>
                      <td> {{ $course->graduated_students_2022_count }} </td>
                    <td>{{ $course->active_students_count }}</td>
                    <td>{{ $course->out_students_count }}</td>
                    <td><b>{{ $course->students_count }}</b></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <div class="card-header">
              <h4>Tuman shaxarlar bo'yicha</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tbody>
                   @foreach ($districts as $dis)
                   <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dis->name }} </td>
                        <td><span class="badge badge-success">{{ $dis->students_count }}</span></td>
                        {{-- <td><a href="http://localhost:8000/school/teachers/16" class="btn btn-primary">Batafsil</a></td> --}}
                    </tr>
                   @endforeach

                    </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
    
    <div class="col-6">
      <div class="card">
          <div class="card-header">
            <h4>O'qish/Ish turi bo'yicha</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <tbody>
                 <tr>
                      <td>1.</td>
                      <td>Maktab </td>
                      <td><span class="badge badge-success">{{ $students['count_school'] }}</span></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>Kollej </td>
                    <td><span class="badge badge-success">{{ $students['count_collegue'] }}</span></td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>Universitet </td>
                    <td><span class="badge badge-success">{{ $students['count_university'] }}</span></td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>Ishchi </td>
                    <td><span class="badge badge-success">{{ $students['count_worker'] }}</span></td>
                  </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
  </div>
</div>
@endsection
