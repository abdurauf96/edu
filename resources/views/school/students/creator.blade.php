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
          <div class="table-responsive">
            <form action="" method="POST">
              @csrf
            <table class="table table-striped" id="table-2">
              <thead>
                <tr>
                  <th class="text-center pt-3">
                    <div class="custom-checkbox custom-checkbox-table custom-control">
                      <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                        class="custom-control-input" id="checkbox-all">
                      <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                  </th>
                  <th>ID</th>
                  <th>F.I.O</th>
                  <th>Guruh</th>
                  <th>Kurs</th>
                  <th>To'lov xolati</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($students as $item)
                <tr>
                  <td class="text-center pt-2">
                    <div class="custom-checkbox custom-control">
                      <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input"
                      id="checkbox-{{ $loop->iteration }}" value="{{ $item->id }}" name="student_ids[]">
                      <label for="checkbox-{{ $loop->iteration }}" class="custom-control-label">&nbsp;</label>
                    </div>
                  </td>
                  <td>{{ $item->id  }}</td>
                  <td>{{ $item->name }}</td>
                  <td> {{ $item->group->name ?? '' }} </td>
                  <td> {{ $item->group->course->name ?? '' }}</td>
                  <td>@if($item->debt>0)
                    <div class="badge badge-danger">{{ number_format($item->debt) }}(qarzdor)</div>
                    @elseif($item->debt==0)
                    <div class="badge badge-success"> {{ number_format(abs($item->debt)) }} Qarzi yo'q </div>
                    @else
                    <div class="badge badge-success"> {{ number_format(abs($item->debt)) }} xaqdor </div>
                    @endif
                </td>

                </tr>
                @endforeach

              </tbody>
            </table>
            <div style="padding: 10px">
              <input type="submit" value="Tanlash" class="btn btn-primary">
            </div>
            </form>
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
