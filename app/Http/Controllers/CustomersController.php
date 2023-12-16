<?php

namespace App\Http\Controllers;

use App\Models\customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function all_customers(){
        $customers = customers::orderBy('id', 'DESC')->get();
        return response()->json([
            'customers'=> $customers
        ],200);
    }
}
