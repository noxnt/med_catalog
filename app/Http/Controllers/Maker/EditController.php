<?php

namespace App\Http\Controllers\Maker;

use App\Http\Controllers\Controller;
use App\Models\Maker;

class EditController extends Controller
{
    public function __invoke(Maker $maker)
    {
        return view('maker.edit', compact('maker'));
    }
}
