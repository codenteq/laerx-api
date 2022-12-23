<?php

namespace App\Services\Admin\Payment;

use App\Models\PaymentPlan;
use App\Services\Base\BaseService;

class PaymentPlanService extends BaseService
{
    public function __construct()
    {
        parent::__construct(PaymentPlan::class);
    }
}
