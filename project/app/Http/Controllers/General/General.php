<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class General extends Controller
{

    public function index()
    {
        return view('index');
    }


    public static function getRoleName($roles = null)
    {
        $role = $roles == null ? Auth::user()->roles : $roles;

        switch ($role) {
            case "1":
                return "Super Admin";
            case "2":
                return "Admin";
        }
    }


}
