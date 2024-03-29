<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseTimeSchedule extends Model
{
    use HasFactory;
    use HasUuids;
    // protected $fiilable=[

    //     'day'
    // ];
    protected $casts=[
        'day' => "array"
    ];
    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class,'course_id');
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
}
