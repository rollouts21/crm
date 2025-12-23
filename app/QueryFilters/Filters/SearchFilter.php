<?php
namespace App\QueryFilters\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter
{
    public function __construct(protected array $filters = [])
    {}

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters['q']) || $this->filters['q'] === '') {
            return $query;
        }

        $q = $this->filters['q'];

        $like = '%' . addcslashes($q, '%_\\') . '%';

        return $query->where(function (Builder $sub) use ($like) {
            $sub->where('name', 'like', $like)->orWhere('phone', 'like', $like)->orWhere('email', 'like', $like)->orWhere('comment', 'like', $like);
        });
    }
}
