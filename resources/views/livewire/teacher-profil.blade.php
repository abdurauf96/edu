<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-4">
        <div class="card author-box">
            <div class="card-body">
                <div class="author-box-center">
                    <img alt="image" src="/admin/assets/img/users/user-1.png" class="rounded-circle author-box-picture">
                    <div class="clearfix"></div>
                    <div class="author-box-name">
                    <a href="#">{{ $teacher->name }}</a>
                    </div>
                    <div class="author-box-job">Web Developer</div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Personal Details</h4>
            </div>
            <div class="card-body">
                <div class="py-4">
                    <p class="clearfix">
                    <span class="float-left">
                        Birthday
                    </span>
                    <span class="float-right text-muted">
                        {{ $birthday }}
                    </span>
                    </p>
                    <p class="clearfix">
                    <span class="float-left">
                        Phone
                    </span>
                    <span class="float-right text-muted">
                        {{ $phone }}
                    </span>
                    </p>
                    <p class="clearfix">
                    <span class="float-left">
                        Mail
                    </span>
                    <span class="float-right text-muted">
                        {{ $email }}
                    </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                            Address
                        </span>
                        <span class="float-right text-muted">
                            {{ $address }}
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                            Speciality
                        </span>
                        <span class="float-right text-muted">
                            @foreach($teacher->courses as $course)
                                <span class="label label-primary">{{ $course->name }}</span>
                            @endforeach
                        </span>
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-8">
        <div class="card">
            <div class="padding-20">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="profile-tab1" data-toggle="tab" href="#information" role="tab"
                        aria-selected="true">Malumotlar</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#password" role="tab"
                        aria-selected="false">Parolni yangilash</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    
                    <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="profile-tab1">
                    
                        {{-- <div class="card-header">
                            <h4>Malumotlarni tahrirlash</h4>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>F.I.O</label>
                                    <input type="text" class="form-control" wire:model.lazy="name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Passport ma'lumotlari</label>
                                    <input type="text" class="form-control" wire:model="passport">
                                    @error('passport')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Telefon</label>
                                    <input type="text" class="form-control" wire:model="phone">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Manzil</label>
                                    <input type="text" class="form-control" wire:model="address">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Tug'ilgan yili</label>
                                    <input type="date" class="form-control" wire:model="birthday">
                                    @error('birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="form-group col-md-6 col-12">
                                    <label>Mutahasisliklari</label>
                                    <select wire:model="course_id" data-height="100%" class="form-control" multiple data-placeholder="Yo'nalishni tanlang" required>
                                        @foreach ($courses as $course)
                                            <option @isset($course_id) {{ in_array($course->id, $course_id) ? 'selected' : '' }} @endisset value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" wire:click="updateInfo" type="submit" >Yangilash</button>
                        </div>
                    
                    </div>
                    <div class="tab-pane fade " id="password" role="tabpanel" aria-labelledby="profile-tab2">
                        
                        {{-- <div class="card-header">
                            <h4>Malumotlarni tahrirlash</h4>
                        </div> --}}
                        <div class="card-body">
                            <div class="row">
                                
                                <div class="form-group col-md-6 col-12">
                                    <label>Email</label>
                                    <input type="email" class="form-control" wire:model="email">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Password</label>
                                    <input type="password" class="form-control" wire:model="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" wire:click="updatePassword" type="submit" >Yangilash</button>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
