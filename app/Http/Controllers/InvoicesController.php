<?php

namespace App\Http\Controllers;

use App\Models\counters;
use App\Models\invoices;
use Illuminate\Http\Request;
use App\Models\invoice_items;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    public function get_all_invoice(){
        $invoices = invoices::with('customers')->orderBy('id', 'DESC')->get();
       return response()->json([
        'invoices' => $invoices
       ],200);
    }


    public function create_invoice(Request $request){
        $counters = counters::where('key', 'invoices')->first();
        $random = counters::where('key', 'invoices')->first();


        // $invoicesd = invoices::orderBy('id', 'DESC')->first();

        // if($invoicesd){
        //     $invoicesd = $invoicesd->id+1;
        //     $counters = $counters->value + $invoicesd;
        // }else{
        //     $counters = $counters->value;
        // }

        $formData = [
            'number'=> null,
            'customerName'=> null,
            'date'=> date('Y-m-d'),
            'dueDate'=> null,
            'reference'=> null,
            'discount'=> 0,
            'tremsAndCondition' => 'default',
            'items' => [
                'product_id'=> null,
                'product'=> null,
                'prices'=> 0,
                'qty'=> 1
            ]

        ];
        return response()->json($formData);
    }


    public function add_invoice(Request $request){
        $invoiceItem = $request->input("invoice_items");
        $subTotal = $request->input('subtotal');
        $total = $request->input('grandTotal');
        $customerName = $request->input('customerName');
        $number = $request->input('number');
        $date = $request->input('date');
        $dueDate = $request->input('dueDate');
        $discount = $request->input('discount');
        $reference = $request->input('reference');
        $tremsAndCondition = $request->input('tremsAndCondition');
        $itemCode = $request->input('itemCode');

        // $invoice = invoices::create($invoicedata);

        $inserted=DB::table('invoices')->insert([
            'number' => $number,
            'customerName' => $customerName,
            'date' => $date,
            'dueDate' => $dueDate,
            'reference' => $reference,
            'tremsAndCondition' => $tremsAndCondition,
            'subTotal' => $subTotal,
            'discount' => $discount,
            'total' => $total,
            // ... set other columns as needed
        ]);

        if ($inserted) {
             return redirect()->route('/');
        } else {
            // Handle failure, e.g., show an error message
            return back()->with('error', 'Failed to insert data.');
        }

        // foreach(json_decode($invoiceItem) as $item){
        //     $iteamdata['product_id'] = $item->id;

        //     $iteamdata['invoice_id'] = $invoice->id;
        //     $iteamdata['qty'] = $item->qty;
        //     $iteamdata['prices'] = $item->prices;

        //     invoice_items::create($iteamdata);
        // }
    }
}
