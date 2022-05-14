<table class="table table-bordered table-striped" id="table-1">

    <thead>
        <tr>
            <th>ID</th>
            <th>F.I.O</th>
            <th>Guruh</th>
            <th>Kurs</th>
            <th>To'lov xolati</th>
            <th>Davomat</th>
            <th>Amallar</th>
        </tr>
    </thead>
    <tbody >
    @foreach($students as $item)
        <tr>
            <td>{{ $item->id  }}</td>
            <td>{{ $item->name }}</td>
            <td> {{ $item->group->name }} </td>
            <td> {{ $item->group->course->name }} </td>
       
            <td>@if($item->debt>0)  <div class="badge badge-danger">{{ number_format($item->debt) }}(qarzdor)</div> @else <div class="badge badge-success"> {{ number_format(abs($item->debt)) }} xaqdor </div>  @endif </td>
            {{-- <td><img src="/admin/images/students/{{ $item->image }}" width="100" alt=""></td> --}}
            <td>
                <a class="btn btn-icon btn-success" href="{{ route('userEvents', ['type'=>'student', 'id'=>$item->id]) }}">Ko'rish</a>
            </td>
            <td>
                <a href="{{ route('students.show', $item->id) }}" class="btn btn-icon btn-primary"><i class="fas fa-eye"></i></a>
                <a href="{{ route('students.edit', $item->id) }}" class="btn btn-icon btn-info"><i class="far fa-edit"></i></a>
                {!! Form::open([
                    'method' => 'DELETE',
                    'url' => ['/school/students', $item->id],
                    'style' => 'display:inline'
                ]) !!}
                    @if(Auth::user()->hasRole('admin'))
                    {!! Form::button('<i class="fas fa-trash-alt" aria-hidden="true"></i>', array(
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-icon',
                            'title' => 'Delete Student',
                            'onclick'=>'return confirm("Confirm delete?")'
                    )) !!}
                    @endif
                {!! Form::close() !!}
            </td>
            
        </tr>
    @endforeach
    </tbody>
</table>