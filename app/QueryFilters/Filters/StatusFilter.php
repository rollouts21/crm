<?php
namespace App\QueryFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class StatusFilter
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters["status"]) || $this->filters['status'] === '') {
            return $query;
        }

        return $query->where('status', $this->filters['status']);
    }
}
