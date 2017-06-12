<?php

namespace Continuum\Query\Filters;

use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class Filter
{
    /**
     * Filter constructor.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get all the available filter methods.
     *
     * @return array
     */
    protected function getFilterMethods(): array
    {
        $class = new ReflectionClass(static::class);

        return array_filter(
            array_map(function($method) use ($class) {
                return ($method->class === $class->getName()) ? $method->name : null;
            }, $class->getMethods())
        );
    }

    /**
     * Get all the filters that can be applied.
     *
     * @return array
     */
    protected function getFilters(): array
    {
        $availableMethods = $this->getFilterMethods();
        $filters = [];

        foreach($this->request->all() as $key => $value) {
            $method = Str::camel("filter_{$key}");

            if (in_array($method, $availableMethods)) {
                $filters[$method] = $value;
            }
        }

        return $filters;
    }

    /**
     * Apply context.
     *
     * @todo complete!
     *
     * @param  Builder $builder [description]
     * @return [type]           [description]
     */
    protected function applyContext(Builder $builder): Builder
    {
        return $builder;
    }

    /**
     * Apply the criteria.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->applyContext($builder);

        foreach ($this->getFilters() as $name => $value) {
            if (method_exists($this, $name)) {
                $this->$name($builder, $value);
            }
        }

        return $builder;
    }

}
