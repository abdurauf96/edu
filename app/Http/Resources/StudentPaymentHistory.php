<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentPaymentHistory extends JsonResource
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
            'payment_id'=>$this->id,
            'course'=>$this->course->name ?? null,
            'amount'=>$this->amount,
            'type'=>$this->type,
            'description'=>$this->description,
            'date'=>$this->created_at->format('d-M-Y'),
        ];
    }
}
