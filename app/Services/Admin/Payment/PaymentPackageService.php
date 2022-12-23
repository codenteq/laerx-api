<?php

namespace App\Services\Admin\Payment;

use App\Models\PaymentPackage;
use App\Services\Base\BaseService;

class PaymentPackageService extends BaseService
{
    public function __construct()
    {
        parent::__construct(PaymentPackage::class);
    }
}
