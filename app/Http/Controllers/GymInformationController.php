<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GymInformationRequest;
use App\GymInformation;
use Image;
use Auth;

class GymInformationController extends Controller
{
    public function index() {
    	$gym_information = GymInformation::find(Auth::user()->id);

    	return view('gym.index')
    	->with('gym_information', $gym_information);
    }

    public function update(GymInformationRequest $request) {
    	$gym_information = GymInformation::find(Auth::user()->id);
    	$image = 'default.png';

    	if($request->file('image') != null) {
    		$avatar = $request->file('image');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->save(public_path('/dist/img/gym_information/' . $filename));
            $image = $filename;

            if($gym_information->logo != 'default.png') {
            	$previous_image = public_path('/dist/img/gym_information/') . $gym_information->logo;
                unlink($previous_image);
            }
    	}
    	else {
    		if($gym_information->logo != $image) {
    			$image = $gym_information->logo;
    		}
    	}

    	$gym_information->update([
    		'name' => $request->name,
    		'logo' => $image,
    		'others' => $request->others
    	]);

    	return redirect('/gym_information')
    	->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated your gym information.
                            </div>');
    }
}
