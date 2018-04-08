<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MembershipPlanRequest;
use App\GymInformation;
use App\MembershipPlan;
use Auth;

class MembershipPlanController extends Controller
{
    public function index() {
        $membership_plans = MembershipPlan::where('gym_id', Auth::user()->gym_id)->get();

    	return view('membership_plan.index')
        ->with('membership_plans', $membership_plans);
    }

    public function add() {
    	return view('membership_plan.add');
    }

    public function create(MembershipPlanRequest $request) {
        MembershipPlan::create([
    		'name' => $request->name,
    		'details' => $request->details,
    		'days' => $request->days,
    		'price' => $request->price,
    		'gym_id' => Auth::user()->gym_id,
            'branch_id' => Auth::user()->branch_id
    	]);

    	return redirect('/membership_plan')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully created a new membership plan.
                            </div>');
    }

    public function edit(Request $request) {
        $membership_plan = MembershipPlan::find($request->id);

        return view('membership_plan.edit')
        ->with('membership_plan', $membership_plan);
    }

    public function update(MembershipPlanRequest $request) {
        $membership_plan = MembershipPlan::find($request->id)->update($request->all());

        return redirect('/membership_plan')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a membership plan.
                            </div>');
    }
}
