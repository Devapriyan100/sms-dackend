<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
    
    public function courses(){
        return $this->belongsToMany(Course::class, 'enrollments')
                    ->withTimestamps()
                    ->withPivot('enrolled_at');
    }
}
