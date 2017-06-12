<?php

namespace Continuum\Query;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\AbstractPaginator;

class Paginate
{
    /**
     * Collection of items.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $data;

    /**
     * Paginate constructor.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param int $limit
     * @param int $offset
     */
    public function __construct(Builder $builder, $limit = 20, $page = 1)
    {
        $this->paginator = $builder->paginate($limit);
    }

    /**
     * Get the paginated collection of items.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPaginator(): AbstractPaginator
    {
        return $this->paginator;
    }
}