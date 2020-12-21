<?php

namespace App\Sorts;

use App\Traits\CommonSort;

class ProductSort extends Sort
{
    use CommonSort;

    /**
     *
     * @param string $direction
     * @return \App\Builders\Builder
     * @throws \Exception
     */
    public function price($direction)
    {
        return $this->query->orderBy('price', $direction);
    }
}
