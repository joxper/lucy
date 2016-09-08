<?php
namespace App;
use Illuminate\Database\Eloquent\Builder;
class TestFilters extends QueryFilters
{
    /**
     * Filter by popularity.
     *
     * @param  string $order
     * @return Builder
     */
    public function popular($order = 'desc')
    {
        return $this->builder->orderBy('id', $order);
    }
    /**
     * Filter by difficulty.
     *
     * @param  string $level
     * @return Builder
     */
    public function difficulty($level)
    {
        return $this->builder->where('name', $level);
    }
    /**
     * Filter by length.
     *
     * @param  string $order
     * @return Builder
     */
    public function length($order = 'asc')
    {
        return $this->builder->orderBy('id', $order);
    }
}