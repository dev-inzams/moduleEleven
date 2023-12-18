<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller {
    public function todayTotalSell() {
        $today = Carbon::now()->toDateString();

        $totalSell = DB::table( 'invoices' )
            ->whereDate( 'created_at', $today )
            ->sum( 'total' );
        return response()->json( $totalSell );
    }

    public function thisMonthTotalSell() {
        $currentMonth = Carbon::now()->month;

        $thisMonthTotalSell = DB::table( 'invoices' )
            ->whereMonth( 'created_at', $currentMonth )
            ->sum( 'total' );
        if ($thisMonthTotalSell < 1) {
            return response()->json('no sell');
        }else{
            return response()->json( $thisMonthTotalSell );
        }

    }

    public function thisYearTotalSell(){
        $currentYear = Carbon::now()->year;

        $thisYearSell = DB::table('invoices')
        ->whereYear('created_at', $currentYear)
        ->sum('total');
        return response()->json($thisYearSell);
    }

}
