<div class="container-edu-panel">
    <section class="edu-panel">
        <div class="edu-panel-top">
            <h4>To'lovlar</h4>
            <a href="{{ route('payments.create') }}" class="edu-panel-top__btn">
                <svg class="edu-panel-top__icon" width="15" height="15" viewBox="0 0 15 15" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 7.5C0 6.67157 0.671573 6 1.5 6H13.5C14.3284 6 15 6.67157 15 7.5C15 8.32843 14.3284 9 13.5 9H1.5C0.671573 9 0 8.32843 0 7.5Z"
                        fill="white" />
                    <path
                        d="M7.5 15C6.67157 15 6 14.3284 6 13.5L6 1.5C6 0.671573 6.67157 1.01779e-07 7.5 6.55671e-08C8.32843 2.93554e-08 9 0.671573 9 1.5L9 13.5C9 14.3284 8.32843 15 7.5 15Z"
                        fill="white" />
                </svg>
            </a>
        </div>

        <!-- HEADER-SECTION -->
        <div class="edu-panel-header">
            <form action="" class="edu-panel-header">
                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box">
                    <div class="edu-panel-header__title">To'lov turi bo'yicha</div>
                    <i class="bi bi-clipboard-data"></i>
                    <select id="dropdown__button" class="form-select" aria-label="Default select example" wire:model="type">
                        <option class="edu-panel-select__option" value="">Barchasi</option>
                        <option value="paynet">Paynet</option>
                        <option value="payme">Payme</option>
                        <option value="click">Click</option>
                        <option value="terminal">Terminal</option>
                        <option value="Naqd">Naqd</option>
                    </select>
                </div>

                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box">
                    <div class="edu-panel-header__title">Guruhlar bo’yicha</div>
                    <i class="bi bi-briefcase"></i>
                    <select id="dropdown__button" class="form-select" aria-label="Default select example" wire:model="group_id">
                        <option value="" class="edu-panel-select__option" selected>Barchasi</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box-new">
                    <div class="edu-panel-header__title">Oraliq sana(dan)</div>
                    <input class="edu-date-input" type="date" wire:model="start_date">
                </div>
                <div class="edu-panel-header__box-new">
                    <div class="edu-panel-header__title">Oraliq sana(gacha)</div>
                    <input class="edu-date-input" type="date" wire:model="end_date">
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
                    <th class="edu-panel-table__th">#</th>
                    <th class="edu-panel-table__th">To'lovchi</th>
                    <th class="edu-panel-table__th">Miqdor</th>
                    <th class="edu-panel-table__th">Turi</th>
                    <th class="edu-panel-table__th">Ma'lumot</th>
                    <th class="edu-panel-table__th">To'lov sanasi</th>
                    <th class="edu-panel-table__th">Amallar</th>
                </tr>
                </thead>
                <tbody class="edu-panel-table__tbody">
                @foreach($payments as $item)
                    <tr class="edu-panel-table__tr">
                        <td class="edu-panel-table__td">{{ $item->id  }}</td>
                        <td class="edu-panel-table__td">{{ $item->student_name ?? 'null' }}</td>
                        <td class="edu-panel-table__td">{{ $item->amount }}</td>
                        <td class="edu-panel-table__td">{{ $item->type }}</td>
                        <td class="edu-panel-table__td">{{ $item->description }}</td>
                        <td class="edu-panel-table__td">{{ $item->created_at->format('d/m/Y') }}</td>
                        <th>
                            <div class="btn-group dropstart">
                                <div class="edu-panel-table__btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <ul id="edu-panel__drop-menu" class="dropdown-menu ">
                                    <li>
                                        @role('admin')
                                        <form action="{{ route('payments.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit" id="edu-panel__drop-item" onclick="return confirm("Confirm delete?")">
                                            <svg class="edu-panel__drop-menu-icon" width="15" height="15"
                                                 viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M13.125 3.73749C11.0438 3.53124 8.95 3.42499 6.8625 3.42499C5.625 3.42499 4.3875 3.48749 3.15 3.61249L1.875 3.73749"
                                                    stroke="#B3B3B3" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M5.3125 3.10625L5.45 2.2875C5.55 1.69375 5.625 1.25 6.68125 1.25H8.31875C9.375 1.25 9.45625 1.71875 9.55 2.29375L9.6875 3.10625"
                                                    stroke="#B3B3B3" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path
                                                    d="M11.7812 5.71252L11.3749 12.0063C11.3062 12.9875 11.2499 13.75 9.50619 13.75H5.49369C3.74994 13.75 3.69369 12.9875 3.62494 12.0063L3.21869 5.71252"
                                                    stroke="#B3B3B3" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M6.45599 10.3125H8.53724" stroke="#B3B3B3"
                                                      stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M5.9375 7.8125H9.0625" stroke="#B3B3B3"
                                                      stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            O’chirish</button>
                                        </form>
                                        @endrole
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('payments.edit', $item->id) }}">  <svg class="edu-panel__drop-menu-icon" width="15" height="15"
                                                                                                                       viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.875 13.125H13.125" stroke="#B3B3B3"
                                                      stroke-linecap="round" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M10.5528 3.01486C9.69719 2.26489 8.39006 2.34339 7.63263 3.19062C7.63263 3.19062 3.86804 7.40119 2.56261 8.86269C1.25547 10.3234 2.21364 12.3413 2.21364 12.3413C2.21364 12.3413 4.37125 13.0178 5.65858 11.5776C6.94675 10.1374 10.7303 5.90637 10.7303 5.90637C11.4878 5.05914 11.4076 3.76482 10.5528 3.01486Z"
                                                      stroke="#B3B3B3" stroke-linecap="round"
                                                      stroke-linejoin="round" />
                                                <path d="M6.47525 4.55774L9.32844 7.04945" stroke="#B3B3B3"
                                                      stroke-linecap="round" stroke-linejoin="round" />
                                            </svg> Edit</a></li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $payments->onEachSide(0)->links() }}
        </div>
    </section>
</div>
