<?php


namespace App\Services;

use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Support\Facades\Storage;


class FileService implements FileServiceInterface
{

    public function __construct()
    {

    }


    public function save($file, $folder)
    {
        $name = Storage::put($folder, $file);
        return $name;
    }

    public function has($path)
    {
        return Storage::has($path);
    }

    public function get($path)
    {
        if ($this->has($path))
            return Storage::get($path);
        else return null;
    }
}