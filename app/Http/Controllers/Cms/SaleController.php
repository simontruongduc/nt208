<?php

namespace App\Http\Controllers\Cms;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        $sales = Sale::query()->where('date_start', '>=', $today)->paginate(20);

        return view('Layouts.Cms.Pages.Sale.index', compact('sales'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sale $sale)
    {
        //
    }

    public function edit(Sale $sale)
    {
        //
    }

    public function update(Request $request, Sale $sale)
    {
        //
    }

    public function destroy(Sale $sale)
    {
        //
    }
}
