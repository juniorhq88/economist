<?php

namespace App\Repositories;

use App\Enum\UserType;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    public function getAll(): Collection
    {
        return User::all();
    }

    public function getAllCustomer(): Collection
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', UserType::Customer->value);
        })->get();
    }

    public function getById(int $id): ?User
    {
        return User::findOrFail($id);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): ?User
    {
        $user = User::findOrFail($id);
        $user->update($data);

        return $user;
    }

    public function delete(int $id): bool
    {
        return User::destroy($id) > 0;
    }

    /**
     * Count Users.
     */
    public static function count(): int
    {
        return User::count();
    }

    public function getPagination(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->input('search').'%')
                ->orWhere('email', 'like', '%'.$request->input('search').'%');
        }

        $users = $query->with('roles')->orderByDesc('id')->paginate(25);

        return $users;
    }

    public function getUserByEmail(string $email): User
    {
        return User::whereEmail($email)->first();
    }
}
