<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


public function SendData($data){
    return $this->SendSuccess("",$data);
}

public function SendSuccess($message = 'OK',$data=null){
    return response()->json([
        'Success'=> true,'message'=>$message,'data'=>$data
       ]);
}

public function SendError($message = 'Error',$errorCode = 500){
    return response()->json([
        'Success'=> false,'message'=>$message
    ],$errorCode);
}




}
