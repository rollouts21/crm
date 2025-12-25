<?php
namespace App\QueryFilters;

use App\QueryFilters\Filters\Tasks\PriorityFilter;
use App\QueryFilters\Filters\Tasks\SearchFilter;
use App\QueryFilters\Filters\Tasks\StatusFilter;
use App\QueryFilters\Filters\Tasks\TabFilter;
use Illuminate\Database\Eloquent\Builder;

class TaskFilters
{
    public function apply(Builder $query, array $filters): Builder
    {
        $query = (new SearchFilter($filters))->apply($query);
        $query = (new PriorityFilter($filters))->apply($query);
        $query = (new StatusFilter($filters))->apply($query);
        $query = (new TabFilter($filters))->apply($query);

        return $query;
    }

}
