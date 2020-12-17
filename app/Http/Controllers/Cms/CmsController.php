<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Traits\EmailTraits;
use App\Traits\UploadImageTrait;
use App\Traits\CreateTokenTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Flugg\Responder\Http\MakesResponses;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers\Admin
 */
class CmsController extends Controller
{
    use UploadImageTrait, MakesResponses, EmailTraits, CreateTokenTraits;

    /**
     * @var \League\Fractal\Manager
     */
    private $fractal;

    /**
     * AdminController constructor.
     *
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }
}
