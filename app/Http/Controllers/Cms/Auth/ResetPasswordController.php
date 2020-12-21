<?php

namespace App\Http\Controllers\Cms\Auth;

use App\Http\Controllers\Cms\CmsController;
use App\Http\Requests\Cms\Auth\ForgotPasswordRequest;
use App\Http\Requests\Cms\Auth\ResetPasswordRequest;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ResetsPasswords;
use League\Fractal\Manager;
use Illuminate\Support\Facades\DB;

/**
 * Class ResetPasswordController
 *
 * @package App\Http\Controllers\Cms\Auth
 */
class ResetPasswordController extends CmsController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = 'cms/dashboard';

    /**
     * Create a new controller instance.
     *
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        parent::__construct($fractal);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vendor.adminlte.passwords.forgot');
    }

    /**
     * @param \App\Http\Requests\Cms\Auth\ForgotPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgot(ForgotPasswordRequest $request)
    {
        $data = $request->validated();
        $user = Admin::query()->where('email', $data['email'])->count();
        if ($user) {
            $resetData = DB::table('password_resets')->where('email', $data['email']);
            $diffDate = Carbon::parse(Carbon::now()->format('Y-m-d'))
                              ->diffInDays(Carbon::parse(optional($resetData)->created_at), false);
            if ($resetData && $diffDate == 1) {
                return redirect()->back()->with('message', 'Một email chứa liên kết khôi phục đã được gửi trước đó.');
            }
            if ($resetData) {
                $resetData->delete();
            }
            $data = [
                'token'      => $this->generateRandomToken(),
                'email'      => $data['email'],
                'created_at' => Carbon::now(),
            ];
            DB::table('password_resets')->insert($data);
            $this->sendWithHtml('EmailTemplate.Cms.ForgotPassword', $data, 'KhoPkmobile Cms Reset password');

            return redirect()
                ->back()
                ->with('message', 'Một email chứa liên kết khôi phục mật khẩu đã được gửi đến email. ');
        }

        return redirect()
            ->back()
            ->with('message', 'User không tồn tại. Vui lòng kiểm tra lại. ');
    }

    /**
     * @param $email
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function verifyToken($email, $token)
    {
        $resetData = DB::table('password_resets')
                       ->where('email', $email)
                       ->where('token', $token)->first();
        $diffDate = Carbon::parse(Carbon::now()->format('Y-m-d'))
                          ->diffInDays(Carbon::parse(optional($resetData)->created_at), false);
        if ($resetData && $diffDate == 1) {
            return view('vendor.adminlte.passwords.reset', compact('resetData'));
        }

        return 'Liên kết không còn khả dụng.';
    }

    /**
     * @param \App\Http\Requests\Cms\Auth\ResetPasswordRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|string
     */
    public function reset(ResetPasswordRequest $request)
    {
        $data = $request->validated();
        $resetData = DB::table('password_resets')
                       ->where('email', $request->email)
                       ->where('token', $request->token)
                       ->first();
        $diffDate = Carbon::parse(Carbon::now()->format('Y-m-d'))
                          ->diffInDays(Carbon::parse(optional($resetData)->created_at), false);
        if ($resetData && $diffDate == 1) {
            $user = Admin::query()->where('email', $request->email)->first();
            $user->update($data);
            DB::table('password_resets')
              ->where('email', $request->email)
              ->where('token', $request->token)->delete();

            return redirect('admin/auth/login');
        }

        return 'Liên kết không còn khả dụng.';
    }
}
