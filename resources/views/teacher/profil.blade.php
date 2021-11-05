@extends('layouts.teacher')

@section('content')
    <div class="row">
        @livewire('teacher-profil')
    </div>
@endsection
@section('js')
    <script src="/admin/js/sweetalert.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        window.addEventListener('setKey', event => {
            $('.select2').select2();
        });

        window.addEventListener('updated', event => {

            Swal.fire({
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
