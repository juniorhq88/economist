<?php

namespace App\Interfaces;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface MessageRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Message;

    public function create(array $data): Message;

    public function update(int $id, array $data): ?Message;

    public function delete(int $id): bool;
}
