<?php
namespace App\QueryFilters;

use App\QueryFilters\Filters\Logs\ActionFilter;
use App\QueryFilters\Filters\Logs\DateFilter;
use App\QueryFilters\Filters\Logs\EntityFilter;
use Illuminate\Database\Eloquent\Builder;

class LogFilters
{
    public function apply(Builder $query, array $filters): Builder
    {
        $query = (new ActionFilter($filters))->apply($query);
        $query = (new DateFilter($filters))->apply($query);
        $query = (new EntityFilter($filters))->apply($query);

        return $query;
    }

}
