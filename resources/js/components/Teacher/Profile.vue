<template>
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-4">
            <div class="card author-box">
                <div class="card-body">
                    <div class="author-box-center">
                        <img alt="image" src="/admin/images/teacher.png" class="rounded-circle author-box-picture">
                        <div class="clearfix"></div>
                        <div class="author-box-name">
                        <a href="#">{{ teacher.name }}</a>
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
                            {{ teacher.birthday }}
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Phone
                        </span>
                        <span class="float-right text-muted">
                            {{ teacher.phone }}
                        </span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left">
                            Mail
                        </span>
                        <span class="float-right text-muted">
                            {{ teacher.email }}
                        </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Address
                            </span>
                            <span class="float-right text-muted">
                                {{ teacher.address }}
                            </span>
                        </p>
                        <p class="clearfix">
                            <span class="float-left">
                                Speciality
                            </span>
                            <span class="float-right text-muted">
                                
                                    <span v-for="course in teacher.courses" class="label label-primary">{{ course.name }}</span>
                                
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
                        
                            <form >
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>F.I.O</label>
                                        <input type="text" class="form-control" v-model="teacher.name">
                                        
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Passport ma'lumotlari</label>
                                        <input type="text" class="form-control" v-model="teacher.passport">
                                       
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Telefon</label>
                                        <input type="text" class="form-control" v-model="teacher.phone">
                                       
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Manzil</label>
                                        <input type="text" class="form-control" v-model="teacher.address">
                                        
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Tug'ilgan yili</label>
                                        <input type="date" class="form-control" v-model="teacher.birthday">
                                       
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-12">
                                        <label>Mutahasisliklari</label>
                                        <select v-model="course_id" data-height="100%" class="form-control" multiple data-placeholder="Yo'nalishni tanlang" required>
                                                <option  v-for="(course,id) in courses" v-if="course_id.includes(course.id)" selected :key="id" :value="course.id"> {{ course.name }} </option>
                                                <option  v-else="(course,id) in courses"  :key="id" :value="course.id"> {{ course.name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" @click.prevent="updateInfo" type="submit" >Yangilash</button>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane fade " id="password" role="tabpanel" aria-labelledby="profile-tab2">
                           
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" :class="errors.email  ? 'is-invalid' : '' " v-model="userLoginData.email">
                                        <span class="invalid-feedback" v-if="errors.email">{{ errors.email[0] }}</span>
                                       
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Password</label>
                                        <input type="password" class="form-control" :class="errors.password ? 'is-invalid' : ''" v-model="userLoginData.password">
                                        <span class="invalid-feedback" v-if="errors.password">{{ errors.password[0] }}</span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" @click="updateLogin" >Yangilash</button>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    data(){
        return {
            teacher: {
                courses:[]
            },
            courses:[],
            course_id:[],
            userLoginData:{
                email:'',
                password: ''
            },
            errors: {
                email:'',
                password:'',
            }
        }
    },
    mounted(){
        this.getTeacher();
    },
    methods:{
        getTeacher(){
            axios.get('/teacher/info').then((response)=>{
                this.teacher=response.data.teacher;
                this.courses=response.data.courses;
                this.course_id=response.data.course_id;
            })
        },
        updateInfo(){
            this.teacher.courses=this.course_id;
            axios.post('/teacher/info', this.teacher)
            .then((res)=>{
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "Ma'lumot muvaffaqiyatli yangilandi",
                    showConfirmButton: false,
                    timer: 1500
                })
            }).catch((err)=>{
                console.log(err.data.error);
            })
        },
        updateLogin(){
            console.log( this.userLoginData);
            axios.post('/teacher/update-login', this.userLoginData)
            .then((res)=>{
                console.log(res.data)
               Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "Ma'lumot muvaffaqiyatli yangilandi",
                    showConfirmButton: false,
                    timer: 1500
                }) 
                this.errors={};
            })
            .catch((err)=>{
                this.errors.email=err.response.data.errors.email;
                this.errors.password=err.response.data.errors.password;
                console.log(err.response.data.errors.email);
            })
        }
    }
}

</script>
