<div>
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                {{--                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">--}}

                <h3 class="profile-username text-center">{{ $teacher->name }}</h3>

                {{--                    <p class="text-muted text-center">Software Engineer</p>--}}

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>O'quvchilar</b> <a class="pull-right">{{ count($teacher->students) }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Guruhlar</b> <a class="pull-right">{{ count($teacher->groups) }}</a>
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
                    {{ $phone}}
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Manzili</strong>

                <p class="text-muted">{{ $address }}</p>

                <hr>
                <strong><i class="fa fa-map-marker margin-r-5"></i> Tug'ilgan kuni</strong>

                <p class="text-muted">{{ $birthday }}</p>

                <hr>
                <strong><i class="fa fa-desktop margin-r-5"></i> Mutahassisligi</strong>

                <p>
                    @foreach($teacher->courses as $course)
                        <span class="label label-primary">{{ $course->name }}</span>
                    @endforeach
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Passport</strong>

                <p>{{ $passport }}</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">



        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li ><a class="btn bg-olive btn-flat margin" wire:click.prevent="setTab('anketa')" data-key="#anketa" href="#anketa"  >Ma'lumotlarni yangilash</a></li>
                <li><a class="btn bg-olive btn-flat margin" wire:click.prevent="setTab('auth')" data-key="#auth" href="#auth"  >Parolni yangilash</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane @if($key=='anketa') active @endif" id="anketa">
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">F.I.O</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" wire:model="name">
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Passport ma'lumoti</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail" wire:model="passport">
                                @error('passport') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Telefon</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" wire:model="phone" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputExperience" class="col-sm-2 control-label">Manzil</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" wire:model="address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputExperience" class="col-sm-2 control-label">Tug'ilgan kuni</label>

                            <div class="col-sm-10">
                                <input type="date" class="form-control" wire:model="birthday">
                                @error('birthday') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSkills" class="col-sm-2 control-label">Mutahassisliklari</label>

                            <div class="col-sm-10">


                                <select wire:model="course_id" class="form-control " multiple data-placeholder="Yo'nalishni tanlang" required>
                                    @foreach ($courses as $course)
                                        <option @isset($course_id) {{ in_array($course->id, $course_id) ? 'selected' : '' }} @endisset value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit"  class="btn bg-olive btn-flat margin" wire:click="updateInfo({{ auth()->guard('teacher')->user()->id }})">Yangilash</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane @if($key=='auth') active @endif"  id="auth">
                    <div class="form-horizontal"   >

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control"  wire:model="email" >
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Yangi parol</label>

                            <div class="col-sm-10">
                                <input type="password"  class="form-control" wire:model="password" placeholder="Password">
                                @error('password') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn bg-olive btn-flat margin" wire:click="updatePassword({{ auth()->guard('teacher')->user()->id }})">Yangilash</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
</div>
