<?php

namespace App\Transformers\Api;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class ShipmentDetailsTransformer extends TransformerAbstract
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
     * @param \App\Models\User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'user_id' => $user->id,
            'cart_id' => $user->cart->id,
        ];
    }
}
