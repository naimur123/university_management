<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use HasUuids;
    public function department(){
        return $this->belongsTo(Department::class,"department_id");
    }
    public function courseTimeSchedule(){
       return $this->hasMany(CourseTimeSchedule::class);
   }
}
