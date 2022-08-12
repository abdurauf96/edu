@extends('layouts.school')

@section('content')
   
        <div class="row">
          <div class="col-12">
                <div class="card">
                    <div class="card-header">Class {{ $class->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/school/classes') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/school/classes/' . $class->id . '/edit') }}" title="Edit Class"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('school/classes' . '/' . $class->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Class" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $class->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $class->name }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    
@endsection
