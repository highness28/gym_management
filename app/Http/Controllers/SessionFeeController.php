<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SessionFeeRequest;
use App\SessionFee;
use App\GymInformation;
use Auth;

class SessionFeeController extends Controller
{
    public function index() {
    	$session_fees = SessionFee::where('gym_id', Auth::user()->gym_id)->get();

    	return view('session_fee.index')
    	->with('session_fees', $session_fees);
    }

    public function add() {
    	return view('session_fee.add');
    }

    public function create(SessionFeeRequest $request) {
    	SessionFee::create([
    		'name' => $request->name,
    		'details' => $request->details,
    		'days' => $request->days,
    		'price' => $request->price,
    		'type' => $request->type,
    		'gym_id' => Auth::user()->gym_id,
            'branch_id' => Auth::user()->branch_id
    	]);

    	return redirect('/session_fee')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully created a new session fee.
                            </div>');
    }

    public function edit(Request $request) {
        $session_fee = SessionFee::find($request->id);

        return view('session_fee.edit')
        ->with('session_fee', $session_fee);
    }

    public function update(SessionFeeRequest $request) {
        $session_fee = SessionFee::find($request->id)->update($request->all());
        
        return redirect('/session_fee')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a session fee.
                            </div>');
    }
}
