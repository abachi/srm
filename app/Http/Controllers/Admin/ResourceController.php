<?php

namespace App\Http\Controllers\Admin;

use App\Domain\ResourceTypes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResourceController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
