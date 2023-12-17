<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\products;
class dashboardController extends Controller
{
    public function todayTotalSell()
    {
        $today = Carbon::now()->toDateString();

        $totalSell = DB::table('products')
        ->whereDate('created_at', $today)
        ->sum('total');
        return response()->json(['totalSell' => $totalSell], 200);
    }


}
