<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function all_products(){
        $products = products::orderBy('id','DESC')->get();
        return response()->json([
            'products' => $products
        ],200);
    }
}
