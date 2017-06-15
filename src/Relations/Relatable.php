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
        if (property_exists($this, 'relationsToLoad') || !empty($with)) {
            $with = array_merge(static::$relationsToLoad, $with);

            ($this->exists)
                ? $this->load($with)
                : $query->with($with);
        }

        return $query;
    }
}
