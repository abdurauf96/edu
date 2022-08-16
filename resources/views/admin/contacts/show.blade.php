@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Contact {{ $contact->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/contacts') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Ortga</button></a>
                        <a href="{{ url('/admin/contacts/' . $contact->id . '/edit') }}" title="Edit Contact"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Tahrirlash</button></a>

                        <form method="POST" action="{{ url('admin/contacts' . '/' . $contact->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> O'chirib yuborish</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $contact->id }}</td>
                                    </tr>
                                    <tr><th> Sarlavha </th><td> {{ $contact->title }} </td></tr><tr><th> Ma'lumotlar </th><td> {{ $contact->body }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection
