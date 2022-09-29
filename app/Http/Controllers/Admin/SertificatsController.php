<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SertificatsController extends Controller
{
    public function sertificats()
    {
        return view('admin.sertificats.index');
    }
}
