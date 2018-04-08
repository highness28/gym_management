<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;
use App\GymInformation;
use App\GymBranch;
use App\User;
use Image;
use Auth;

class EmployeeController extends Controller
{
    public function index() {
        if(Auth::user()->user_type==4) { // Administrator
            $employees = User::get();
        }
        else if(Auth::user()->user_type==3) { // Gym Owner
            $employees = User::where('gym_id', Auth::user()->gym_id)->get();
        }
        else { // Supervisor
            $employees = User::where('branch_id', Auth::user()->branch_id)->get();
        }

    	return view('employee.index')
        ->with('employees', $employees);
    }
    
    public function add() {
        $branches = GymBranch::where('gym_id', Auth::user()->gym_id)->get();

        return view('employee.add')
        ->with('branches', $branches);
    }

    public function create(EmployeeRequest $request) {
        $image = 'male_avatarc.png';
        if($request->file('image') == null) {
            if($request->gender == 1) { // female
                $image = 'female_avatarc.png';
            }
        }
        else {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/dist/img/avatar/' . $filename));
            $image = $filename;
        }
        
    	$user = User::create([
    		'first_name' => $request->first_name,
    		'middle_name' => $request->middle_name,
    		'last_name' => $request->last_name,
    		'gender' => $request->gender,
    		'birthdate' => date('Y-m-d', strtotime($request->birthdate)),
    		'home_address' => $request->home_address,
    		'contact_number' => $request->contact_number,
    		'image' => $image,
    		'email' => $request->email,
    		'password' => Hash::make($request->input('password')),
    		'remember_token' => Hash::make($request->input('password')),
    		'user_type' => $request->user_type
    	]);
        
    	return redirect('/employee')
    	->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully registered a new employee.
                            </div>');
    }

    public function edit(Request $request) {
        $employee = User::find($request->id);
        $branches = GymBranch::where('gym_id', Auth::user()->gym_id)->get();
        
        return view('employee.edit')
        ->with('branches', $branches)
        ->with('employee', $employee);
    }

    public function update(EmployeeRequest $request) {
        $employee = User::find($request->id);
        
        if($request->file('image') == null && ($employee->image == 'male_avatarc.png' || $employee->image == 'female_avatarc.png')) {
            if($request->gender == 0) { // female
                $image = 'male_avatarc.png';
            }
            else {
                $image = 'female_avatarc.png';
            }
        }
        else if($request->file('image') != null) {
            $avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/dist/img/avatar/' . $filename));
            $image = $filename;
        }
        else {
            $image = $employee->image;
        }
        
        $employee->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'birthdate' => date('Y-m-d', strtotime($request->birthdate)),
            'home_address' => $request->home_address,
            'contact_number' => $request->contact_number,
            'image' => $image,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
            'remember_token' => Hash::make($request->input('password')),
            'user_type' => $request->user_type
        ]);
        
        return redirect('/employee')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated an employee.
                            </div>');
    }
}
