<?php

namespace App\Http\Components\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
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
        // $intid = str_replace('-', '', $getsubtractid);
        // return intval($intid);
        return $getsubtractid;
    }

    //seperately extract id
    public function extractFirstTwo($id){
        $getsubtractid = substr($id, 0, 3);
        return intval($getsubtractid);
    } 
    public function extractLastOne($id){
        $getsubtractid = substr($id,9);
        return intval($getsubtractid);
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

    //date with name
    public function getDateDays(){
        $currentDate = Carbon::now()->startOfWeek(Carbon::FRIDAY);
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $currentDate->copy()->addDays($i);
            $dates[$date->format('Y-m-d')] = $date->format('l');
        }
        return $dates;
    }

     //file size
     public function fileformation($file){
        $bytes = Storage::size($file);
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return '1 byte';
        } else {
            return '0 bytes';
        }
    }
     


}