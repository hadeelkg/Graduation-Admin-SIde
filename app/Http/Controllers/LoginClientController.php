<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class LoginClientController extends Controller
{
    public function LoginClient(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        $validated = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        if ($validated->fails()) {
            return response()->json([
                'message' => __('messages.validation_error'),
                'errors' => $validated->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {

            return response()->json([
                'message' => __('auth.failed'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        $client = Client::where('email', $request->email)->first();
        if(!Hash::check($request->password, $client->password)){
            return 'wrong data';
        }
        return response()->json([
            'token' => $client->createToken("auth_token")->plainTextToken,
            'id' => $client->id,
            'message' => "Client logged in successfully"
        ]);
    }

    public function LogoutClient(Request $request)
    {
        $client = Client::where ('id',$request->id)->first();

        if (!$client) {
            return response()->json([
                'message' => 'Client not found',
            ], 404);
        }

        $client->tokens()->delete();
        return response()->json([
            'message' =>"Client logged out successfully",
        ]);
    }
}
