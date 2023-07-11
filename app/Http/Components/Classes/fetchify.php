<?php

namespace App\Http\Components\Classes;

use Exception;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class Fetchify{

    protected $status = false;
    protected $message = "Invalid";

    /**
     * API Response
     * @return Array
     */
    protected function output($messages, $status, $data){

        $this->message = $messages ?? $this->message;
        $this->status = $status ?? $this->status;
        $response  = $data ?? "error";
        return [
            'status'    => $this->status,
            "message"   => $this->message,
            "response"=>  $response
        ];
    }

    /**
     * Validate Email
     */
    public function isValidEmail($email){
        $key = "qRuC1llLTknRABNgs0HSX";
    $url = "https://apps.emaillistverify.com/api/verifyEmail";
    $params = [
        "secret" => $key,
        "email"  => $email,
    ];
    $response = Http::get($url, $params);
    if ($response->body() === "ok") {
        $this->status = true;
        $this->message = "The Email Address is Valid";
        
    } else {
        $this->status = false;
        $this->message = "The Email Address is not Valid";
    }
    // if (!$this->status) {
    //     throw new Exception($this->message);
        
    // }
    return $this->output($this->message, $this->status, $response->body());

    }

}
    
