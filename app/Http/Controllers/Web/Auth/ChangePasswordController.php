<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Web\WebController;

/**
 * Class ChangePasswordController
 *
 * @package App\Http\Controllers\Web\Auth
 */
class ChangePasswordController extends WebController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Layouts.Web.Pages.Registration.change_password');
    }
}
