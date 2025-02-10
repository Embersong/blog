<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function login(Request $request) {
       if (Auth::attempt($request->only('email', 'password'))) {
           $authUser = Auth::user();

/*           $response = [
               'success' => true,
               'message' => 'Успешный вход',
               'user' => $authUser,
               'token' => $authUser->createToken('auth_token')->plainTextToken,
           ];*/
          // return response()->json($response, 200);
           return new AuthResource((object)[
               'token' => $authUser->createToken('auth_token')->plainTextToken,
               'user' => $authUser
           ]);
       }
       else {
            $response = [
                'success' => false,
                'message' => 'Invalid Email or Password',
            ];

            return response()->json($response, 401);
       }
    }

    public function logout(Request $request)
    {

        Auth::user()->tokens()->delete();

        $response = [
            'success' => true,
            'message' => 'Пользователь вышел',
         ];

        return response()->json($response, 200);

    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => 'Ошибка валидации',
                'data' => $validator->errors(),
            ];
            return response()->json($response, 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::query()->create($input);

        $response = [
            'success' => true,
            'message' => 'Пользователь создан успешно',
            'user' => $user,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ];

        return response()->json($response, 200);
    }
}
