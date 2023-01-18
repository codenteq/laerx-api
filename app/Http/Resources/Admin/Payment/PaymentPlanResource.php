<?php

namespace App\Http\Resources\Admin\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'month' => $this->month,
            'description' => $this->description,
        ];
    }
}
