<?php

namespace App\Http\Resources\Admin\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'name' => $this->name,
            'subdomain' => $this->subdomain,
            'email' => $this->email,
            'tax_id' => $this->tax_id,
            'web_url' => $this->web_url,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
            'logo' => $this->logo,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'state_id' => $this->state_id,
            'payment_plan_id' => $this->plan_id,
        ];
    }
}
