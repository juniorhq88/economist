<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;
use Livewire\WithPagination;

class FormTable extends Component
{
    use WithPagination;

    public $search = '';

    public $filter = '';

    public $sortField = 'title';

    public $sortDirection = 'asc';

    protected $queryString = [
        'filter' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'search-updated' => 'updateSearch',
        'filter-updated' => 'applyFilter',
        'error',
    ];

    protected function getListeners()
    {
        return [
            'filter-updated' => 'applyFilter',
        ];
    }

    /**
     * Apply the given filter to the forms.
     *
     * @param  array  $data
     * @return void
     */
    public function applyFilter($data)
    {
        $this->filter = $data['filter'] ?? '';
        // Reiniciar la paginación cuando se aplica un nuevo filtro
        $this->resetPage();
    }

    public function error($message)
    {
        \Log::error($message);
    }

    public function updateSearch($searchData)
    {
        $this->search = $searchData['search'];
        // Reset pagination cuando se busca
        $this->resetPage();
    }

    public function render()
    {

        $pagination = 15;

        $forms = Form::query()->with(['user', 'messages'])
            ->when($this->search, function ($query) {
                return $query->where('title', 'like', '%'.$this->search.'%');
            });

        $forms = $forms->orderBy($this->sortField, $this->sortDirection)
            ->paginate($pagination);

        /*if ($this->filter) {

            $total = $forms->total();
            $perPage = $forms->perPage();
            $currentPage = $forms->currentPage();

            $forms = new \Illuminate\Pagination\LengthAwarePaginator(
                $filtered,
                $total,
                $perPage,
                $currentPage,
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );
        } else {
            $this->filter = '';
        }*/

        return view('livewire.form-table', compact('forms'));
    }
}
