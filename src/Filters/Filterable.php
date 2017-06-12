<?php

namespace Continuum\Query\Filters;

use Continuum\Query\Filters\Filter;

trait Filterable
{
    /**
     * Scope a query to apply given filter.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param Filter $filter
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilterBy($query, Filter $filter = null)
    {
        if ($filter) {
            return $filter->apply($query);
        }

        return $query;
    }
}
