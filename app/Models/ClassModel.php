<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name'
    ];

    public function Students()
    {
        return $this->belongsToMany(Student::class,'class_students', 'class_id', 'student_id');
    }


}
