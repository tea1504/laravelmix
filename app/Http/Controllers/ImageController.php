<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function get($thuMuc, $tenHinh)
    {
        return response()->download(public_path('storage/'.$thuMuc.'/').$tenHinh);
    }
}
