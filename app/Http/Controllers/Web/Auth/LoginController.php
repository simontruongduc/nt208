<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Requests\Cms\Auth\LoginRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class LoginController
 *
 * @package App\Http\Controllers\Web\Auth
 */
class LoginController extends WebController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Layouts.Web.Pages.Registration.login');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(LoginRequest $request)
    {
        if (User::query()->where('email', $request->email)->where('email_verified_at', '!=', null)->count() == 0) {
            return redirect()->back()->with('message', 'Tài khoảng chưa xác thực');
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if ($request->backUrl != null) {
                return redirect($request->backUrl);
            }

            return redirect('/index');
        }
        if ($request->backUrl != null) {
            return redirect()->back()->with([
                'message' => 'mật khẩu hoặc tài khoản chưa chính xác',
                'backUrl' => $request->backUrl,
            ]);
        }

        return redirect()->back()->with('message', 'mật khẩu hoặc tài khoản chưa chính xác');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();

            return redirect('/index');
        }

        return redirect('/index');
    }

    /**
     * @param $provider
     * @return mixed
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request,$provider)
    {

        $getInfo = Socialite::driver($provider)->user();

        $user = $this->createUser($getInfo,$provider);

        auth()->login($user);

        return redirect()->to('/index');

    }

    /**
     * @param $getInfo
     * @param $provider
     * @return mixed
     */
    function createUser($getInfo,$provider){

        $user = User::query()->where('email', $getInfo->email)->first();

        if (!$user) {
            $user = User::query()->create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'email_verified_at' => Carbon::now(),
                'password' => 'password',
            ]);
        }
        return $user;
    }
}
