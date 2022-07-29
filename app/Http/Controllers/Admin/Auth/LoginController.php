<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

  public function login(Request $request)
  {
      if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
          return response()->json([
              'message' => 'Invalid login details'
          ], 401);
      }
      $admin = Admin::where('email', $request['email'])->firstOrFail();
      $token = $admin->createToken('auth_token')->plainTextToken;
      return response()->json([
          'access_token' => $token,
          'token_type' => 'Bearer',
      ]);
  }


   /**logout api 
    @return \Illuminate\Http\Response / 
    **/
    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['success' => 'You are Logged Out Successfully As Admin'], 200);
    }





}
