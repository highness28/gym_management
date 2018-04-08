<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\GymInformation;
use App\Product;
use App\Customer;
use App\InvoiceProduct;
use App\OrderList;
use Auth;

class PosController extends Controller
{
    public function index() {
        $products = Product::where('gym_id', Auth::user()->gym_id)->get();
        $customers = Customer::where(['branch_id' => Auth::user()->branch_id])->get();
        
    	return view('pos.index')
        ->with('products', $products)
        ->with('customers', $customers);
    }

    public function create(Request $request) {
    	$invoice = InvoiceProduct::create([
            'total_discount' => $request->total_discount,
            'total' => $request->total,
            'customer_id' => $request->customer_id,
            'gym_id' => Auth::user()->gym_id,
            'branch_id' => Auth::user()->branch_id,
        ]);

        for($i = 0; $i < count($request->product_id); $i++) {
            OrderList::create([
                'quantity' => $request->quantity[$i],
                'discount' => $request->discount[$i],
                'sub_total' => $request->sub_total[$i],
                'product_id' => $request->product_id[$i],
                'invoice_id' => $invoice->id,
                'gym_id' => Auth::user()->gym_id,
                'branch_id' => Auth::user()->branch_id,
            ]);
        }

        return redirect('/pos')
        ->with('message', '<div class="col-xs-12"><div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully created a order list.
                            </div></div>');
    }
}
