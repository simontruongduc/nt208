<?php

namespace App\Transformers\Web;

use App\Models\Producer;
use League\Fractal\TransformerAbstract;

class ProducerTransformer extends TransformerAbstract
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
     * @return array
     */
    public function transform(Producer $producer)
    {
        return [
            'id'         => $producer->id,
            'name'       => $producer->name,
        ];
    }
}
