<?php

namespace App\Transformers\Web;

use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;
use App\Models\Rate;

class RateTransformer extends TransformerAbstract
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
     * @param \App\Models\Rate $rate
     * @return array
     */
    public function transform(Rate $rate)
    {
        return [
            'isEdit'   => $rate->user_id == Auth::id() ? true : false,
            'username' => $rate->user()->name,
            'rate'     => $rate->rate,
            'message'  => $rate->message,
        ];
    }
}
