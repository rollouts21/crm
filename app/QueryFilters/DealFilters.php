<?php
namespace App\QueryFilters;

use App\QueryFilters\Filters\Deal\AmountFilter;
use App\QueryFilters\Filters\Deal\DealSort;
use App\QueryFilters\Filters\Deal\SearchFilter;
use App\QueryFilters\Filters\Deal\StatusFilter;
use Illuminate\Database\Eloquent\Builder;

class DealFilters
{
    public function apply(Builder $query, array $filters): Builder
    {
        $query = (new SearchFilter($filters))->apply($query);
        $query = (new StatusFilter($filters))->apply($query);
        $query = (new AmountFilter($filters))->apply($query);
        $query = (new DealSort($filters))->apply($query);

        return $query;
    }

}
