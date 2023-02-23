<?php

namespace App\Http\Components\Traits;

trait Helper{
    //get Matital Status
    public function getSex($sex){
        switch($sex){
            case "m":
                return "Male";
                break;
            case "f":
                return "Female";
                break;
            case "o":
                return "Other";
                break;
            default:
                return "N/A";
                break;

        }
    }
}