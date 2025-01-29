<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Repositories\MessageRepository;
use Illuminate\Http\JsonResponse;

class MessageController extends Controller
{
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function index(): JsonResponse
    {
        $messages = $this->messageRepository->getAll();

        return response()->json($messages);
    }

    public function show(int $id): JsonResponse
    {
        $message = $this->messageRepository->getById($id);

        return response()->json($message);
    }

    public function store(CreateMessageRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $message = $this->messageRepository->create($validatedData);

        return response()->json($message, 201);
    }

    public function update(UpdateMessageRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        $message = $this->messageRepository->update($id, $validatedData);

        return response()->json($message);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->messageRepository->delete($id);

        return response()->json(['deleted' => $deleted], $deleted ? 200 : 404);
    }
}
