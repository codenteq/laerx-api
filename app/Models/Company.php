<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'name',
        'subdomain',
        'email',
        'tax_id',
        'web_url',
        'phone',
        'is_active',
        'logo',
        'address',
        'zip_code',
        'country_id',
        'city_id',
        'state_id',
        'payment_plan_id',
    ];

    /*public function invoice()
    {
        return $this->hasOne(Invoice::class,'companyId');
    }*/
}
