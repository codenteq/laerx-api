<?php

namespace App\Services\Admin\Period;

use App\Models\Period;
use App\Services\Base\BaseService;

class PeriodService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Period::class);
    }
}
