<?php

namespace App\Http\Components\Traits;

use Carbon\Carbon;
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
    //string to id
    public function extractId($id){
        $getsubtractid = substr($id, 0, 3) . substr($id,9);
        $intid = str_replace('-', '', $getsubtractid);
        return intval($intid);
    }
    public function stringId($id){
        $first_part = substr($id, 0, 2); 
        $second_part = substr($id, 9); 
        $new_id = $first_part . '-' . $second_part;
        return $new_id;
    }

     //semeseter add
     public function semAdd(){
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        if ($month >= 1 && $month <= 6) {
             $session = 'Summer'.'-'. $year;
             return $session;
        } else {
             $session = 'Fall'.'-'. $year;
             return $session;
        }
     }

     //days get
     public function daysGet(){
        $days = [];
        $now = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        for ($i = 0; $i < 7; $i++) {
            $day = $now->copy()->addDays($i)->format('l');
            if ($day !== 'Friday') {
                $days[] = $day;
                
            }
        }
        return $days;
     }
     


}