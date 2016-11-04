<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Http\Request;

//Debugbar
use Barryvdh\Debugbar\Facade;
use Debugbar;

class FileController extends Controller
{
    private $fileService;

    public function __construct(FileServiceInterface $fileService)
    {
        $this->fileService = $fileService;
        //$this->middleware('auth');
    }

    public function getFile(Request $request)
    {
        $response = $this->fileService->get($request->file_path);
        return $response;
    }

    public function saveFile(Request $request)
    {
        $file = $request->file('photo');
        if ($file)
            return $this->fileService->save($file);

    }
}
