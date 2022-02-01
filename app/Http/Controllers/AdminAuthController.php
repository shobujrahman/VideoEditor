<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function register(Request $request)
    {

        //make validator
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:posts|max:255',
            'password' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->first()
            ]);
        }

        //create user
        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'register successfully'
        ]);
    }


    public function login()
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:posts|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->first()
            ]);
        }

        // check if email exist
        $user = Admin::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'failure',
                'message' => 'email not found'
            ]);
        }

        // check if password is correct
        if (!\Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failure',
                'message' => 'password is incorrect'
            ]);
        }

        // generate token
        $token = $user->createToken('admin_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'message' => 'login successfully',
            'user' => $user
        ]);
    }
}
