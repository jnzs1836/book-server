<?php

namespace App\Http\Controllers;


class MainPageController extends Controller
{
    public function __construct()
    {
        //
    }

    public function get(){
        return "Hello World";
    }
}
