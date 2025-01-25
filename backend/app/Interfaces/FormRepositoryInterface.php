<?php

namespace App\Interfaces;

use App\Models\Form;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface FormRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Form;

    public function create(array $data): Form;

    public function update(int $id, array $data): ?Form;

    public function delete(int $id): bool;
}
