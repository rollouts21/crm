<?php
namespace App\QueryFilters\Filters\Logs;

use Illuminate\Database\Eloquent\Builder;

class ActionFilter
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters["action"]) || $this->filters['action'] === '') {
            return $query;
        }

        return $query->where('action', $this->filters['action']);
    }
}
