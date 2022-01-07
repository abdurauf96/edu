@extends('layouts.teacher')

@section('css')
    <link rel="stylesheet" href="/admin/assets/bundles/select2/dist/css/select2.min.css">
    {{-- <link rel="stylesheet" href="/admin/assets/css/components.css"> --}}
@endsection

@section('content')
    <div class="section-body">
        {{-- @livewire('teacher-profil') --}}
        <teacher-profile></teacher-profile>
    </div>
@endsection
@section('js')
<script src="/admin/assets/bundles/sweetalert/sweetalert.min.js"></script>
<!-- Page Specific JS File -->
<script src="/admin/assets/js/page/sweetalert.js"></script>
    <script src="/admin/assets/bundles/select2/dist/js/select2.full.min.js"></script>
    <script>

        window.addEventListener('updated', event => {
           
            swal({
                icon: 'success',
                title: 'Good job!',
                text: 'Ma`lumot yangilandi!',
                timer: 2000,
                width: '45rem',
                showConfirmButton: false,
                padding: '6.25rem',
            })

        });
    </script>
@endsection
