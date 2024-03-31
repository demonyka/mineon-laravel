<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    public function view()
    {
        return inertia('Cabinet/Cabinet');
    }
}
