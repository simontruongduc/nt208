<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Traits\EmailTraits;
use App\Traits\UploadImageTrait;
use App\Traits\CreateTokenTraits;
use League\Fractal\Manager;
use Flugg\Responder\Http\MakesResponses;

/**
 * Class WebController
 *
 * @package App\Http\Controllers\Web
 */
class WebController extends Controller
{
    use UploadImageTrait, MakesResponses, EmailTraits, CreateTokenTraits;

    /**
     * @var \League\Fractal\Manager
     */
    private $fractal;

    /**
     * WebController constructor.
     *
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }
}
