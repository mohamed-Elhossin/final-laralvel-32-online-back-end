<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{



    public function register(Request $request)
    {
        $data =  $request->validate([
            'name' => "required|string",
            "email" => "required|email|unique:users,email",
            'password' => "required|confirmed"
        ]);


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            "password" => bcrypt($data['password']),
        ]);

        $token = $user->createToken("myToken")->plainTextToken;

        $response = [
            'data' =>      $user,
            'meesage' => ' Create Data successfully',
            'token' =>  $token,
            'status' => 201,
        ];

        Mail::to($user->email)->send(new WelcomeMail($user));

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $data =  $request->validate([
            "email" => "required|email",
            'password' => "required"
        ]);

        $user = User::where("email", '=', $data['email'])->first();

        if (!Hash::check($data['password'], $user->password)  || !$user) {
            $response = [
                'meesage' => 'Can Not Login',
                'status' => 200,
            ];
        } else {
            $token = $user->createToken("myToken")->plainTextToken;
            $response = [
                'data' =>      $user,
                'meesage' => ' Login  successfully',
                'token' =>  $token,
                'status' => 201,
            ];
        }

        Mail::to($user->email)->send(new WelcomeMail($user));

        return response($response, 201);
    }

    public function logout()
    {
        //  Auth::user()->tokens()->delete();
        $response = [
            'meesage' => ' Logout  successfully',
            'status' => 201,
        ];
        return response($response, 201);
    }
}
