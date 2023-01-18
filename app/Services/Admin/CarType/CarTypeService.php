<?php

namespace App\Services\Admin\CarType;

use App\Models\CarType;
use App\Services\Base\BaseService;

class CarTypeService extends BaseService
{
    public function __construct()
    {
        parent::__construct(CarType::class);
    }
}
