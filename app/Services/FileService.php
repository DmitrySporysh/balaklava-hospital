<?php


namespace App\Services;

//use App\Http\Requests\Request;
use App\Services\Interfaces\FileServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class FileService implements FileServiceInterface
{

    public function __construct()
    {

    }


    public function save($file, $folder, $obj_id)
    {
        //Debugbar::info($file->originalName);
        $extension = explode('/', explode(';', $file)['0'])[1];
        //Debugbar::info($extension);
        date_default_timezone_set('Europe/Moscow');
        $date = date('m/d/Y h:i:s a', time());
        $name = $folder . '/' . bcrypt($obj_id . $date . str_random(16)) . '.' . $extension;
        Storage::put($name, $file);
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