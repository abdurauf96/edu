@extends('layouts.school')

@section('content')
<div class="row">
    
    <div class="col-12">
      <div class="card">
          <div class="card-header">
            <h4>O'quvchilar bo'yicha statistika</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-md">
                <thead>
                  <th>T/R</th>
                  <th>Bitirib ketganlar</th>
                  <th>O'qiyotganlar</th>
                  <th>Chiqib ketganlar</th>
                  <th>Qarzdorlar</th>
                  <th>Jami</th>
                </thead>
                <tbody>
                  @foreach ($creators as $creator)
                  <tr>
                    <td>{{ $creator->name }}</td>
                    <td>{{ $students->toQuery()->graduated()->where('creator_id', $creator->id)->count() }} </td>
                    <td>{{ $students->toQuery()->active()->where('creator_id', $creator->id)->count() }} </td>
                    <td>{{ $students->toQuery()->out()->where('creator_id', $creator->id)->count() }} </td>
                    <td>{{ $students->toQuery()->where('debt', '>', 0)->where('creator_id', $creator->id)->count() }}  </td>
                    <td><span class="badge badge-success">{{ $creator->students->count() }}</span></td>
                   
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    
</div>
@endsection
