<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function customSuccessResponse($res){
        return response([
            'status' => 'success',
            'payload' => $res
        ],200);
    }

    public function customFailureResponse($res,$code){
        return response([
            'status' => 'failed',
            'message' => $res
        ],$code);
    }
}
