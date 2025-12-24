<?php
namespace App\QueryFilters\Filters\Deal;

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
            $sub->where('title', 'like', $like)->orWhere('comment', 'like', $like)->orWhere('amount', 'like', $like);
        });
    }
}
