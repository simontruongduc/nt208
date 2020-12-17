<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\EmailTraits;
use App\Traits\UploadImageTrait;
use App\Traits\CreateTokenTraits;
use Flugg\Responder\Responder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Flugg\Responder\Http\MakesResponses;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers\Api
 */
class ApiController extends Controller
{
    use UploadImageTrait, MakesResponses, EmailTraits, CreateTokenTraits;

    /**
     * @var \League\Fractal\Manager
     */
    private $fractal;

    /**
     * ApiController constructor.
     *
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }
}
