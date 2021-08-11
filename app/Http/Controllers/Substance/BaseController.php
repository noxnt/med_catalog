<?php

namespace App\Http\Controllers\Substance;

use App\Http\Controllers\Controller;
use App\Services\Substance\Service;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
