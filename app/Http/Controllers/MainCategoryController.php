<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\GymInformation;
use App\MainCategory;
use Auth;

class MainCategoryController extends Controller
{
    public function index() {
    	$main_categories = MainCategory::where('gym_id', Auth::user()->gym_id)->get();

    	return view('main_category.index')
    	->with('main_categories', $main_categories);
    }

    public function add() {
    	return view('main_category.add');
    }

    public function create(MainCategoryRequest $request) {
        MainCategory::create([
            'main_name' => $request->main_name,
            'gym_id' => Auth::user()->gym_id
        ]);

        return redirect('/main_category')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added a new main category.
                            </div>');
    }

    public function edit(Request $request) {
    	$main_category = MainCategory::find($request->id);

    	return view('main_category.edit')
    	->with('main_category', $main_category);
    }

    public function update(MainCategoryRequest $request) {
    	$main_category = MainCategory::find($request->id);

        $main_category->update([
            'main_name' => $request->main_name
        ]);
        
        return redirect('/main_category')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a main category.
                            </div>');
    }
}
