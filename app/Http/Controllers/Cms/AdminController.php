<?php

namespace App\Http\Controllers\Cms;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends CmsController
{
    public function index()
    {
        $admins = Admin::query()->paginate(20);

        return view('Layouts.Cms.Pages.Admin.index', compact('admins'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Admin $admin)
    {
        //
    }

    public function edit(Admin $admin)
    {
        //
    }

    public function update(Request $request, Admin $admin)
    {
        //
    }

    public function destroy(Admin $admin)
    {
        //
    }
}
