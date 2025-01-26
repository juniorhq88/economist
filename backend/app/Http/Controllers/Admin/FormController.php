<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Models\Form;
use App\Repositories\FormRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FormController extends Controller
{
    protected $formRepository;

    public function __construct(FormRepository $formRepository)
    {
        $this->formRepository = $formRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $forms = $this->formRepository->getPagination($request);

        if ($request->ajax()) {
            $forms = $this->formRepository->getPagination($request);

            return view('forms._partials.table-results', compact('forms'));
        }

        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFormRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->formRepository->create($validatedData);

        return redirect()->route(route: 'forms.index')->with('success', 'Formulario creado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): View
    {
        $form = $this->formRepository->getById($id);

        return view('forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormRequest $request, Form $form): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->formRepository->update($form->id, $validatedData);

        return redirect()->route('forms.index')->with('success', 'Formulario modificado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Form $form): RedirectResponse
    {
        $this->formRepository->delete($form->id);

        return redirect()->route(route: 'forms.index')->with('success', 'Formulario eliminado correctamente');
    }
}
