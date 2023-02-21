@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/admin/assets/css/new.css">
    @livewireStyles
@endsection
<div class="container-edu-panel">
    <section class="edu-panel">
        <div class="edu-panel-top">
            <h4>O'qituvchi samaradorligi</h4>
        </div>
        <!-- HEADER-SECTION -->
        <div class="edu-panel-header">
            <form action="" style="display: flex; justify-content: space-between">
                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box-new">
                    <div class="edu-panel-header__title">Oraliq boshlanishi</div>
                    <input class="edu-date-input" type="date" wire:model="start_date">
                </div>
                <div class="edu-panel-header__box-new" style="margin-left:100px">
                    <div class="edu-panel-header__title">Oraliq tugashi</div>
                    <input class="edu-date-input" type="date" wire:model="finished_date">
                </div>
            </form>
        </div>
        <!-- EDU PANEL TABLE -->
        <div class="edu-panel-table">
            <table class="table">
                <thead class="edu-panel-table__thead">
                <tr>
                    <th class="edu-panel-table__th">Kurs nomi</th>
                    <th class="edu-panel-table__th">Ro’yhatdan o’tganlar soni</th>
                    <th class="edu-panel-table__th">Ketganlar soni</th>
                </tr>
                </thead>
                <tbody class="edu-panel-table__tbody">
                @foreach($teachers as $teacher)
                    <tr class="edu-panel-table__tr">
                        <td class="edu-panel-table__td">{{ $teacher->name }}</td>
                        <td class="edu-panel-table__td">{{ $teacher->registered_students }}</td>
                        <td class="edu-panel-table__td">{{ $teacher->left_students }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@section('js')
    @livewireScripts
@endsection
