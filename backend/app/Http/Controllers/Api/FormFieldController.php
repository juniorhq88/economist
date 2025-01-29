<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFormFieldRequest;
use App\Http\Requests\UpdateFormFieldRequest;
use App\Repositories\FormFieldRepository;
use Illuminate\Http\JsonResponse;

class FormFieldController extends Controller
{
    private $formFieldRepository;

    public function __construct(FormFieldRepository $formFieldRepository)
    {
        $this->formFieldRepository = $formFieldRepository;
    }

    public function index(): JsonResponse
    {
        $forms = $this->formFieldRepository->getAll();

        return response()->json($forms);
    }

    public function show(int $id): JsonResponse
    {
        $form = $this->formFieldRepository->getById($id);

        return response()->json($form);
    }

    public function store(CreateFormFieldRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        // $form = $this->formFieldRepository->create($validatedData);
        foreach ($validatedData['fields'] as $field) {
            $form = $this->formFieldRepository->create($field);
        }

        return response()->json($form, 201);
    }

    public function update(UpdateFormFieldRequest $request, int $id): JsonResponse
    {
        $validatedData = $request->validated();

        $form = $this->formFieldRepository->update($id, $validatedData);

        return response()->json($form);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->formFieldRepository->delete($id);

        return response()->json(['deleted' => $deleted], $deleted ? 200 : 404);
    }
}
