<?php

namespace App\Repositories;

use App\Interfaces\MessageRepositoryInterface;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MessageRepository implements MessageRepositoryInterface
{
    public function getAll(): Collection
    {
        return Message::all();
    }

    public function getById(int $id): ?Message
    {
        return Message::findOrFail($id);
    }

    public function create(array $data): Message
    {
        return Message::create($data);
    }

    public function update(int $id, array $data): ?Message
    {
        $message = Message::findOrFail($id);
        $message->update($data);

        return $message;
    }

    public function delete(int $id): bool
    {
        return Message::destroy($id) > 0;
    }

    /**
     * Count messages.
     */
    public static function count(): int
    {
        return Message::count();
    }

    public function getPagination(Request $request)
    {
        $query = Message::query();

        if ($request->has('search')) {
            $query->where('subject', 'like', '%' . $request->input('search') . '%')
                ->orWhere('body', 'like', '%' . $request->input('search') . '%');
        }

        $messages = $query->orderByDesc('id')->paginate(25);

        return $messages;
    }
}
