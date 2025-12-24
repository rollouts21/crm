<?php
namespace App\QueryFilters\Filters\Deal;

use Illuminate\Database\Eloquent\Builder;

class AmountFilter
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
            return $query->where('amount', '<=', $this->filters['max']);
        } else if (! isset($this->filters['max']) && isset($this->filters['min'])) {
            return $query->where('amount', '>=', $this->filters['min']);
        } else if (! isset($this->filters['max']) && ! isset($this->filters['min'])) {
            return $query;
        }

        return $query
            ->when($this->filters['min'], fn($q, $min) =>
                $q->where('amount', '>=', $min)
            )
            ->when($this->filters['max'], fn($q, $max) =>
                $q->where('amount', '<=', $max)
            );

    }
}
