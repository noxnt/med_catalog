<?php

namespace App\Http\Controllers\Substance;

use App\Http\Controllers\Controller;
use App\Models\Substance;

class EditController extends Controller
{
    public function __invoke(Substance $substance)
    {
        return view('substance.edit', compact('substance'));
    }
}
