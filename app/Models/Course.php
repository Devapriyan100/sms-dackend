<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public function student(){
        return $this->hasManyThrough(Student::class, 'enrollments')
                    ->withTimestamps()
                    ->withPivot('enrolled_at');
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
