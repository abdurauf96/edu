<div class="container-edu-panel">
    <section class="edu-panel">
        <div class="edu-panel-top">
            <h4>Qarzdorlar</h4>
        </div>
        <!-- HEADER-SECTION -->
        <div class="edu-panel-header">
            <form action="" class="edu-panel-header">
                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box-new">
                    <div class="edu-panel-header__title">Qarz miqdori(dan)</div>
                    <input class="edu-date-input" type="number" wire:model="min_debt">
                </div>
                <div class="edu-panel-header__box-new">
                    <div class="edu-panel-header__title">Qarz miqdori(gacha)</div>
                    <input class="edu-date-input" type="number" wire:model="max_debt">
                </div>
                <!-- HEADER SEARCH BOX -->
                <div class="edu-panel-header__search-box">
                    <i class="bi bi-search"></i>
                    <div class="edu-panel-header__title">Qidiruv</div>
                    <input class="edu-search-input" type="text" placeholder="Search..." wire:model="search">
                </div>
            </form>
        </div>
        <!-- EDU PANEL TABLE -->
        <div class="edu-panel-table">
            <table class="table">
                <thead class="edu-panel-table__thead">
                <tr>
                    <th class="edu-panel-table__th">ID</th>
                    <th class="edu-panel-table__th">Qarzdor</th>
                    <th class="edu-panel-table__th">Telefon</th>
                    <th class="edu-panel-table__th">Guruh</th>
                    <th class="edu-panel-table__th">Qarz miqdori</th>
                </tr>
                </thead>
                <tbody class="edu-panel-table__tbody">
                @foreach($debtors as $item)
                    <tr class="edu-panel-table__tr">
                        <td class="edu-panel-table__td">{{ $item->id  }}</td>
                        <td class="edu-panel-table__td"><a href="{{ route('students.show', $item->id) }}">{{ $item->name }}</a> </td>
                        <td class="edu-panel-table__td">{{ $item->phone }}</td>
                        <td class="edu-panel-table__td">{{ $item->group_name }}</td>
                        <td class="edu-panel-table__td"><span class="badge badge-danger">{{ number_format($item->debt, 0, '.', ',') }} so'm</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $debtors->onEachSide(0)->links() }}
        </div>
    </section>
</div>
