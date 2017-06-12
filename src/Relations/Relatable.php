<?php

namespace Continuum\Query\Relations;

trait Relatable
{
    /**
     * Load all required relationships.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoadRelations($query, $with = [])
    {
        if (property_exists($this, 'relationsToLoad')) {
            return $query->with(array_merge($this->relationsToLoad, $with));
        }

        return $query;
    }
}
