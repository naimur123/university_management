<?php

namespace App\Http\Components\Traits;

use NumberFormatter;

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
    public function numberform($sem){
        $locale = 'en-US';

        $formatter = new \NumberFormatter($locale, \NumberFormatter::ORDINAL);
        $formattedNumber = $formatter->format($sem);
        return $formattedNumber;
    }
    public function extractId($id){
        return substr($id, 0, 3) . substr($id,9);
    }
}