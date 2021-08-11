<?php

namespace App\Http\Controllers\Maker;

use App\Http\Controllers\Controller;
use App\Services\Maker\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
