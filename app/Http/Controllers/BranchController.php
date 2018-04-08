<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GymBranchRequest;
use App\Http\Controllers\Controller;
use App\GymInformation;
use App\GymBranch;
use App\User;
use Auth;

class BranchController extends Controller
{
    public function index(){
        $branches = GymBranch::where('gym_id', Auth::user()->gym_id)->get();

    	return view('branch.index')
        ->with('branches', $branches);
    }

    public function add() {
        return view('branch.add');
    }

    public function create(GymBranchRequest $request){
    	GymBranch::create([
            'address'       => $request->input('address'),
            'contact'       => $request->input('contact'),
            'branch_type'   => $request->input('branch_type'),
            'gym_id'        => Auth::user()->id
    	]);
        
    	return redirect('/branch')
    	->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully registered a branch.
                            </div>');
    }

    public function edit(Request $request) {
        $branch = GymBranch::find($request->id);
        
        return view('branch.edit')
        ->with('branch', $branch);
    }
    
    public function update(GymBranchRequest $request) {
        $branch = GymBranch::find($request->id)->update($request->all());

        return redirect('/branch')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a branch.
                            </div>');
    }
}
