<?php

namespace App\Http\Controllers\Cms;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends CmsController
{

    public function index()
    {
        $users = User::query()->paginate(2);
        return view('Layouts.Cms.Pages.User.index',compact('users'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $user)
    {
        return view('Layouts.Cms.Pages.User.ccrud',compact('user'));
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }
}
