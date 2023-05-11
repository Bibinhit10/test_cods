<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function add()
    {

        $admin=[
            'name'=>'admin1',
            'password'=>'admin1'
        ];

        $admin['password'] = Hash::make($admin['password']);

        Admin::create($admin);


        return response()->json($admin);

    }


    public function login(Request $request)
    {

        $admin_data=$request->validate([
            'name'=>['string'],
            'password'=>['string']
        ]);

        $admin=Admin::where('name', $admin_data['name'])->first();

        if (empty($admin)) {
            return response()->json('name eshtebah ast ..!',400);
        };


        if (!Hash::check($admin_data['password'], $admin->password)) {
            return response()->json('name eshtebah ast ..!',400);
        }

        $token=[
            'token'=>$admin->createToken('auth_token')->plainTextToken
        ];

        return response()->json($token,200);


    }


}
