<?php

namespace App\Repositories;

use App\Models\Staff;
use App\Repositories\Interfaces\StaffRepositoryInterface;

class StaffRepository implements StaffRepositoryInterface{

    public function getAll()
    {
        return Staff::school()->latest()->get();
    }

    public function findOne($id)
    {
        return Staff::findOrFail($id);
    }

    public function store($request)
    {
        $requestData=$request->all();

        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/staffs';
            $file->move($path, $image);
            $requestData['image']=$image;
        }

        $filename=str_replace(' ', '-', $request->name).'-'.time().'.png';
        $requestData['qrcode']=$filename;
        $staff=Staff::create($requestData);

        $this->generateIdCard($staff);
    }

    public function update($request, $id)
    {
        $staff = Staff::findOrFail($id);

        $requestData=$request->all();

        if($request->hasFile('image')){

            if($staff->image!='' and file_exists(public_path().'/admin/images/staffs/'.$staff->image)){
                unlink(public_path().'/admin/images/staffs/'.$staff->image);
            }

            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/staffs';
            $file->move(  $path, $image);
            $requestData['image']=$image;
        }

        if(file_exists(public_path().'/admin/images/idcards/'.$staff->name.'.jpg')){
            unlink(public_path().'/admin/images/idcards/'.$staff->name.'.jpg');
        }

        $staff->update($requestData);

        $this->generateIdCard($staff);
    }

    public function generateIdCard($staff)
    {
        $circled_image=circleImage('staffs',$staff->image);

        if(!file_exists(public_path().'/admin/images/qrcodes/'.$staff->qrcode)){
            generateQrcode($staff->id, $staff->qrcode, 'staff');
        }

        if(makeCard($staff, $circled_image, 'staff')){
            $staff->idcard=$staff->name.'.jpg';
            $staff->save();
        }
        return true;
    }

}
