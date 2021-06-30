<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
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
            'course'=>$this->group->course->name,
            'group'=>$this->group->name,
            'image'=>'/admin/images/students/'.$this->image,
            'course-time'=> $this->group->course_days==1 ? 'Dush-Chor-Jum '.$this->group->time : 'Sesh-Pay-Shan'.' '.$this->group->time,
            'payment'=>$this->is_debt() ? 'Qarzi bor' : 'Qarzi yo\'q',
        ];
    }
}
