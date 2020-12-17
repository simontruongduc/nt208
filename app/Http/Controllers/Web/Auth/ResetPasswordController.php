<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Web\WebController;

/**
 * Class ResetPasswordController
 *
 * @package App\Http\Controllers\Web\Auth
 */
class ResetPasswordController extends WebController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('Layouts.Web.Pages.Registration.resset_password');
    }
}
