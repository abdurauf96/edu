@extends('layouts.admin')

@section('title')
    Foydalanuvchilar
@endsection

@section('content')

<div class="section-body">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Foydalanuvchilar</h4>
              <div class="card-header-form">
                <a href="{{ route('admin.users.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Yangi qo'shish</a>

              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tbody><tr>

                    <th>#</th>
                    <th>F.I.O</th>
                    <th>O'quv markaz</th>
                    <th>Email</th>
                    <th>Role</th>

                    <th>Action</th>
                  </tr>

                    @foreach($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->school->company_name }}</td>
                        <td>{{ $item->email }}</td>
                        <td> @foreach ($item->roles as $role)
                            {{ $role->name }}
                        @endforeach </td>
                        <td>

                            {{-- <a href="{{ route('admin.users.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a> --}}
                            <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/admin/users', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-icon btn-danger',
                                        'title' => 'Delete User',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach

                </tbody></table>
                  {{ $users->links() }}
              </div>
            </div>
          </div>
        </div>
    </div>
</div>


@endsection
