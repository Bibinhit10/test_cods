<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//product

    Route::get('get_products',[ProductController::class, 'get_products']);

    Route::get('get_product/{id}',[ProductController::class,'get_product_by_id']);



// admin

    Route::post('admin/add', [AdminController::class,'add']);


    Route::post('admin/login', [AdminController::class,'login']);



    Route::group([
        'middleware' => ['auth:admin']
    ], function(){

        Route::post('/admin/add_product', [ProductController::class, 'AddProducts'])->name('add');

        Route::put('/admin/update_product/{id}',[ProductController::class, 'update_product']);

        Route::delete('/admin/delete_product/{id}',[ProductController::class, 'delete_product']);

    });




//student

    Route::post('/add_student', [ StudentController::class,'add_students' ]);

    Route::get('/get_student/{id}', [ StudentController::class,'get_class_by_student_id' ]);


//class


    Route::get('/get_class/{id}', [ classController::class,'get_student_by_class_id' ]);

    Route::post('add_class',[ ClassController::class,'add_classes' ]);

    Route::post('add_student_to_class',[ ClassController::class,'add_student_class' ]);

    Route::delete('delete_student_to_class',[ ClassController::class,'delete_student_as_class' ]);

