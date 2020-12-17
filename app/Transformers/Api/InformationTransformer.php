<?php

namespace App\Transformers\Api;

use League\Fractal\TransformerAbstract;
use App\Models\Information;

class InformationTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param \App\Models\Information $information
     * @return array
     */
    public function transform(Information $information)
    {
        return [
            'id'      => $information->id,
            'address' => $information->address.','.$information->ward->name.','.$information->district->name.','.$information->province->name,
        ];
    }
}
