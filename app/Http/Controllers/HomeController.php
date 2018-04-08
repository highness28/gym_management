<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InvoiceMembership;
use App\InvoiceSession;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = [];

        $invoice_membership = InvoiceMembership::with('membership_plan')->with('customer')->paginate(5);
        $invoice_entrance = InvoiceSession::with('entrance_fee')->with('customer')->where([
            'type' => 0
        ])->paginate(5);
        $invoice_training = InvoiceSession::with('entrance_fee')->with('customer')->where([
            'type' => 1
        ])->paginate();

        foreach($invoice_membership as $membership) {
            $services[] = [
                $membership->membership_plan->name,
                $membership->created_at,
                $membership->customer->first_name,
                $membership->customer->middle_name,
                $membership->customer->last_name,
                $membership->customer->image,
                $membership->customer->slug,
                0,
            ];
        }

        foreach($invoice_entrance as $entrance) {
            $services[] = [
                $entrance->entrance_fee->name,
                $entrance->created_at,
                $entrance->customer->first_name,
                $entrance->customer->middle_name,
                $entrance->customer->last_name,
                $entrance->customer->image,
                $entrance->customer->slug,
                1,
            ];
        }

        foreach($invoice_training as $training) {
            $services[] = [
                $training->entrance_fee->name,
                $training->created_at,
                $training->customer->first_name,
                $training->customer->middle_name,
                $training->customer->last_name,
                $training->customer->image,
                $training->customer->slug,
                2,
            ];
        }

        $count = count($services)<5? count($services):5;

        for($i = 0; $i < $count - 1; $i++) {
            for($j = 0; $j < $count - 1; $j++) {
                if($services[$j][1] > $services[$j+1][1]) {
                    $temporary = $services[$j];
                    $services[$j] = $services[$j+1];
                    $services[$j+1] = $temporary;
                }
            }
        }

        return view('/index')
        ->with('services', $services);
    }
}
