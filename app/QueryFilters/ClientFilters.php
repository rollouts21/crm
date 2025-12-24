<?php
namespace App\QueryFilters;

use App\QueryFilters\Filters\Client\ClientSort;
use App\QueryFilters\Filters\Client\SearchFilter;
use App\QueryFilters\Filters\Client\SourceFilter;
use App\QueryFilters\Filters\Client\StatusFilter;
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
