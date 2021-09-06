<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BotStudent extends JsonResource
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
            'chat_id'=>$this->chat_id,
            'fio'=>$this->fio,
            'phone'=>$this->phone,
            'course_id'=>$this->course_id,
            'status'=>$this->status,
            'finished'=>$this->finished,
        ];
    }
}
