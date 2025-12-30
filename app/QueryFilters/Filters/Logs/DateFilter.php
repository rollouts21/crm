<?php
namespace App\QueryFilters\Filters\Logs;

use Illuminate\Database\Eloquent\Builder;

class DateFilter
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        // if (! isset($this->filters["min"]) || $this->filters['min'] === '' && ! isset($this->filters['max']) || $this->filters['max'] === '') {
        //     return $query;
        // }
        if (! isset($this->filters['min']) && isset($this->filters['max'])) {
            return $query->where('created_at', '<=', $this->filters['max']);
        } else if (! isset($this->filters['max']) && isset($this->filters['min'])) {
            return $query->where('created_at', '>=', $this->filters['min']);
        } else if (! isset($this->filters['max']) && ! isset($this->filters['min'])) {
            return $query;
        }

        return $query
            ->when($this->filters['min'], fn($q, $min) =>
                $q->where('created_at', '>=', $min)
            )
            ->when($this->filters['max'], fn($q, $max) =>
                $q->where('created_at', '<=', $max)
            );

    }
}
