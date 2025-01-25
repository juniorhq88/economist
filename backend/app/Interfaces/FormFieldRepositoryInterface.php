<?php

namespace App\Interfaces;

use App\Models\FormField;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface FormFieldRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?FormField;

    public function create(array $data): FormField;

    public function update(int $id, array $data): ?FormField;

    public function delete(int $id): bool;
}
