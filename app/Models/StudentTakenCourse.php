<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTakenCourse extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'is_confirmed'
    ];
    public function course_time(){
        return $this->belongsTo(CourseTimeSchedule::class,'course_time_schedule_id');
    }
}
