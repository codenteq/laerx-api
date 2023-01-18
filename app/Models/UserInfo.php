<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'phone',
        'address',
        'is_active',
        'start_date',
        'end_date',
        'period_id',
        'month_id',
        'group_id',
        'language_id',
        'company_id',
        'user_id',
    ];

    /**
     * Get the user phone.
     *
     * @return Attribute
     */
    public function phone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => decrypt($value),
            set: fn ($value) => encrypt($value)
        );
    }

    /**
     * Get the user address.
     *
     * @return Attribute
     */
    public function address(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => decrypt($value),
            set: fn ($value) => encrypt($value)
        );
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id')->withDefault();
    }

    /**
     * @return HasOne
     */
    public function language(): HasOne
    {
        return $this->hasOne(Language::class, 'id', 'language_id')->withDefault();
    }

    /**
     * @return HasOne
     */
    public function class(): HasOne
    {
        return $this->hasOne(ClassRoom::class, 'id', 'class_id')->withDefault();
    }

    /**
     * @return HasOne
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id')->withDefault();
    }
}
