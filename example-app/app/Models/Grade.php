<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'class_name',
        'class_numeric',
        'teacher_id',
        'class_description'
    ];

    public function students()
    {
        return $this->hasMany(Student::class,'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
