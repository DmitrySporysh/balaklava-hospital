<?php


namespace App\Services;

use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class FileService implements FileServiceInterface
{

    public function save($file, $folder)
    {
        $name = Storage::put($folder, $file);
        return $name;
    }

    public function has($path)
    {
        return Storage::has($path);
    }

    public function get($filename)
    {
        if ($this->has($filename))
        {
            $filepath = $this->getFilePath($filename);
            return $this->getFileForResponse($filepath);
        } else
            return null;
    }

    /**
     * @param $filename string
     * @return string
     */
    private function getFilePath($filename)
    {
        $filename = str_replace("/", "\\", $filename);
        return public_path() . "\\storage\\" . $filename;
    }

    /**
     * @param $filepath string
     * @return \Illuminate\Http\Response
     */
    private function getFileForResponse($filepath)
    {
        $file = File::get($filepath);
        $type = File::mimeType($filepath);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}