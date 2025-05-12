<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return response()->json($users);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
    $request ->validate([
        'name'=>'required',
        'email'=>'required|unique:users',
        'password'=>'required',
    ]);
 
        $user = User::create([
            'email'=>$request->email,
            'password'=>$request->password,
            'name'=>$request->name
        ]);
        return response()->json([
            'message'=>'User created seccessfully',
            'user'=>$user
        ],status:201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('posts')->find($id);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'Foydalanuvchi topilmadi'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'data' => $user
        ]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
        $user=User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();


        return response()->json([
            'message'=>'User updated seccessfully ',
            'user'=>$user
        ],status:200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
