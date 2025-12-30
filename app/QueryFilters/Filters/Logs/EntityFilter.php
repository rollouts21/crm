<?php
namespace App\QueryFilters\Filters\Logs;

use Illuminate\Database\Eloquent\Builder;

class EntityFilter
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters["entity_type"]) || $this->filters['entity_type'] === '') {
            return $query;
        }

        return $query->where('entity_type', $this->filters['entity_type']);
    }
}
