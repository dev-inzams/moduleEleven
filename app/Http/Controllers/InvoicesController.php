<?php

namespace App\Http\Controllers;

use App\Models\counter;
use App\Models\invoices;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function get_all_invoice(){
        $invoices = invoices::with('customers')->orderBy('id', 'DESC')->get();
       return response()->json([
        'invoices' => $invoices
       ],200);
    }


    public function create_invoice(Request $request){
        $counters = counter::where('key', 'invoices')->first();
    }
}
