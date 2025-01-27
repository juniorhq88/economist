<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): JsonResponse
    {
        $users = $this->userRepository->getAll();

        return response()->json($users);
    }

    public function show(int $id): JsonResponse
    {
        $user = $this->userRepository->getById($id);

        return response()->json($user);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = $this->userRepository->create($validatedData);

        return response()->json($user, 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$id,
        ]);

        $user = $this->userRepository->update($id, $validatedData);

        return response()->json($user);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->userRepository->delete($id);

        return response()->json(['deleted' => $deleted], $deleted ? 200 : 404);
    }
}
