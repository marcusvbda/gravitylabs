<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class PaginatedList extends Component
{
    public Collection $items;
    public $limit = 10;
    public $total = null;
    public $hasMorePages = false;

    public function makeQuery(): mixed
    {
        return Model::query();
    }

    public function loadList($skip = 0): void
    {
        $query = $this->makeQuery();
        $this->total = $query->count();
        $query = $query->take($this->limit)->skip($skip);
        $this->items = !$skip ?  $query->get() : $this->items->toBase()->merge($query->get());
        $this->hasMorePages = $this->items->count() < $this->total;
    }


    public function loadMore(): void
    {
        $this->loadList($this->items->count());
    }
}
