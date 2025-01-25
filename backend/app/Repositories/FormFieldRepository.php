<?php

namespace App\Repositories;

use App\Interfaces\FormFieldRepositoryInterface;
use App\Models\FormField;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class FormFieldRepository implements FormFieldRepositoryInterface
{
    public function getAll(): Collection
    {
        return FormField::all();
    }

    public function getById(int $id): ?FormField
    {
        return FormField::findOrFail($id);
    }

    public function create(array $data): FormField
    {
        return FormField::create($data);
    }

    public function update(int $id, array $data): ?FormField
    {
        $formField = FormField::findOrFail($id);
        $formField->update($data);

        return $formField;
    }

    public function delete(int $id): bool
    {
        return FormField::destroy($id) > 0;
    }

    /**
     * Count FormFields.
     */
    public static function count(): int
    {
        return FormField::count();
    }

    public function getPagination(Request $request)
    {
        $query = FormField::query();

        if ($request->has('search')) {
            $query->where('label', 'like', '%' . $request->input('search') . '%');
        }

        $FormFields = $query->with('roles')->orderByDesc('id')->paginate(25);

        return $FormFields;
    }
}
