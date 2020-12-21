<?php
/** @noinspection PhpFullyQualifiedNameUsageInspection */

namespace App\Filters;

use App\Traits\CommonFilter;

class ProductFilter extends Filter
{
    use CommonFilter;

    public function producer($producer)
    {
        return $this->query->where('producer_id', $producer);
    }
}
