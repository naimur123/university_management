<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Components\Classes\Fetchify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request){

        if( $request->field == "email" ){
            $response = (new Fetchify())->isValidEmail($request->field_value);
            return $response;
        }
        else{
            return $this->emptyResponse();
        }
        
    }
}
