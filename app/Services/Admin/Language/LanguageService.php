<?php

namespace App\Services\Admin\Language;

use App\Models\Language;
use App\Services\Base\BaseService;

class LanguageService extends BaseService
{
    public function __construct()
    {
        parent::__construct(Language::class);
    }
}
