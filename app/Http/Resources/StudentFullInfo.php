<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentFullInfo extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'year'=>$this->year,
            'address'=>$this->address,
            'passport'=>$this->passport,
            'status'=>$this->status,
            'sex'=>$this->sex,
            'study_type'=>$this->type,
            'course'=>$this->group->course->name,
            'course_plans'=>$this->group->course->plans,
            'group'=>$this->group->name,
            'image'=>url('').'/admin/images/students/'.$this->image,
            'course-time'=> $this->group->course_days==1 ? 'Dush-Chor-Jum '.$this->group->time : 'Sesh-Pay-Shan'.' '.$this->group->time,
            'payment'=>$this->debt<=0 ? false : true,
            'qrcode_image'=>url('').'/admin/images/qrcodes/'.$this->qrcode
        ];
    }
}
