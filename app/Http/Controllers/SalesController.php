<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\InvoiceSession;
use App\InvoiceMembership;
use App\OrderList;
use Auth;

class SalesController extends Controller
{
    public function service_sales() {
    	$services = [];

        $invoice_membership = InvoiceMembership::with('membership_plan')->with('customer')->get();
        $invoice_entrance = InvoiceSession::with('entrance_fee')->with('customer')->where([
            'type' => 0
        ])->get();
        $invoice_training = InvoiceSession::with('entrance_fee')->with('customer')->where([
            'type' => 1
        ])->get();

        foreach($invoice_membership as $membership) {
            $services[] = [
                $membership->id,
                $membership->start_date,
                $membership->end_date,
                $membership->membership_plan->name,
                $membership->membership_plan->details,
                $membership->membership_plan->days,
                $membership->membership_plan->price,
                $membership->total,
                0,
                $membership->created_at,
                $membership->customer->first_name,
                $membership->customer->middle_name,
                $membership->customer->last_name,
                $membership->customer->slug
            ];
        }

        foreach($invoice_entrance as $entrance) {
            $services[] = [
                $entrance->id,
                $entrance->start_date,
                $entrance->end_date,
                $entrance->entrance_fee->name,
                $entrance->entrance_fee->details,
                $entrance->entrance_fee->days,
                $entrance->entrance_fee->price,
                $entrance->total,
                1,
                $entrance->created_at,
                $entrance->customer->first_name,
                $entrance->customer->middle_name,
                $entrance->customer->last_name,
                $entrance->customer->slug
            ];
        }

        foreach($invoice_training as $training) {
            $services[] = [
                $training->id,
                $training->start_date,
                $training->end_date,
                $training->entrance_fee->name,
                $training->entrance_fee->details,
                $training->entrance_fee->days,
                $training->entrance_fee->price,
                $training->total,
                2,
                $training->created_at,
                $training->customer->first_name,
                $training->customer->middle_name,
                $training->customer->last_name,
                $training->customer->slug
            ];
        }

    	return view('sales.service')
    	->with('services', $services);
    }

    public function product_sales(Request $request) {
        $customer_purchase = OrderList::join('invoice_product', 'invoice_id', 'invoice_product.id')->get();

        return view('sales.product')
        ->with('customer_purchase', $customer_purchase);
    }
}
