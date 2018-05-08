<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
    public function sendData($message,$data){
        $json = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($json,200);
    }

    public function fail($message){
        $json = [
            'message' => $message
        ];
        return response()->json($json,403);
    }
}
