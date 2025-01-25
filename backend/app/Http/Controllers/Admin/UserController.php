<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $users = $this->userRepository->getPagination($request);

        if ($request->ajax()) {
            $users = $this->userRepository->getPagination($request);

            return view('users._partials.table-results', compact('users'));
        }

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all(['id', 'name']);

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if (! empty($request->get('password'))) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user = $this->userRepository->create($validatedData);

        $user->assignRole($request->input('role'));

        return redirect()->route('user.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $roles = Role::all(['id', 'name']);

        $user = $this->userRepository->getById($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();

        if (empty($request->get('password'))) {
            $validatedData['password'] = $user->password;
        }

        if (! empty($request->get('password'))) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        $roles = $request->input('role');
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($roles);

        return redirect()->route('user.index')->with('success', 'Usuario modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userRepository->delete($user->id);

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ]);
    }
}
