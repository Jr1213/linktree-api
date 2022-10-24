<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required','string'],
            'password' => ['required','min:8']
        ]);

        $user = User::where('email',$request->email)->orWhere('phone',$request->phone)->first();
        
        if($user && Hash::check($request->password,$user->password)){

            return response()->json([
                'success' => true,
                'message' => 'login completed',
                'token' => $user->createToken('login_token')->plainTextToken
            ]);
        }

        return response()->json(['success'=>false],Response::HTTP_FORBIDDEN);
    }
}
