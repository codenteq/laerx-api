<?php

namespace App\Services\Admin\Group;

use App\Models\Group;
use App\Services\Base\BaseService;

class GroupService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Group::class);
    }
}
