
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>EDU APP</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
{{-- <link href="/admin/fontawesome/css/all.css" rel="stylesheet" type="text/css" /> --}}
<!-- Font Awesome Icons -->


    @yield('css')
</head>
<body >

    <div class="container">
        <br>
        <br>
        <table class="table table-bordered table-striped">
            <thead>
                <th>T/R</th>
                <th>
                    Ismi
                </th>
                <th>Yo'nalishi</th>
                <th>Guruh</th>
                <th>Chiqib ketgan sanasi</th>
                <th>Telefon</th>
            </thead>
            <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->group->course->name }}</td>
                <td>{{ $student->group->name }}</td>
                <td>{{ $student->outed_date }}</td>
                <td>{{ $student->phone }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $students->links() }}
    </div>

</body>
</html>
