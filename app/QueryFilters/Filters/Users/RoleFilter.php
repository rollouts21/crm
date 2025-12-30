<?php
namespace App\QueryFilters\Filters\Users;

use Illuminate\Database\Eloquent\Builder;

class RoleFilter
{
    public function __construct(protected array $filters = [])
    {

    }

    public function apply(Builder $query): Builder
    {
        if (! isset($this->filters["role_id"]) || $this->filters['role_id'] === '') {
            return $query;
        }

        return $query->where('role_id', $this->filters['role_id']);
    }
}
