<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function saveFile(Request $request){
        $file =  $request->file('photo');

        Storage::put('file.jpg', $file);
        dd(Storage::get('file.jpg'));
    }
}
