<?php

namespace App\Repositories;

use App\Models\Staff;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Repositories\StaffRepository;

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
        $requestData=$request->all();
        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $path='admin/images/staffs';
            $file->move($path, $image);
            $requestData['image']=$image;
        }
        $staff = Staff::findOrFail($id);
        $staff->update($requestData);
    }

    public function generateIdCard($staff)
    {
        $circled_image=circleImage($staff->image, 'staffs');
       
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
