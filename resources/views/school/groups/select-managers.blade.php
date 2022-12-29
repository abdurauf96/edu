@extends('layouts.school')
@section('css')
<link rel="stylesheet" href="/admin/assets/bundles/datatables/datatables.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>O'quvchilar</h4>
        </div>
        <div class="card-body">
          <div class="section-title">Tanlanmagan guruhlar</div>
          <div class="form-group col-lg-6">
            <form action="" method="POST">
              @csrf
              <div class="input-group mb-3">
                <select class="form-control" name="group_id">
                  @foreach ($groups as $group)
                  <option value="{{ $group->id }}" >{{ $group->name }} ( {{ $group->course->name }} )</option>
                  @endforeach
                </select>
                <div class="input-group-append">
                  <button type="submit" class="btn btn-warning"> Tanlash</button>
                </div>
              </div>
            </form>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <thead>
                <th>T/R</th>
                <th>Menejer </th>
                <th>Guruhlar soni</th>
                <th>O'quvchilar soni</th>
                
              </thead>
              <tbody>
                @foreach ($managers as $manager)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $manager->name }}</td>
                  <td>{{ $manager->groups_count }} </td>
                  <td>{{ $manager->students_count }} </td>
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
@section('js')
<!-- JS Libraies -->
<script src="/admin/assets/bundles/datatables/datatables.min.js"></script>

<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/datatables.js"></script>
@endsection
