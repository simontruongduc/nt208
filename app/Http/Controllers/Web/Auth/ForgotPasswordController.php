<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Web\WebController;

/**
 * Class ForgotPasswordController
 *
 * @package App\Http\Controllers\Web\Auth
 */
class ForgotPasswordController extends WebController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('Layouts.Web.Pages.Registration.forgot_password');
    }
}
