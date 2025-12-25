<?php
namespace App\QueryFilters\Filters\Tasks;

use Illuminate\Database\Eloquent\Builder;

class PriorityFilter
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters["priority"]) || $this->filters['priority'] === '') {
            return $query;
        }

        return $query->where('priority', $this->filters['priority']);
    }
}
