<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    protected $table = 'students';

    protected $fillable = [
        'name',
        'age'
    ];

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class,'class_students', 'student_id', 'class_id');
    }

}
