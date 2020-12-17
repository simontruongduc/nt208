<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Cart;
use App\Models\User;
use App\Transformers\Api\InformationTransformer;
use App\Transformers\Api\UserTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\UseCases\Api\Auth\UserLoginUseCase;
use App\UseCases\Api\Auth\CheckVerifyTokenUseCase;
use App\UseCases\Api\Auth\UserResetPasswordUseCase;
use App\UseCases\Api\Auth\UserChangePasswordUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\QueryException;
use League\Fractal\Manager;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api\Auth
 */
class AuthController extends ApiController
{
    use HasApiTokens;

    /**
     * @var \App\Transformers\Api\UserTransformer
     */
    protected $userTransformer;

    /**
     * AuthController constructor.
     *
     * @param \League\Fractal\Manager $fractal
     * @param \App\Transformers\Api\UserTransformer $userTransformer
     */
    public function __construct(Manager $fractal, UserTransformer $userTransformer)
    {
        parent::__construct($fractal);
        $this->userTransformer = $userTransformer;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        $data = [
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'verify_token' => $this->generateRandomToken(),
        ];
        try {
            $user = User::query()->create($data);
            $user = User::query()->where('email', $request->email)->first();
            $user = $this->userTransformer->transform($user);
            $this->sendWithHtml("EmailTemplate.Verified", $user, 'Xác nhận tài khoản');

            return $this->success($user);
        } catch (\Illuminate\Database\QueryException | Exception $error) {
            return $this->error($error->getCode(), 'create account fails')->respond(500, ['x-foo' => false]);
        }
    }

    /**
     * @param $email
     * @param $token
     * @return string
     */
    public function verifyAccount($email, $token)
    {
        $user = User::query()->where('email', $email)
                    ->where('verify_token', $token)
                    ->where('email_verified_at', null)
                    ->count();
        if ($user != 0) {
            User::query()->where('email', $email)
                ->update([
                    'email_verified_at' => Carbon::now(),
                    'verify_token'      => null,
                    'updated_at'        => Carbon::now(),
                ]);
            // tạo cart
            $user = User::query()->where('email', $email)->first();
            Cart::query()->create(['user_id' => $user['id']]);

            return 'Tài khoản đã được xác thực thành công';
        }

        return 'Liên kết không còn khả dụng, vui lòng kiểm tra lại';
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UseCases\Api\Auth\UserLoginUseCase $userLoginUseCase
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, UserLoginUseCase $userLoginUseCase)
    {
        if (User::query()->where('email', $request->email)->where('email_verified_at', '!=', null)->count() == 0) {
            return $this->error(503, 'tai khoang chua xac thuc')->respond(503, ['x-foo' => false]);
        }
        if (Auth::attempt($request->all())) {
            $user = $request->user();
            $success = [
                'token' => $user->createToken('login success.')->accessToken,
                'user'  => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                ],
            ];

            return $this->success($success)->respond();
        }

        return $this->error('401', 'login fail')->respond(500, ['x-foo' => false]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $request->user('api')->token()->revoke();

            return $this->success();
        } catch (\Error | \Exception | QueryException $error) {
            return $this->error('500', 'logout error')->respond(500, ['x-foo' => false]);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        $user = User::query()->where('email', $request->email)->count();
        if ($user != 0) {
            if (DB::table('password_resets')->where('email', $request->email)->count() == 0) {
                DB::table('password_resets')->insert([
                    'email' => $request->email,
                    'token' => $this->generateRandomToken(),
                ]);
            }
            $user = DB::table('password_resets')->where('email', $request->email)->first();
            $this->sendWithHtml("EmailTemplate.ForgotPassword", $user, 'Khôi phục mật khẩu');

            return $this->success();
        }

        return $this->error(404, 'Account not found')->respond(404, ['x-foo' => false]);
    }

    /**
     * @param $email
     * @param $token
     * @param \App\UseCases\Api\Auth\CheckVerifyTokenUseCase $checkVerifyTokenUseCase
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function checkVerifyToken($email, $token, CheckVerifyTokenUseCase $checkVerifyTokenUseCase)
    {
        $reset = DB::table('password_resets')
                   ->where('email', $email)
                   ->where('token', $token)
                   ->count();
        if ($reset != 0) {
            return $this->success(['token' => $token]);
        }

        return $this->error(404, 'token not exit')->respond(404, ['x-foo' => false]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UseCases\Api\Auth\UserResetPasswordUseCase $userResetPasswordUseCase
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request, UserResetPasswordUseCase $userResetPasswordUseCase)
    {
        $reset = DB::table('password_resets')->where('token', $request->token)->count();
        if ($reset != 0) {
            $reset = DB::table('password_resets')->where('token', $request->token)->first();
            User::query()->where('email', $reset->email)
                ->update([
                    'password'   => Hash::make($request->password),
                    'updated_at' => Carbon::now(),
                ]);

            //$reset->delete();
            return $this->success();
        }

        return $this->error(404)->respond(404, ['x-foo' => false]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\UseCases\Api\Auth\UserChangePasswordUseCase $changePasswordUseCase
     * @return \Flugg\Responder\Http\Responses\SuccessResponseBuilder|\Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request, UserChangePasswordUseCase $changePasswordUseCase)
    {
        if ($request->user('api')) {
            if (Hash::check($request->old_password, $request->user('api')->password)) {
                User::query()->where('id', $request->user('api')->id)
                    ->update([
                        'password' => Hash::make($request->new_password),
                    ]);

                return $this->success();
            }

            return $this->error(500)->respond(500, ['x-foo' => false]);
        }

        return $this->error(500)->respond(500, ['x-foo' => false]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInformation(Request $request)
    {
        if ($request->user('api')) {
            return $this->success(($request->user('api')->informations), InformationTransformer::class)->respond();
        }

        return $this->error(500)->respond(500, ['x-foo' => false]);;
    }
}
