<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Requests\Web\SignUpRequest;
use App\Models\User;
use App\Transformers\Api\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Hash;
use League\Fractal\Manager;

/**
 * Class RegistraController
 *
 * @package App\Http\Controllers\Web\Auth
 */
class RegistraController extends WebController
{
    /**
     * @var \App\Transformers\Api\UserTransformer
     */
    protected $userTranformer;

    /**
     * RegistraController constructor.
     *
     * @param \League\Fractal\Manager $fractal
     * @param \App\Transformers\Api\UserTransformer $userTranformer
     */
    public function __construct(Manager $fractal, UserTransformer $userTranformer)
    {
        parent::__construct($fractal);
        $this->userTranformer = $userTranformer;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Layouts.Web.Pages.Registration.signup');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signup(SignUpRequest $request)
    {
        if (User::query()->where('email', $request->email)->count() == 0) {
            $data = [
                'name'         => $request->name,
                'email'        => $request->email,
                'password'     => $request->password,
                'verify_token' => $this->generateRandomToken(),
            ];
            $user = User::query()->create($data);
            $user = User::query()->where('email', $request->email)->first();
            $user = $this->userTranformer->transform($user);
            $this->sendWithHtml("EmailTemplate.Verified", $user, 'Xác nhận tài khoản');

            return redirect()->back()->with('message', 'Vui lòng kiểm tra email để xác thực tài khoản.');
        }

        return redirect()->back()->with('message', 'Địa chỉ email đã được đăng ký, vui lòng kiểm tra lại.');
    }
}
