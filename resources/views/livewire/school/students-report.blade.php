@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/admin/assets/css/new.css">
    @livewireStyles
@endsection
<div class="container-edu-panel">
    <section class="edu-panel">
        <div class="edu-panel-top">
            <h4>O'quvchilar xisoboti</h4>
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
                    <th class="edu-panel-table__th">Faol talabalar</th>
                    <th class="edu-panel-table__th">To’lov qilgan talabalar</th>
                    <th class="edu-panel-table__th">Chiqib ketgan talabalar</th>
                    <th class="edu-panel-table__th">Yangi qo'shilgan talabalar</th>
                    <th class="edu-panel-table__th">Bitirgan talabalar</th>
                </tr>
                </thead>
                <tbody class="edu-panel-table__tbody">
                    <tr class="edu-panel-table__tr">
                        <td class="edu-panel-table__td">{{ $activeStudentsCount }}</td>
                        <td class="edu-panel-table__td">{{ $payedStudentsCount }}</td>
                        <td class="edu-panel-table__td">{{ $leftStudentsCount }}</td>
                        <td class="edu-panel-table__td"> {{ $newStudentsCount }}</td>
                        <td class="edu-panel-table__td">{{ $graduatedStudentsCount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>



@section('js')
    @livewireScripts
@endsection
