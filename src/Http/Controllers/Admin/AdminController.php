<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function spa(){
        return view("vendor.admin.spa");
    }
}
