<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Repositories\FormRepository;
use Illuminate\Http\JsonResponse;

class FormController extends Controller
{
    private $formRepository;

    public function __construct(FormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
    }

    public function index(): JsonResponse
    {
        $forms = $this->formRepository->getAll();

        return response()->json($forms);
    }

    public function show(int $id): JsonResponse
    {
        $form = $this->formRepository->getById($id);

        return response()->json($form);
    }

    public function store(CreateFormRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $form = $this->formRepository->create($validatedData);

        return response()->json($form, 201);
    }

    public function update(UpdateFormRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        $form = $this->formRepository->update($id, $validatedData);

        return response()->json($form);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->formRepository->delete($id);

        return response()->json(['deleted' => $deleted], $deleted ? 200 : 404);
    }
}
