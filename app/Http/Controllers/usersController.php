<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin as Admin;

class usersController extends Controller
{
    public function add(){
        Admin::add1();
        $admin = new Admin();
        $admin->add2();
        


    }
}
