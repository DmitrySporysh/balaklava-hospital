<?php


namespace App\Services\Interfaces;

interface FileServiceInterface
{

    public function save($file, $folder);

    public function has($path);

    public function get($path);

}