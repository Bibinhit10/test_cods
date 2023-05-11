<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use App\Http\Resources\Student as studentResource;
use App\Http\Resources\ClassModel as ClassModelResource;

class StudentController extends Controller
{

    public function add_students(Request $request)
    {

        $student=$request->validate([
            'name'=>['string'],
            'age'=>['integer']
        ]);


        Student::create($student);


        return response()->json([
            'message' => 'add shod !...'
        ], 500);


    }

    public function get_class_by_student_id(int $student_id)
    {

        if (empty($student_id)) {

            return response()->json(['not found !. '], 404);
        }


        // $data = new StudentResource(Student::where('id', $student_id)->with('classes')->first());

        $data =ClassModel::whereHas('Students', function ($query) use($student_id) {

            $query->where('students.id', $student_id );
        })->get();;


        return response()->json($data, 200);


    }


}
