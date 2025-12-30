<?php
namespace App\QueryFilters;

use App\QueryFilters\Filters\Users\RoleFilter;
use App\QueryFilters\Filters\Users\SearchFilter;
use Illuminate\Database\Eloquent\Builder;

class UserFilters
{
    public function apply(Builder $query, array $filters): Builder
    {
        $query = (new SearchFilter($filters))->apply($query);
        $query = (new RoleFilter($filters))->apply($query);

        return $query;
    }

}
