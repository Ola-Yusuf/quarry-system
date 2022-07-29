<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
  public function register(Request $request)
  {
      // Validate request data
      $validator = Validator::make($request->all(), [
          'name' => 'nullable|string|max:255',
          'email' => 'required|email|unique:admins|max:255',
          'password' => 'required|min:10',
      ]);
      // Return errors if validation error occur.
      if ($validator->fails()) {
          $errors = $validator->errors();
          return response()->json([
              'error' => $errors
          ], 400);
      }
      
      // Check if validation pass then create user and auth token. Return the auth token
      if ($validator->passes()) {
          $admin = Admin::create([
              'name' => $request->name,
              'email' => $request->email,
              'password' => Hash::make($request->password)
          ]);
          $token = $admin->createToken('auth_token')->plainTextToken;
      
          return response()->json([
              'access_token' => $token,
              'token_type' => 'Bearer',
          ]);
      }
  }
}



