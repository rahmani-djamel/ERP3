<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePassword extends Controller
{
    public function index(Request $request)
  {
    $validateUser = Validator::make($request->all(), [
        'password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);



    if($validateUser->fails()){
        return response()->json([
            'status' => false,
            'message' => 'validation error',
            'errors' => $validateUser->errors()
        ], 401);
    }

     $user = $request->user();



    // Check if the current password matches
    if (!Hash::check($request->input('password'), $user->password)) {
        return response()->json([
            'status' => false,
            'error' => 'Current password is incorrect'], 401);
    }

    // Change the password
    $user->password = Hash::make($request->input('new_password'));
    $user->save();

    return response()->json([
        'status' => true,
        'message' => 'تم تغير كلمة السر بنجاح'
    ], 200);
  }
}
