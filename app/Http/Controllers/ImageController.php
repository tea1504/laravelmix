<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function get($thuMuc, $tenHinh)
    {
        if(file_exists(public_path('storage/'.$thuMuc.'/').$tenHinh))
            return response()->download(public_path('storage/'.$thuMuc.'/').$tenHinh);
        else
            return response()->download(public_path('storage/'.$thuMuc.'/').'default.png');
    }
}
