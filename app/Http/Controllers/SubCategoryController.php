<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\GymInformation;
use App\SubCategory;
use Auth;

class SubCategoryController extends Controller
{
    public function index() {
    	$sub_categories = SubCategory::where('gym_id', Auth::user()->gym_id)->get();

    	return view('sub_category.index')
    	->with('sub_categories', $sub_categories);
    }

    public function add() {
    	return view('sub_category.add');
    }

    public function create(SubCategoryRequest $request) {
        SubCategory::create([
            'sub_name' => $request->sub_name,
            'gym_id' => Auth::user()->gym_id
        ]);

        return redirect('/sub_category')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added a new sub category.
                            </div>');
    }

    public function edit(Request $request) {
    	$sub_category = SubCategory::find($request->id);

    	return view('sub_category.edit')
    	->with('sub_category', $sub_category);
    }

    public function update(SubCategoryRequest $request) {
    	$sub_category = SubCategory::find($request->id);

        $sub_category->update([
            'sub_name' => $request->sub_name
        ]);
        
        return redirect('/sub_category')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a sub category.
                            </div>');
    }
}
