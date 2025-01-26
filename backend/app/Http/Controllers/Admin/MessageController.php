<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Repositories\MessageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $forms = $this->messageRepository->getPagination($request);

        if ($request->ajax()) {
            $forms = $this->messageRepository->getPagination($request);

            return view('messages._partials.table-results', compact('forms'));
        }

        return view('messages.index', compact('forms'));
    }

    /**
     * Show the message for creating a new resource.
     */
    public function create(): View
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMessageRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->messageRepository->create($validatedData);

        return redirect()->route(route: 'messages.index')->with('success', value: 'Mensaje creado correctamente');
    }

    /**
     * Show the message for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $message = $this->messageRepository->getById($id);

        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->messageRepository->update($message->id, $validatedData);

        return redirect()->route('messages.index')->with('success', 'Mensaje modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message): RedirectResponse
    {
        $this->messageRepository->delete($message->id);

        return redirect()->route(route: 'messages.index')->with('success', 'Mensaje eliminado correctamente');
    }
}
