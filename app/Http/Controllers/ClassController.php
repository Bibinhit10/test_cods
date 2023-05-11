<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Student;
use App\Models\ClassStudent;
use Illuminate\Http\Request;
use App\Http\Resources\Student as studentResource;
use App\Http\Resources\ClassModel as ClassModelResource;


class ClassController extends Controller
{

    public function add_classes(Request $request)
    {

        $class=$request->validate([
            'name'=>['string']
        ]);


        ClassModel::create($class);


        return response()->json([
            'message' => 'add shod !...'
        ], 500);



    }

    public function add_student_class(Request $request)
    {

        $data=$request->validate([
            'student_id'=>['integer'],
            'class_id'=>['integer']
        ]);

        $class = ClassModel::where('id', $data['class_id'] )->first();

        if (empty($class))
        {
            return response()->json([
                'message' => ' in class vojod nadarad !... '
            ], 404);
        }

        $student = Student::where('id', $data['student_id'])->first();

        if (empty($student))
        {
            return response()->json([
                'message' => ' in student vojod nadarad !... '
            ], 404);
        }

        $select_student_to_class = ClassStudent::where('class_id', $data['class_id'])->where('student_id', $data['student_id'])->first();

        if (! empty($select_student_to_class))
        {
            return response()->json([
                'message' => ' in student dar class vjod darad ... '
            ], 404);
        }


        ClassStudent::create($data);


        return response()->json([
            'message' => 'to class add shod !...'
        ], 500);


    }

    public function delete_student_as_class (Request $request)
    {

        $data=$request->validate([
            'student_id'=>['integer'],
            'class_id'=>['integer']
        ]);


        $select_student_to_class = ClassStudent::where('class_id', $data['class_id'])->where('student_id', $data['student_id'])->first();

        if (empty($select_student_to_class))
        {
            return response()->json([
                'message' => ' student id ya class id eshtebah ast ... '
            ], 404);
        }


        ClassStudent::where('class_id', $data['class_id'])->where('student_id', $data['student_id'])->delete();

        return response()->json([
            'message' => ' student az class delete shod !... '
        ], 500);
    }

    public function get_student_by_class_id($class_id)
    {

        if (empty($class_id)) {

            return response()->json(['not found !. '], 404);
        }


        $data = new ClassModelResource(ClassModel::where('id', $class_id)->with('Students')->first());


        return response()->json($data, 500);


    }

}
