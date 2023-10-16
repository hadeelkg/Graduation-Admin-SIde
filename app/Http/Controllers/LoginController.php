<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends Controller
{
    public function Login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $admin = Admin::where('email', $request->email)->first();
        if(!Hash::check($request->password, $admin->password)){
            return response()->json([
                'message' => ('بيانات الدخول هذه غير مطابقة للبيانات الموجودة في النظام'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token' => $admin->createToken("auth_token")->plainTextToken,
            'id' => $admin->id,
        ],Response::HTTP_OK);
    }

    public function Logout(Request $request)
    {
        $admin = Admin::where ('id',$request->id)->first();

        if (!$admin) {
            // Handle the case when no Admin record is found
            return response()->json([
                'message' => 'Admin not found',
            ], 404);
        }

        $admin->tokens()->delete();
        return response()->json([
            'message' =>"Admin logged out successfully",
        ]);
    }
}
