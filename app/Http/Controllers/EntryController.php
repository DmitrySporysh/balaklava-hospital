<?php

namespace App\Http\Controllers;

use App\Common\Enums\ProjectStatus;
use App\Common\Enums\UserRole;
use Illuminate\Contracts\Validation\UnauthorizedException;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class EntryController extends Controller
{
    public function index()
    {
       if(Auth::guest()){

        return view('entry');
       }
        return redirect('/profile');
    }

    public function profile()
    {
       
        if(Auth::guest()){
            return redirect('/entry');
        }

        $role = Auth::user()->role;
        if($role == UserRole::WEBMASTER){

            return redirect('/webmaster');
        }
        if($role == UserRole::MODERATOR){

            return redirect('/moderator/banners');
        }
        if($role == UserRole::ADMIN){
            return redirect('/admin/applications');
        }
        if($role == UserRole::ADVERTISER){

            return redirect('/advertiser/profile');
        }
    }

    public function getForgetPasswordPage()
    {
        return view('/forgetPassword');
    }
}
