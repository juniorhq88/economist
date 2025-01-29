<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * signin
     */
    public function signin(Request $request): JsonResponse
    {

        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ]
            );

            if ($validateUser->fails()) {
                return response()->json($validateUser->errors()->first(), 401);
            }

            if (! Auth::attempt($request->only(['email', 'password']))) {
                return response()->json('Email and password do not match our registration', 422);
            }

            $user = $this->userRepository->getUserByEmail($request->email);

            $success['token'] = $user->createToken('MyNewApp')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'token' => $success['token'],
                'user' => $user,
                'message' => 'User logged correctly',
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    /**
     * signup
     */
    public function signup(Request $request): JsonResponse
    {
        $input = $request->all();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ];

        $validateUser = Validator::make($input, $rules);

        if ($validateUser->fails()) {
            return response()->json($validateUser->errors()->first(), 422);
        }

        $input['name'] = ucfirst($input['name']);
        $input['password'] = Hash::make($input['password']);

        $user = $this->userRepository->create($input);

        $success['token'] = $user->createToken('MyNewApp')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'token' => $success,
            'message' => 'User created successfully',
        ]);
    }
}
