<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
