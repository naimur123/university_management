<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Faculty extends Authenticatable
{
    use HasFactory;

    // public function createdBy(){
    //     return $this->belongsTo(Administrator::class, "added_by");
    // }
    // public function updatedBy(){
    //     return $this->belongsTo(Administrator::class, "updated_by");
    // }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($faculty) {
            $year = Carbon::now()->year;
            $date = Carbon::now()->day;

            $faculty->user_id = static::generateFacultyId($year, $date );
        });
    }

    public static function generateFacultyId($year, $date)
    {
        // Get the last two digits of the mobile number
        // $last_two_digits = substr($mobile, -2);

        // Get the current year and subtract the birth year
        // $age = $dob;
        

 
        // Increment the last faculty ID by 1 (or start at 1 if there are no existing faculty IDs)
        $last_faculty_id = static::max('user_id');
        $increment_number = $last_faculty_id ? intval(substr($last_faculty_id, -5)) + 1 : 1;
        
        // Generate the faculty ID in the format "YYYY-NNNNN-XX"
        return sprintf('%04d-%05d-%s', $year, $increment_number, $date);
    }
}
