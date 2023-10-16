<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginClientController extends Controller
{
    public function LoginClient(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

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
