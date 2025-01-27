<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

class MessageTable extends Component
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

    public function updateSearch($searchData)
    {
        $this->search = $searchData['search'];
        // Reset pagination cuando se busca
        $this->resetPage();
    }

    public function render()
    {

        $pagination = 15;

        $messages = Message::query()->with(['user', 'forms'])
            ->when($this->search, function ($query) {
                return $query->where('subject', 'like', '%'.$this->search.'%');
            });

        $messages = $messages->orderBy($this->sortField, $this->sortDirection)
            ->paginate($pagination);

        /*if ($this->filter) {

            $total = $messages->total();
            $perPage = $messages->perPage();
            $currentPage = $messages->currentPage();

            $messages = new \Illuminate\Pagination\LengthAwarePaginator(
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

        return view('livewire.message-table', compact('messages'));
    }
}

