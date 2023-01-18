<?php

namespace App\Services\Admin\Payment;

use App\Models\PaymentCoupon;
use App\Services\Base\BaseService;

class PaymentCouponService extends  BaseService
{
    public function __construct()
    {
        parent::__construct(PaymentCoupon::class);
    }
}
