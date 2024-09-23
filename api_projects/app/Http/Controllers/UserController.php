<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
public function sing(Request $request){
    $validation =
    Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'password'=>'required',
    ]);
if($validation->failed()){
return response()->json([
    'status'=>false,
    'message'=>'Validation error',
    'error'=>$validation->error()->all(),
],401);
}

else{
    $data = new User;
    $data->name = $request->name;
    $data->email = $request->email;
    $data->password = Hash::make($request->password);

    $data->save();

    return response()->json([
        'status'=>true,
        'message'=>'User Created Successfully',
        'data'=>$data,
    ],201);

}
}

public function login(Request $request){
    $validation =
    Validator::make($request->all(),[

        'email'=>'required',
        'password'=>'required',
    ]);
     if($validation->failed()){
     return response()->json([
    'status'=>false,
    'message'=>'Authentication faild',
    'error'=>$validation->error()->all(),
],401);
}

else{
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
     $user = Auth::user();
     return response()->json([
    'status'=>true,
    'message'=>'User Login Successfully',
    'data'=>$user,
    'token'=>$user->createToken('api_token')->plainTextToken,
    'token_type'=>'bearer Token',
],200);

    }
}

}

public function logout( Request $request){
$user = $request->user();
$user->tokens()->delete();
Auth::logout();
return response()->json([
    'status'=>true,
    'message'=>'Logged SuccessFully',
],201);
}
}
