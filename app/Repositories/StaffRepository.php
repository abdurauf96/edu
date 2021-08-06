<?php

namespace App\Repositories;

use App\Models\Staff;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use App\Repositories\StaffRepository;

class StaffRepository extends BaseRepository implements StaffRepositoryInterface{
    
    public function store($request)
    {
        $requestData=$request->all();

        if($request->hasFile('image')){
            $file=$request->file('image');
            $image=time().$file->getClientOriginalName();
            $file->move('admin/images/staffs', $image);
            $requestData['image']=$image;
        }

        $filename=str_replace(' ', '-', $request->name).'-'.time().'.png';
        $requestData['qrcode']=$filename;
        $staff=Staff::create($requestData);
        $this->createQRCode($staff->id, $filename, 'staff'); 
        
    }
}