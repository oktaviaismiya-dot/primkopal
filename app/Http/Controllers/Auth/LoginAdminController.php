<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginAdminController extends Controller
{
    public function LoginAdmin()
    {
         return view('Auth.login-admin');
    }
}
