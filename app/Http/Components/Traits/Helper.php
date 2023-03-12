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
        $getsubtractid = substr($id, 0, 3) . substr($id,9);
        $intid = str_replace('-', '', $getsubtractid);
        return intval($intid);
    }
    public function stringId($id){
        $first_part = substr($id, 0, 2); // Get the first two characters (i.e., "23")
        $second_part = substr($id, 9); // Get the characters from index 3 to 7 (i.e., "00001") and convert to integer
        $new_id = $first_part . '-' . $second_part; // Concatenate with a hyphen to get "23-1"
        return $new_id;
    }
}