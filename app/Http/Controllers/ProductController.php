<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Inventory;
use App\GymInformation;
use App\Brand;
use App\MainCategory;
use App\SubCategory;
use Image;
use Auth;

class ProductController extends Controller
{
    public function index() {
    	$products = Product::with('brand')
    	->with('sub_category')
    	->with('main_category')
        ->where('branch_id', Auth::user()->branch_id)
    	->get();
    	
    	return view('product.index')
    	->with('products', $products);
    }

    public function add() {
        $brands = Brand::where('gym_id', Auth::user()->gym_id)->get();
        $main_categories = MainCategory::where('gym_id', Auth::user()->gym_id)->get();
        $sub_categories = SubCategory::where('gym_id', Auth::user()->gym_id)->get();

    	return view('product.add')
        ->with('brands', $brands)
        ->with('main_categories', $main_categories)
        ->with('sub_categories', $sub_categories);
    }

    public function create(ProductRequest $request) {
        $image = 'default.png';
        if($request->image) {
            $product = $request->file('image');
            $filename = time() . '.' . $product->getClientOriginalExtension();
            Image::make($product)->save(public_path('/dist/img/product/' . $filename));
            $image = $filename;
        }

        Product::create([
            'product_name' => $request->product_name,
            'selling_price' => $request->selling_price,
            'details' => $request->details,
            'critical_lowest' => 0,
            'critical_highest' => 0,
            'image' => $image,
            'brand_id' => $request->brand,
            'sub_category_id' => $request->sub_category,
            'main_category_id' => $request->main_category,
            'gym_id' => Auth::user()->gym_id,
            'branch_id' => Auth::user()->branch_id
        ]);

        return redirect('/product')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully added a product.
                            </div>');
    }

    public function edit(Request $request) {
        $brands = Brand::where('gym_id', Auth::user()->gym_id)->get();
        $main_categories = MainCategory::where('gym_id', Auth::user()->gym_id)->get();
        $sub_categories = SubCategory::where('gym_id', Auth::user()->gym_id)->get();
        $product = Product::find($request->id);

        return view('product.edit')
        ->with('product', $product)
        ->with('brands', $brands)
        ->with('main_categories', $main_categories)
        ->with('sub_categories', $sub_categories);
    }

    public function update(ProductRequest $request) {
        $product = Product::find($request->id);

        $image = $product->image;
        if($request->image) {
            $picture = $request->file('image');
            $filename = time() . '.' . $picture->getClientOriginalExtension();
            Image::make($picture)->save(public_path('/dist/img/product/' . $filename));
            $image = $filename;
        }
        
        $product->update([
            'product_name' => $request->product_name,
            'selling_price' => $request->selling_price,
            'details' => $request->details,
            'critical_lowest' => 0,
            'critical_highest' => 0,
            'image' => $image,
            'brand_id' => $request->brand,
            'sub_category_id' => $request->sub_category,
            'main_category_id' => $request->main_category,
            'gym_id' => Auth::user()->gym_id
        ]);

        return redirect('/product')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated a product.
                            </div>');
    }
}
