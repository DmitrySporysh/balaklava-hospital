<?php
namespace App\Filtration;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

abstract class QueryFilters
{
    /**
     * Array of all filters
     */
    protected $filters;
    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;
    /**
     * Create a new QueryFilters instance.
     *
     * @param Request $request
     */
    public function __construct($filters)
    {
        $this->filters = $filters;
    }
    /**
     * Apply the filters to the builder.
     *
     * @param  Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters as $name => $value) {
            if (strlen($value)) {
                $this->$name($value);
            } else {
                $this->$name();
            }
        }
        return $this->builder;
    }
}