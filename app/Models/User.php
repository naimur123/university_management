<?php

namespace App\Models;

use App\Events\StudentCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use HasUuids;
    use Notifiable;
    protected $primaryKey = 'id';

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
    public function addedBy(){
        return $this->belongsTo(Administrator::class,'added_by');
    }
    public function updatedBy(){
        return $this->belongsTo(Administrator::class,'updated_by');
    }
    public function courses(){
        return $this->belongsToMany(Course::class);
    }
    public function sections(){
        return $this->belongsToMany(Section::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            $yr = Carbon::now()->year;
            $year = substr($yr, -2);
            $month = Carbon::now()->month;

            $student->user_id = static::generateFacultyId($year, $month );
        });
    }

    public static function generateFacultyId($year, $month)
    {
     
        $students = self::all();
        // $mid_number = intval(explode('-', $last_student_id)[1]);
        // Determine the user_id suffix based on the added month
        if ($month >= 1 && $month <= 6) {
            $suffix = 1;
        } else {
            $suffix = 2;
        }
       
        $random_number = mt_rand(10000,99999);
        $user_id = "{$year}-{$random_number}-{$suffix}";
        foreach($students as $student){
            if($student->user_id == $user_id){
                $random_number = mt_rand(10000,99999);
                $user_id = "{$year}-{$random_number}-{$suffix}";
                continue;
            }
        }
        
        return $user_id;
    }
    public function getUserId(){
        return $this->user_id;
    }
    protected $dispatchesEvents = [
        'created' => StudentCreated::class
     ];
}
