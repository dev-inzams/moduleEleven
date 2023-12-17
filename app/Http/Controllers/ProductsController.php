<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function all_products(){
        $products = products::orderBy('id','DESC')->get();
        return response()->json([
            'products' => $products
        ],200);
    }
    public function show_products(){
        $products = products::orderBy('id','DESC')->get();
        return response()->json(['products' => $products]);
    }



    function add_product(Request $request){
        $productName = $request->input('productName');
        $description = $request->input('description');
        $itemCode = $request->input('itemCode');
        $price = $request->input('price');
        $qty = $request->input('qty');

        $inserted = DB::table('products')->insert([
            'productName' => $productName,
            'description' => $description,
             'itemCode' => $itemCode,
            'prices' => $price,
            'qty' => $qty,
        ]);

        if ($inserted) {
            return redirect('/invoices/addproduct');
        } else {
            return back()->with('error', 'Failed to insert data.');
        }
    }
}
