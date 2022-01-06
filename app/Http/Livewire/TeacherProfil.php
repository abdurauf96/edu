<?php

namespace App\Http\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Hash;
use App\Models\Course;

class TeacherProfil extends Component
{
    public $teacher, $name, $birthday, $address, $passport, $phone, $email, $password, $key;
    public $course_id=[];

    protected $rules = [
        'password' => 'required|min:6',
        'email' => 'required|email',
    ];

    public function mount()
    {
        $this->teacher=auth()->guard('teacher')->user();
        $this->name=$this->teacher->name;
        $this->birthday=$this->teacher->birthday;
        $this->address=$this->teacher->address;
        $this->passport=$this->teacher->passport;
        $this->phone=$this->teacher->phone;
        $this->email=$this->teacher->email;
        foreach ($this->teacher->courses as $course){
            array_push($this->course_id, $course->id);
        }

    }

    
    public function updatePassword()
    {
        $this->validate();
        
        $data['email']=$this->email;
        if(isset($this->password)){
            $data['password']=Hash::make($this->password);
        }
        $this->teacher->update($data);
        $this->dispatchBrowserEvent('updated');
        $this->password='';

    }

    public function updateInfo()
    {
       
        $this->teacher->name=$this->name;
        $this->teacher->birthday=$this->birthday;
        $this->teacher->passport=$this->passport;
        $this->teacher->address=$this->address;
        $this->teacher->phone=$this->phone;
        $this->teacher->courses()->sync($this->course_id);
        $this->teacher->save();
       
        $this->dispatchBrowserEvent('updated');
    }

    public function render()
    {
        $courses=Course::all();
        return view('livewire.teacher-profil', compact('courses'));
    }
}
