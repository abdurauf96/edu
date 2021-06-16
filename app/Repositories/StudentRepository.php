<?php

namespace App\Repositories;
use App\Models\Student;
use App\Models\Group;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface{
    public function getAll(){
        return Student::latest()->get();
    }

    public function create($request){
        $requestData = $request->except(['group_id']);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;
        }
        $requestData['code']='qrcode_'.time().'.png';
        $student=Student::create($requestData);
        $student->groups()->attach($request->group_id);
        $this->createQRCode($request->name, $request->phone); 
    }

    public function findOne($id)
    {
        return Student::findOrFail($id);
    }

    public function update($request, $id)
    {
        $requestData = $request->except(['group_id']);
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/students', $image);
            $requestData['image']=$image;   
        }

        $student = $this->findOne($id);

        $payments_str='';
        foreach($student->payments as $payment){
            $payments_str.='Guruh nomi - '.$payment->group->name.', To`lov oyi - '.$payment->month->name.' <br>'; 
        }
        
        $this->createQRCode($request->name, $request->phone, $payments_str);

        $requestData['code']=time().'.png';
        $student->update($requestData);
    }

    public function removeFromGroup($group_id, $student_id)
    {
        Group::find($group_id)->students()->detach($student_id);
    }

    public function addStudentToGroup($group_id, $student_id)
    {
        Group::find($group_id)->students()->attach($student_id);
    }

    public function createQRCode($name, $phone, $payments_str=null)
    {
        if($payments_str!=null){
            $qrcode_info=<<<TEXT
            Ismi: {$request->name};
            Telefon raqami: {$request->phone};
            To'lovlari: {$payments_str};
TEXT;
        }else{
            $qrcode_info=<<<TEXT
            O`quvchi:
            Ismi: {$name},
            Telefon raqami: {$phone},
TEXT;
        }
        \QrCode::size(100)
        ->format('png')
        ->generate($qrcode_info, public_path('admin/images/qrcodes/'.time().'.png'));
    }
}