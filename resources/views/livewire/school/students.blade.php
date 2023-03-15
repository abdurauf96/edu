<div class="container-edu-panel">
    <section class="edu-panel">
        <div class="edu-panel-top">
            <h4>O'quvchilar</h4>
            <a href="{{ route('students.create') }}" class="edu-panel-top__btn">
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
            <button class="edu-panel-top__btn" wire:click="export">
                <svg class="edu-panel-top__icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z"
                        stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9 11.51L12 14.51L15 11.51" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M12 14.51V6.51001" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M6 16.51C9.89 17.81 14.11 17.81 18 16.51" stroke="white" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button class="edu-panel-top__btn">
                <svg class="edu-panel-top__icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17 20.5H7C4 20.5 2 19 2 15.5V8.5C2 5 4 3.5 7 3.5H17C20 3.5 22 5 22 8.5V15.5C22 19 20 20.5 17 20.5Z"
                        stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M17 9L13.87 11.5C12.84 12.32 11.15 12.32 10.12 11.5L7 9" stroke="white"
                        stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <!-- HEADER-SECTION -->
        <div class="edu-panel-header">
            <form action="" class="edu-panel-header">
                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box">
                    <div class="edu-panel-header__title">Personal menejer</div>
                    <select id="dropdown__button" class="form-select" aria-label="Default select example" wire:model="manager_id">
                        <option class="edu-panel-select__option" value="">Barchasi</option>
                        @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box">
                    <div class="edu-panel-header__title">Kurslar bo’yicha</div>
                    <select id="dropdown__button" class="form-select" aria-label="Default select example" wire:model="course_id">
                        <option value="" class="edu-panel-select__option" selected>Barchasi</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box">
                    <div class="edu-panel-header__title">Status bo’yicha</div>
                    <select id="dropdown__button" class="form-select" aria-label="Default select example" wire:model="status">
                        <option value="" class="edu-panel-select__option" selected>Barchasi</option>
                        <option value="active">O'qimoqda</option>
                        <option value="graduated">Bitirgan</option>
                        <option value="left">Chiqib ketgan</option>
                        <option value="left-recently">Ushbu oyda chiqib ketgan</option>
                        <option value="good-attandance">Faol o'quvchilar</option>
                        <option value="bad-attandance">Nofaol o'quvchilar</option>
                        <option value="unknown">Noma'lum o'quvchilar</option>
                    </select>
                </div>

                <!-- HEADER SELECT BOX -->
                <div class="edu-panel-header__box">
                    <div class="edu-panel-header__title">To'lovlar bo’yicha</div>
                    <select id="dropdown__button" class="form-select" aria-label="Default select example" wire:model="payment">
                        <option value="" class="edu-panel-select__option" selected>Barchasi</option>
                        <option value="debtors">Qarzdorlar</option>
                        <option value="no-debt">Ijobiy balans</option>
                        <option value="discount">Chegirmaga ega</option>
                    </select>
                </div>
                <!-- HEADER SEARCH BOX -->
                <div class="edu-panel-header__box">
                    <div class="edu-panel-header__title">Qidiruv</div>
                    <input class="edu-panel-header__search" placeholder="Izlash..." type="text" wire:model="search">
                    <button class="edu-panel-header__search-btn"></button>
                </div>
            </form>
        </div>

        <!-- EDU PANEL TABLE -->
        <div class="edu-panel-table">
            <table class="table">
                <thead class="edu-panel-table__thead">
                    <tr>
                        <th class="edu-panel-table__th">ID</th>
                        <th class="edu-panel-table__th">O'quvchi</th>
                        <th class="edu-panel-table__th">Guruh</th>
                        <th class="edu-panel-table__th">Mentor</th>
                        <th class="edu-panel-table__th">Mashg’ulot sanasi</th>
                        <th class="edu-panel-table__th">Balans</th>
                        <th class="edu-panel-table__th">Status</th>
                        <th class="edu-panel-table__th">Amallar</th>
                    </tr>
                </thead>
                <tbody class="edu-panel-table__tbody">
                    @foreach($students as $item)
                    <tr class="edu-panel-table__tr">
                        <td class="edu-panel-table__td">{{ $item->id }}</td>
                        <td class="edu-panel-table__td"><a href="{{ route('students.show', $item->id) }}">{{ $item->name }}</a></td>
                        <td class="edu-panel-table__td"> {{ $item->group->name }} ({{ $item->group->course->name }}) </td>
                        <td class="edu-panel-table__td">{{ $item->group->teacher->name }}</td>
                        <td class="edu-panel-table__td"> {{ $item->group->start_date !=null ? $item->group->start_date->format('d-m-Y') : 'belgilanmagan' }} / {{ $item->group->end_date !=null ? $item->group->end_date->format('d-m-Y') : 'belgilanmagan' }}</td>
                        <td class="edu-panel-table__td">{{ $item->formatted_debt }} so’m</td>
                        <td class="edu-panel-table__td"> {{ $item->statusText() }} </td>
                        <th>
                            <div class="btn-group dropstart">
                                <div class="edu-panel-table__btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <ul id="edu-panel__drop-menu" class="dropdown-menu ">
                                    <li>
                                        <a class="dropdown-item" id="edu-panel__drop-item" href="{{ route('students.edit', $item->id) }}">
                                            <svg class="edu-panel__drop-menu-icon" width="15" height="15"
                                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.875 13.125H13.125" stroke="#B3B3B3"
                                                    stroke-linecap="round" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M10.5528 3.01486C9.69719 2.26489 8.39006 2.34339 7.63263 3.19062C7.63263 3.19062 3.86804 7.40119 2.56261 8.86269C1.25547 10.3234 2.21364 12.3413 2.21364 12.3413C2.21364 12.3413 4.37125 13.0178 5.65858 11.5776C6.94675 10.1374 10.7303 5.90637 10.7303 5.90637C11.4878 5.05914 11.4076 3.76482 10.5528 3.01486Z"
                                                    stroke="#B3B3B3" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M6.47525 4.55774L9.32844 7.04945" stroke="#B3B3B3"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Tahrirlash</a>
                                    </li>
                                    <li>
                                        @role('admin')
                                        <form action="{{ route('students.destroy', $item->id) }}" method="POST">
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
                                    <li>
                                        <a class="dropdown-item" id="edu-panel__drop-item"  href="{{ route('downloadQrcode', $item->id) }}">
                                            <svg class="edu-panel__drop-menu-icon" width="15" height="15"
                                                viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.625 4.21875H5C4.56853 4.21875 4.21875 4.56853 4.21875 5V5.625C4.21875 6.05647 4.56853 6.40625 5 6.40625H5.625C6.05647 6.40625 6.40625 6.05647 6.40625 5.625V5C6.40625 4.56853 6.05647 4.21875 5.625 4.21875Z"
                                                    stroke="#B3B3B3" />
                                                <path
                                                    d="M10 4.21875H9.375C8.94353 4.21875 8.59375 4.56853 8.59375 5V5.625C8.59375 6.05647 8.94353 6.40625 9.375 6.40625H10C10.4315 6.40625 10.7812 6.05647 10.7812 5.625V5C10.7812 4.56853 10.4315 4.21875 10 4.21875Z"
                                                    stroke="#B3B3B3" />
                                                <path
                                                    d="M10 8.59375H9.375C8.94353 8.59375 8.59375 8.94353 8.59375 9.375V10C8.59375 10.4315 8.94353 10.7812 9.375 10.7812H10C10.4315 10.7812 10.7812 10.4315 10.7812 10V9.375C10.7812 8.94353 10.4315 8.59375 10 8.59375Z"
                                                    stroke="#B3B3B3" />
                                                <path
                                                    d="M5.625 8.59375H5C4.56853 8.59375 4.21875 8.94353 4.21875 9.375V10C4.21875 10.4315 4.56853 10.7812 5 10.7812H5.625C6.05647 10.7812 6.40625 10.4315 6.40625 10V9.375C6.40625 8.94353 6.05647 8.59375 5.625 8.59375Z"
                                                    stroke="#B3B3B3" />
                                                <path
                                                    d="M2.16531 2.16525C2.95944 1.37113 4.17348 1.266 6.40525 1.25208C6.6645 1.25047 6.875 1.46074 6.875 1.71999C6.875 1.97856 6.66544 2.18808 6.40688 2.18972C5.4744 2.19562 4.76571 2.21692 4.19597 2.29352C3.44895 2.39395 3.08265 2.57374 2.82823 2.82817C2.5738 3.08259 2.39401 3.44888 2.29358 4.19591C2.21698 4.76565 2.19568 5.47433 2.18978 6.40685C2.18814 6.66542 1.97862 6.87498 1.72006 6.87498C1.4608 6.87498 1.25053 6.66442 1.25215 6.40517C1.26606 4.17342 1.3712 2.95937 2.16531 2.16525Z"
                                                    fill="#B3B3B3" />
                                                <path
                                                    d="M1.72006 8.125C1.4608 8.125 1.25053 8.3355 1.25215 8.59475C1.26606 10.8265 1.3712 12.0406 2.16531 12.8347C2.95944 13.6288 4.17348 13.7339 6.40525 13.7479C6.6645 13.7495 6.875 13.5392 6.875 13.2799C6.875 13.0214 6.66544 12.8119 6.40688 12.8103C5.4744 12.8043 4.76571 12.7831 4.19597 12.7064C3.44895 12.606 3.08265 12.4262 2.82823 12.1718C2.5738 11.9174 2.39401 11.5511 2.29358 10.8041C2.21698 10.2343 2.19568 9.52562 2.18978 8.59312C2.18814 8.33456 1.97862 8.125 1.72006 8.125Z"
                                                    fill="#B3B3B3" />
                                                <path
                                                    d="M13.28 8.125C13.0214 8.125 12.8119 8.33456 12.8103 8.59312C12.8044 9.52562 12.7831 10.2343 12.7065 10.8041C12.6061 11.5511 12.4262 11.9174 12.1718 12.1718C11.9174 12.4262 11.5511 12.606 10.8041 12.7064C10.2343 12.7831 9.52562 12.8043 8.59312 12.8103C8.33456 12.8119 8.125 13.0214 8.125 13.2799C8.125 13.5392 8.33556 13.7495 8.59481 13.7479C10.8266 13.7339 12.0406 13.6288 12.8348 12.8347C13.6289 12.0406 13.734 10.8265 13.7479 8.59475C13.7495 8.3355 13.5392 8.125 13.28 8.125Z"
                                                    fill="#B3B3B3" />
                                                <path
                                                    d="M13.28 6.87498C13.5392 6.87498 13.7495 6.66442 13.7479 6.40517C13.734 4.17342 13.6289 2.95937 12.8348 2.16525C12.0406 1.37113 10.8266 1.266 8.59481 1.25208C8.33556 1.25047 8.125 1.46074 8.125 1.71999C8.125 1.97856 8.33456 2.18808 8.59312 2.18972C9.52562 2.19562 10.2343 2.21692 10.8041 2.29352C11.5511 2.39395 11.9174 2.57374 12.1718 2.82817C12.4262 3.08259 12.6061 3.44888 12.7065 4.19591C12.7831 4.76565 12.8044 5.47433 12.8103 6.40685C12.8119 6.66542 13.0214 6.87498 13.28 6.87498Z"
                                                    fill="#B3B3B3" />
                                            </svg>
                                            QR kod yuklash</a>
                                    </li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                   @endforeach
                </tbody>
            </table>
            {{ $students->onEachSide(0)->links() }}
        </div>
    </section>
</div>
