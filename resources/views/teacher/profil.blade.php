@extends('layouts.teacher')

@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
{{--                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">--}}

                    <h3 class="profile-username text-center">{{ auth()->guard('teacher')->user()->name }}</h3>

{{--                    <p class="text-muted text-center">Software Engineer</p>--}}

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>O'quvchilar</b> <a class="pull-right">{{ count(auth()->guard('teacher')->user()->students) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Guruhlar</b> <a class="pull-right">{{ count(auth()->guard('teacher')->user()->groups) }}</a>
                        </li>

                    </ul>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ma'lumotlar</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-phone margin-r-5"></i> Telefon</strong>

                    <p class="text-muted">
                        {{auth()->guard('teacher')->user()->phone}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Manzili</strong>

                    <p class="text-muted">{{ auth()->guard('teacher')->user()->address }}</p>

                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Tug'ilgan kuni</strong>

                    <p class="text-muted">{{ auth()->guard('teacher')->user()->birthday }}</p>

                    <hr>
                    <strong><i class="fa fa-desktop margin-r-5"></i> Mutahassisliklari</strong>

                    <p>
                        @foreach(auth()->guard('teacher')->user()->courses as $course)
                        <span class="label label-primary">{{ $course->name }}</span>
                        @endforeach
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Passport</strong>

                    <p>{{ auth()->guard('teacher')->user()->passport }}</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#anketa" data-toggle="tab" aria-expanded="false">Anketa</a></li>
                    <li class=""><a href="#auth" data-toggle="tab" aria-expanded="false">Parolni yangilash</a></li>
                </ul>
                <div class="tab-content">


                    <div class="tab-pane active" id="anketa">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">F.I.O</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control"  value="{{ auth()->guard('teacher')->user()->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Passport ma'lumoti</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail" value="{{ auth()->guard('teacher')->user()->passport }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Telefon</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="{{ auth()->guard('teacher')->user()->phone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Manzil</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="{{ auth()->guard('teacher')->user()->address }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Tug'ilgan kuni</label>

                                <div class="col-sm-10">
                                    <input type="date" class="form-control" value="{{ auth()->guard('teacher')->user()->birthday }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Mutahassisliklari</label>

                                <div class="col-sm-10">


                                    <select name="course_id[]" class="form-control select2" id="" multiple data-placeholder="Yo'nalishni tanlang" required>
                                        @foreach ($courses as $course)
                                            <option @isset($course_ids) {{ in_array($course->id, $course_ids) ? 'selected' : '' }} @endisset value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info">Yangilash</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="auth">
                        <form class="form-horizontal">

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" value="{{ auth()->guard('teacher')->user()->email }}" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password"  class="form-control" id="inputName" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-info">Yangilash</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection
@section('js')
    <script>
        $('.select2').select2();
    </script>
@endsection
