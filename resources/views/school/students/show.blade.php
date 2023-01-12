@extends('layouts.school')

@section('css')
    <link rel="stylesheet" href="/admin/assets/student/css/global.css">
    <link rel="stylesheet" href="/admin/assets/student/css/profil.css">
    <link rel="stylesheet" href="/admin/assets/student/css/select.css">
@endsection

@section('content')


<div class="container-edu-panel">

    <div class="profil-title">Profil</div>

    <div class="container-user">

        <div>

            <!-- =============SECTION USER PROFIL INFO============= -->
            <section class="profil-user">

                <!-- USER AVATAR -->
                <img class="profil-user__avatar"
                    src="/admin/images/students/{{ $student->image }}"
                    alt="user-img" width="157" height="157">

                <div class="profil-user__info">

                    <!-- USER PROFIL NAME -->
                    <div class="profil-user__info-name">{{ $student->name }}</div>

                    <!-- USER PROFIL LIST -->
                    <div class="profil-user__info-box">
                        <ul class="profil-user__info-list">
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">ID :</div>
                                <div class="profil-user__info-item-inf">{{ $student->id }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Guruh:</div>
                                <div class="profil-user__info-item-inf">{{ $student->group->name }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Telefon:</div>
                                <div class="profil-user__info-item-inf">{{ $student->phone }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Manzil:</div>
                                <div class="profil-user__info-item-inf">{{ $student->address }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Tug’ilgan yil:</div>
                                <div class="profil-user__info-item-inf">{{ $student->year }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Passport ma’lumoti:</div>
                                <div class="profil-user__info-item-inf">{{ $student->passport }}</div>
                            </li>
                        </ul>

                        <ul class="profil-user__info-list">
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Jinsi:</div>
                                <div class="profil-user__info-item-inf">{{ $student->sex==1 ? 'Erkak' : 'Ayol' }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Status:</div>
                                <div class="profil-user__info-item-inf">{{ $student->statusText() }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Dars boshlangan sanasi:</div>
                                <div class="profil-user__info-item-inf">{{ $student->start_date }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">O’qish turi:</div>
                                <div class="profil-user__info-item-inf">{{ $student->type==1 ? 'Odatiy' : 'Chegirma bilan ('.$student->discount_percent.'%)' }}</div>
                            </li>
                            <li class="profil-user__info-item">
                                <div class="profil-user__info-item-id">Qarzi:</div>
                                <div class="profil-user__info-item-inf">{{ $student->is_debt() ? 'Qarzdor' : 'Qarzi yo\'q'  }}</div>
                            </li>
                        </ul>
                    </div>

                    <!-- USER QR CODE IMG -->
                    <img class="profil-user__info-qr"
                        src="/admin/images/qrcodes/{{ $student->qrcode }}"
                        alt="qr-img" width="75" height="75">

                    <!-- ===================USER INFO EDIT DELET BUTTONS=================== -->
                    <div class="user__info-btn-wrap">
                        <button class="user__info-btn user__info-btn--colr" data-bs-target="#exampleModalToggle"
                            data-bs-toggle="modal">Guruhni almashtirish</button>
                        <a href="{{ route('students.edit', $student->id) }}" class="user__info-btn user__info-btn--oval">
                            <svg class="edu-panel__drop-menu-icon" width="15" height="15" viewBox="0 0 15 15"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.875 13.125H13.125" stroke="#fff" stroke-linecap="round" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.5528 3.01486C9.69719 2.26489 8.39006 2.34339 7.63263 3.19062C7.63263 3.19062 3.86804 7.40119 2.56261 8.86269C1.25547 10.3234 2.21364 12.3413 2.21364 12.3413C2.21364 12.3413 4.37125 13.0178 5.65858 11.5776C6.94675 10.1374 10.7303 5.90637 10.7303 5.90637C11.4878 5.05914 11.4076 3.76482 10.5528 3.01486Z"
                                    stroke="#fff" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M6.47525 4.55774L9.32844 7.04945" stroke="#fff" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                        @role('admin')
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="user__info-btn user__info-btn--oval">
                                <svg class="edu-panel__drop-menu-icon" width="15" height="15" viewBox="0 0 15 15"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.125 3.73749C11.0438 3.53124 8.95 3.42499 6.8625 3.42499C5.625 3.42499 4.3875 3.48749 3.15 3.61249L1.875 3.73749"
                                        stroke="#fff" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M5.3125 3.10625L5.45 2.2875C5.55 1.69375 5.625 1.25 6.68125 1.25H8.31875C9.375 1.25 9.45625 1.71875 9.55 2.29375L9.6875 3.10625"
                                        stroke="#fff" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M11.7812 5.71252L11.3749 12.0063C11.3062 12.9875 11.2499 13.75 9.50619 13.75H5.49369C3.74994 13.75 3.69369 12.9875 3.62494 12.0063L3.21869 5.71252"
                                        stroke="#fff" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.45599 10.3125H8.53724" stroke="#fff" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M5.9375 7.8125H9.0625" stroke="#fff" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </form>
                        @endrole
                    </div>

                 
                        <!-- =====================USER EDIT MODAL===================== -->
                        <div class="modal fade " id="exampleModalToggle" aria-hidden="true"
                            aria-labelledby="exampleModalToggleLabel" tabindex="1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div id="user__info-modal-content" class="modal-content ">
                                    <div id="user__info-modal-body" class="modal-body ">

                                        <form action="{{ route('changeStudentGroup') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $student->id }}" name="student_id">
                                            <div class="user__info-drow-box">
                                                <div class="user__info-drow-title">Qaysi yo'nalishga o'tmoqda ?</div>
                                                <select id="user__info-drow" class="form-select courses"
                                                    aria-label="Default select example">
                                                    <option class="edu-panel-select__option" value="" selected>Kurslar</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="user__info-drow-box">
                                                <div class="user__info-drow-title">Qaysi guruhga qo'shilmoqda ?</div>
                                                <select name="new_group_id" id="user__info-drow" class="form-select groups"
                                                aria-label="Default select example" >
                                                <option class="edu-panel-select__option" value="" selected>Guruhlar</option>
                                                    @foreach ($groups as $group)
                                                    <option data-course_id={{ $group->course->id }} value="{{ $group->id }}">{{ $group->name  }} ({{ $group->course->name }}) </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="user__info-drow-box">
                                                <div class="user__info-drow-title">Yangi guruhda dars boshlash sanasi </div>

                                                <input class="user__info-drow-data-input" type="date" required name="start_date">
                                            </div>

                                            <button type="submit" class="user__info-drow-btn">Jo'natish</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </section>

            <!-- ========Student payments SECTION========= -->
            <div class="user-table">
                <div class="user-table__title">To’lovlar tarixi</div>
                <table class="table">
                    <thead class="user-table__thead">
                        <tr>
                            <th class="user-table__th">Summa</th>
                            <th class="user-table__th">To’lov turi</th>
                            <th class="user-table__th">Sana</th>
                        </tr>
                    </thead>
                    <tbody class="user-table__tbody">
                        @foreach ($student->payments as $payment)
                        <tr class="user-table__tr">
                            <td class="user-table__td">{{ $payment->amount }}</td>
                            <td class="user-table__td">{{ $payment->type }}</td>
                            <td class="user-table__td">{{ $payment->created_at->format('d.m.Y') }}</td>
                        </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>

            <!-- ========Student activities SECTION========= -->
            <div class="user-table">
                <div class="user-table__title">O'quvchining xarakatlari</div>
                <table class="table">
                    <thead class="user-table__thead">
                        <tr>
                            <th class="user-table__th">Xodisa</th>
                            <th class="user-table__th">Sana</th>
                        </tr>
                    </thead>
                    <tbody class="user-table__tbody">
                        @foreach ($student->activities as $activity)
                        <tr class="user-table__tr">
                            <td class="user-table__td">{{ $activity->description }}</td>
                            <td class="user-table__td">{{ $activity->created_at->format('d.m.Y') }}</td>
                        </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <!-- =============SECTION BALANS============== -->
            <section class="{{ $student->is_debt() ? 'user-balans-red' : 'user-balans-blue' }} user-balans">
                <div class="user-balans__title">Balans</div>
                <div class="user-balans__money"> {{ $student->is_debt() ? '-' : '+' }} {{ number_format(abs($student->debt)) }} so'm</div>
                {{-- <div class="user-balans__text">Pul miqodri 3,000.000 so’m</div> --}}
            </section>

            <!-- SECTION TABS -->
            <div class="tabs">
                <input type="radio" name="tab-btn" id="tab-btn-1" value="" checked>
                <label for="tab-btn-1">Davomat</label>
                <input type="radio" name="tab-btn" id="tab-btn-2" value="">
                <label for="tab-btn-2">Izohlar</label>

                <div id="content-1">
                    <table class="table">
                        <thead class="user-table__thead">
                            <tr>
                                <th class="user-table__th">Vaqt / Sana</th>
                                <th class="user-table__th">Xarakat turi</th>
                            </tr>
                        </thead>
                        <tbody class="user-table__tbody">
                           
                            @foreach ($events as $event)
                            <tr class="user-table__tr">
                                <td class="user-table__td"> {{$event->created_at->format('h:i d-m-Y') }}</td>
                                <td class="user-table__td">{{ $event->status==1 ? 'Kirdi' : 'Chiqdi' }}</td>
                            </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                    {{ $events->links() }}
                </div>
                <div id="content-2">
                    <div class="user-table__content-wrap">
                        <textarea class="user-tabs__textarea" placeholder="Izohh..." name="#" id="#" cols="30"
                            rows="10"></textarea>
                        <button class="user-tabs__btn">Jo’natish</button>
                    </div>

                    <table class="table">
                        <thead class="user-table__thead">
                            <tr>
                                <th class="user-table__th">Izoh</th>
                                <th class="user-table__th">Hodim</th>
                                <th class="user-table__th">Sana</th>
                            </tr>
                        </thead>
                        <tbody class="user-table__tbody">
                            <tr class="user-table__tr">
                                <td class="user-table__td">Komiljonov Raxmatillo</td>
                                <td class="user-table__td">Apr 27, 2019 - Explore Alupa
                                    Creative's board "Ui - Profile
                                    Design",</td>
                                <td class="user-table__td">06-01-2023</td>
                            </tr>
                            <tr class="user-table__tr">
                                <td class="user-table__td">Komiljonov Raxmatillo</td>
                                <td class="user-table__td">Apr 27, 2019 - Explore Alupa
                                    Creative's board "Ui - Profile
                                    Design",</td>
                                <td class="user-table__td">06-01-2023</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
crossorigin="anonymous"></script>
<script>
    $('.courses').change(function() {
            var course_id=$(this).val();
            console.log(course_id);
            var $options = $('.groups')
            .val('')
            .find('option')
            .show();
            if (course_id != '0')
                $options.not('[data-course_id="' + course_id + '"],[data-course_id=""]').hide();
        })
</script>
@endsection