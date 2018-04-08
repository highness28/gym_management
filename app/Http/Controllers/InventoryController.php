<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\InventoryRequest;
use App\GymInformation;
use App\Product;
use App\Supplier;
use App\Inventory;
use Auth;

class InventoryController extends Controller
{
    public function index() {
    	$inventories = Inventory::with('product')->with('supplier')->where('gym_id', Auth::user()->gym_id)->get();
        
    	return view('inventory.index')
    	->with('inventories', $inventories);
    }

    public function add() {
    	$products = Product::where('gym_id', Auth::user()->gym_id)->get();
    	$suppliers = Supplier::where('gym_id', Auth::user()->gym_id)->get();

    	return view('inventory.add')
    	->with('products', $products)
    	->with('suppliers', $suppliers);
    }

    public function create(InventoryRequest $request) {
    	$product_id = $request->product_id;
    	$unit_price = $request->unit_price;
        $remarks = $request->remarks;
    	$quantity = $request->quantity;
    	$supplier_id = $request->supplier_id;

    	for($i = 0; $i < count($request->product_id); $i++) {
    		$product = Product::find(explode("|", $product_id[$i])[0]);

    		$product->update([
    			'quantity' => $product->quantity + $quantity[$i]
    		]);

    		Inventory::create([
    			'quantity' => $quantity[$i],
    			'unit_price' => $unit_price[$i],
                'remarks' => $remarks,
    			'product_id' => explode("|", $product_id[$i])[0],
    			'supplier_id' => $supplier_id,
    			'gym_id' => Auth::user()->gym_id,
                'branch_id' => Auth::user()->branch_id
    		]);
    	}

    	return redirect('/inventory')
    	->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully created an inventory.
                            </div>');
    }

    public function edit(Request $request) {
        $inventory = Inventory::with('product')->find($request->id);
        $suppliers = Supplier::where('gym_id', Auth::user()->gym_id)->get();

        return view('inventory.edit')
        ->with('inventory', $inventory)
        ->with('suppliers', $suppliers);
    }

    public function update(Request $request) {
        // Validation rules
        $validation_rules = [
            'unit_price' => 'required|numeric',
            'quantity' => 'required|int',
            'supplier_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $validation_rules)->validate();

        $inventory = Inventory::find($request->id);
        $product = Product::find($inventory->product_id);
        $previous_quantity = $product->quantity - $inventory->quantity;

        $inventory->update([
            'unit_price' => $request->unit_price,
            'quantity' => $request->quantity,
            'supplier_id' => $request->supplier_id
        ]);

        $product->update([
            'quantity' => $previous_quantity + $request->quantity
        ]);

        return redirect('/inventory')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated an inventory.
                            </div>');        
    }

    public function stockout(Request $request) {
        $inventory = Inventory::with('product')->with('supplier')->find($request->id);

        return view('inventory.stockout')
        ->with('inventory', $inventory);
    }

    public function stockout_update(Request $request) {
        $inventory = Inventory::find($request->id);
        $product = Product::find($inventory->product_id);
        $previous_quantity = ($product->quantity + $inventory->stockout_quantity) - $inventory->quantity;

        // Validation rules
        $validation_rules = [
            'stockout_quantity' => 'required|int|numeric|min:0|max:'.$inventory->quantity
        ];
        $validator = Validator::make($request->all(), $validation_rules)->validate();

        $inventory->update([
            'stockout_quantity' => $request->stockout_quantity,
            'remarks' => $request->remarks
        ]);

        $product->update([
            'quantity' => $previous_quantity + ($inventory->quantity - $request->stockout_quantity)
        ]);

        return redirect('/inventory')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully stockout an inventory.
                            </div>');  
    }
}
