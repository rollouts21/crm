<?php
namespace App\QueryFilters\Filters\Client;

use Illuminate\Database\Eloquent\Builder;

class ClientSort
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters["sort"]) || $this->filters['sort'] === '') {
            return $query;
        }

        return $query->orderBy($this->filters['sort'], 'desc');
    }
}
