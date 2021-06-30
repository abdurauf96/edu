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
            'course'=>$this->groups[0]->course->name,
            'group'=>$this->groups[0]->name,
            'image'=>'/admin/images/students/'.$this->image,
            'course-time'=> $this->groups[0]->course_days==1 ? 'Dush-Chor-Jum '.$this->groups[0]->time : 'Sesh-Pay-Shan'.' '.$this->groups[0]->time,
            'payment'=>$this->is_debt() ? 'Qarzi bor' : 'Qarzi yo\'q',
        ];
    }
}
