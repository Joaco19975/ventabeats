<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function beats()
    {
        return view('admin.beats');
    }

    public function download($fillename)
    {
        $file_path = storage_path('app/public'. $fillename);

         if(file_exists($file_path)){
            return response()->download($file_path);
         }else{
            abort(404);
         }
    }
}
