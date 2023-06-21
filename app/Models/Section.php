<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    use HasUuids;
    // public function courseTimeSchedules()
    // {
    //     return $this->hasMany(CourseTimeSchedule::class, 'section_id');
    // }
}
