@extends('layouts.site')

@section('content')


    @if(Session::has('msg'))
    {{ session::get('msg') }}
    @endif
        <div class="buttons">
            <a  href="{{ route('schoolRegisterForm') }}">Ro'yhatdan o'tish </a>

            <a href="{{ route('schoolLoginForm') }}">Kirish</a>
        </div>





@endsection
