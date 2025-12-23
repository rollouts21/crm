<?php
namespace App\QueryFilters;

use App\QueryFilters\Filters\ClientSort;
use App\QueryFilters\Filters\SearchFilter;
use App\QueryFilters\Filters\SourceFilter;
use App\QueryFilters\Filters\StatusFilter;
use Illuminate\Database\Eloquent\Builder;

class ClientFilters
{
    public function apply(Builder $query, array $filters): Builder
    {
        $query = (new SearchFilter($filters))->apply($query);
        $query = (new StatusFilter($filters))->apply($query);
        $query = (new SourceFilter($filters))->apply($query);
        $query = (new ClientSort($filters))->apply($query);
        return $query;
    }

}
