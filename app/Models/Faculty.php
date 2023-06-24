<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Faculty extends Authenticatable
{
    use HasFactory;
    use HasUuids;
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
        $increment_number = mt_rand(00000,99999);
        return sprintf('%04d-%05d-%s', $year, $increment_number, $date);
    }


}
