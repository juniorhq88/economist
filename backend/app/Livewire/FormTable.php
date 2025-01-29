<?php

namespace App\Livewire;

use App\Enum\UserType;
use App\Models\Form;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class FormTable extends Component
{
    use WithPagination;

    public $search = '';

    public $filter = '';

    public $sortField = 'title';

    public $sortDirection = 'asc';

    public $dateFrom = '';

    public $dateTo = '';

    public $selectedUser = '';

    public $hasAttachment = '';

    protected $queryString = [
        'filter' => ['except' => ''],
        'search' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
        'selectedUser' => ['except' => ''],
        'hasAttachment' => ['except' => ''],
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
        $this->dateFrom = $data['dateFrom'] ?? '';
        $this->dateTo = $data['dateTo'] ?? '';
        $this->selectedUser = $data['selectedUser'] ?? '';
        $this->hasAttachment = $data['hasAttachment'] ?? '';
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['dateFrom', 'dateTo', 'selectedUser', 'hasAttachment']);
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
            })
            ->when($this->dateFrom, function ($query) {
                return $query->whereDate('created_at', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function ($query) {
                return $query->whereDate('created_at', '<=', $this->dateTo);
            })
            ->when($this->selectedUser, function ($query) {
                return $query->where('user_id', $this->selectedUser);
            })
            ->when($this->hasAttachment !== '', function ($query) {
                if ($this->hasAttachment === '1') {
                    return $query->whereHas('messages', function ($query) {
                        $query->whereNotNull('file_path');
                    });
                } else {
                    return $query->whereDoesntHave('messages', function ($query) {
                        $query->whereNotNull('file_path');
                    });
                }
            });

        $forms = $forms->orderBy($this->sortField, $this->sortDirection)
            ->paginate($pagination);

        $users = User::whereHas('roles', function ($query) {
            $query->where('name', UserType::Customer->value);
        })->get();

        return view('livewire.form-table', compact('forms', 'users'));
    }
}
