<?php
namespace App\QueryFilters\Filters\Tasks;

use Illuminate\Database\Eloquent\Builder;

class TabFilter
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters["tab"]) || $this->filters['tab'] === '') {
            return $query;
        }
        if ($this->filters['tab'] == 'all') {
            return $query;
        } else if ($this->filters['tab'] == 'today') {
            return $query->whereDate('due_at', now());
        } else if ($this->filters['tab'] == 'overdue') {
            return $query->where('due_at', '<', now());
        } else if ($this->filters['tab'] == 'upcoming') {
            return $query->where('due_at', '>', now());
        } else if ($this->filters['tab'] == 'done') {
            return $query->where('status', 'like', 'done');
        } else {
            return $query;
        }
    }
}
