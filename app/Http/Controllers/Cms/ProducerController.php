<?php

namespace App\Http\Controllers\Cms;

use App\Enums\ActionTypeEnum;
use App\Models\Producer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProducerController extends Controller
{
    public function index()
    {
        $producers = Producer::query()->paginate(20);

        return view('Layouts.Cms.Pages.Producer.index', compact('producers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Producer $producer)
    {
        $type = ActionTypeEnum::VIEW;

        return view('Layouts.Cms.Pages.Producer.ccrud', compact('type'));
    }

    public function edit(Producer $producer)
    {
        //
    }

    public function update(Request $request, Producer $producer)
    {
        //
    }

    public function destroy(Producer $producer)
    {
        //
    }
}
