<?php

namespace App\Http\Controllers;

use App\Models\counters;
use App\Models\invoices;
use App\Models\invoice_items;
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
        $invoicedata['subtotal'] = $request->input('subtotal');
        $invoicedata['grandTotal'] = $request->input('grandTotal');
        $invoicedata['customerName'] = $request->input('customerName');
        $invoicedata['number'] = $request->input('number');
        $invoicedata['date'] = $request->input('date');
        $invoicedata['dueDate'] = $request->input('dueDate');
        $invoicedata['discount'] = $request->input('discount');
        $invoicedata['reference'] = $request->input('reference');
        $invoicedata['tremsAndCondition'] = $request->input('tremsAndCondition');

        $invoice = invoices::create($invoicedata);

        foreach(json_decode($invoiceItem) as $item){
            $iteamdata['product_id'] = $item->id;

            $iteamdata['invoice_id'] = $invoice->id;
            $iteamdata['qty'] = $item->qty;
            $iteamdata['prices'] = $item->prices;

            invoice_items::create($iteamdata);
        }
    }
}
