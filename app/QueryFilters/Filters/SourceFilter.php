<?php
namespace App\QueryFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class SourceFilter
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters["source_id"]) || $this->filters['source_id'] === '') {
            return $query;
        }

        return $query->where('source_id', $this->filters['source_id']);
    }
}
