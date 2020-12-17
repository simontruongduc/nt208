<?php

namespace App\Http\Controllers\Cms;

use App\Enums\OrderStatusEnum;
use App\Models\Bill;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Fractal\Manager;

class HomeController extends CmsController
{
    public function __construct(Manager $fractal)
    {
        parent::__construct($fractal);
    }

    public function index()
    {
        $controlBox = collect();
        $controlBox->newMessageCount = Message::query()->where('status', 0)->count();
        $newOrder = Bill::query()
                        ->where('status', OrderStatusEnum::CONFIRM)
                        ->whereDate('created_at', Carbon::now()->subDays(7))
                        ->get();
        $controlBox->newOrderCount = $newOrder->count();
        $revenue = collect($newOrder)->pluck('total')->toArray();
        $controlBox->revenue = array_sum($revenue);

        return view('Layouts.Cms.Pages.Dashboard.index', compact('controlBox'));
    }
}
