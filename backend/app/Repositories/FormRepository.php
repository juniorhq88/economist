<?php

namespace App\Repositories;

use App\Enum\UserType;
use App\Interfaces\FormRepositoryInterface;
use App\Models\Form;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormRepository implements FormRepositoryInterface
{
    public function getAll(): Collection
    {
        if (Auth::user()->role == UserType::Customer) {
            $userId = Auth::user()->id;

            return Form::with(['messages', 'fields'])->where('user_id', $userId)->get();
        }

        return Form::with(['messages', 'fields'])->get();
    }

    public function getAllMine(): Collection
    {

        return Form::with(['messages', 'fields'])->where('user_id', Auth::user()->id)->get();
    }

    public function getById(int $id): ?Form
    {
        return Form::with(['messages', 'fields'])->findOrFail($id);
    }

    public function create(array $data): Form
    {
        return Form::create($data);
    }

    public function update(int $id, array $data): ?Form
    {
        $form = Form::findOrFail($id);
        $form->update($data);

        return $form;
    }

    public function delete(int $id): bool
    {
        return Form::destroy($id) > 0;
    }

    /**
     * Count Forms.
     */
    public static function count(): int
    {
        return Form::count();
    }

    public function getPagination(Request $request)
    {
        $query = Form::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%'.$request->input('search').'%')
                ->orWhere('description', 'like', '%'.$request->input('search').'%');
        }

        $forms = $query->orderByDesc('id')->paginate(25);

        return $forms;
    }

    public static function getMessageFromUser(int $idForm)
    {
        return Message::where('form_id', $idForm)->paginate(15);
    }
}
