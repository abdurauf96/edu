@extends('layouts.school')

@section('css')
    <link rel="stylesheet" href="/admin/assets/css/new.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
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
                                <div class="profil-user__info-item-inf">{{ $student->group_name }}</div>
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
                        </ul>
                    </div>

                    <!-- USER QR CODE IMG -->
                    @if(file_exists('admin/images/qrcodes/'.$student->qrcode))
                    <img class="profil-user__info-qr"
                        src="/admin/images/qrcodes/{{ $student->qrcode }}"
                        alt="qr-img" width="75" height="75">
                    @endif
                    <!-- ===================USER INFO EDIT DELET BUTTONS=================== -->
                    <div class="user__info-btn-wrap">
                        <button class="user__info-btn user__info-btn--colr" data-bs-target="#exampleModalToggle"
                            data-bs-toggle="modal">Guruhni almashtirish</button>
                        <a class="user__info-btn user__info-btn--colr user__info-ds"
                           href="{{ route('students.downloadContract', $student->id) }}"><i
                                class="material-icons">assignment</i>Shartnoma</a>
                        @if($student->last_event_status)
                            <a class="btn btn-icon btn-danger user__info-btn--oval" href="{{ route('studentEvent', $student->id) }}">OUT</a>
                        @else
                            <a class="btn btn-icon btn-success user__info-btn--oval" href="{{ route('studentEvent', $student->id) }}">IN</a>
                        @endif
                        <a href="{{ route('students.edit', $student->id) }}"
                           class="user__info-btn user__info-btn--oval user__info-btn--oval-cl--e7">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="{{ route('createSertificate', $student->id) }}"
                           class="user__info-btn user__info-btn--oval user__info-btn--oval-cl--e7">
                            <i class="bi bi-file-text"></i>
                        </a>
                        @role('admin')
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="user__info-btn user__info-btn--oval user__info-btn--oval-cl--74">
                                <i class="bi bi-trash3"></i>
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
            <section class="{{ $student->debt>0 ? 'user-balans-red' : 'user-balans-blue' }} user-balans">
                <div class="user-balans__title">Balans</div>
                <div class="user-balans__money"> {{ $student->formatted_debt }} so'm</div>
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
                        <form action="{{ route('storeStudentMessage') }}" method="POST" >
                            @csrf
                            <input type="hidden" name="student_id" value="{{ $student->id }}">
                            <textarea class="user-tabs__textarea" placeholder="Izoh..." name="message" id="#" cols="30"
                                rows="10" required></textarea>
                            <button type="submit" class="user-tabs__btn">Saqlash</button>
                        </form>
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
                            @foreach ($student->messages as $message)
                            <tr class="user-table__tr">
                                <td class="user-table__td">{{ $message->message }}</td>
                                <td class="user-table__td">{{ $message->creator->name ?? '' }}</td>
                                <td class="user-table__td">{{ $message->created_at->format('d-M-Y') }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="user-table">
                <div class="user-table__title">Sertifikatlari</div>
                <table class="table">
                    <thead class="user-table__thead">
                    <tr>
                        <th class="user-table__th">Yo'nalish</th>
                        <th class="user-table__th">Sana</th>
                        <th class="user-table__th">Xarakat</th>
                    </tr>
                    </thead>
                    <tbody class="user-table__tbody">
                    @foreach($student->sertificates as $sertificate)
                        <tr class="user-table__tr">
                            <td class="user-table__td">{{ $sertificate->course->name }}</td>
                            <td class="user-table__td">{{ date('d-M-Y', strtotime($sertificate->date)) }}</td>
                            <td class="user-table__td"><a class="btn btn-primary" target="_blank" href="{{ route('downloadSertificate',$sertificate->id) }}">Yuklab olish <i class="bi bi-download"></i></a> </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
