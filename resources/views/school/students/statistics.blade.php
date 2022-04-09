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
                        <td>Jami o'quvchilar </td>
                        <td><span class="badge badge-success">{{ $active_students }}</span></td>
                    </tr>
                   
                    <tr>
                        <td>2</td>
                        <td>Bolalar soni </td>
                        <td><span class="badge badge-success">{{ $studentsBySex[1]['total'] }}</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Qizlar soni </td>
                        <td><span class="badge badge-success">{{ $studentsBySex[0]['total'] }}</span></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Grantlar soni </td>
                        <td><span class="badge badge-success">{{ $grant_students }}</span></td>
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
                        <td><span class="badge badge-success">{{ count($dis->students) }}</span></td>
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
              <h4>Yosh chegarasi bo'yicha</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-md">
                  <tbody>
                   @foreach ($studentsByAges as $year =>$res)
                   <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ date('Y')-$year }} yosh</td>
                        <td><span class="badge badge-success">{{ count($res) }}</span></td>
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
                      <td><span class="badge badge-success">{{ $types['school'] }}</span></td>
                  </tr>
                  <tr>
                    <td>2.</td>
                    <td>Kollej </td>
                    <td><span class="badge badge-success">{{ $types['collegue'] }}</span></td>
                  </tr>
                  <tr>
                    <td>3.</td>
                    <td>Universitet </td>
                    <td><span class="badge badge-success">{{ $types['university'] }}</span></td>
                  </tr>
                  <tr>
                    <td>4.</td>
                    <td>Ishchi </td>
                    <td><span class="badge badge-success">{{ $types['worker'] }}</span></td>
                  </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
  </div>
</div>
@endsection
