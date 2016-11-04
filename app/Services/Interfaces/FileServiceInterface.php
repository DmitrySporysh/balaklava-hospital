<?php


namespace App\Services\Interfaces;

use Illuminate\Support\Facades\Request;

interface FileServiceInterface
{

    public function save($file);

    public function has($path);

    public function get($path);

}