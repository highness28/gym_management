<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CustomerRequest;
use App\Http\Controllers\Controller;
use App\Customer;
use App\CustomerLog;
use App\GymInformation;
use App\GymBranch;
use App\MembershipPlan;
use App\SessionFee;
use App\InvoiceSession;
use App\InvoiceMembership;
use App\InvoiceProduct;
use App\InvoiceService;
use App\OrderList;
use Image;
use File;
use Auth;

class CustomerController extends Controller
{
    public function index() {
        $branch = GymBranch::where('gym_id', Auth::user()->gym_id)->get();

        $data= array();
        foreach($branch as $res){
           $data[] = $res->id;
        }

       $customers = Customer::whereIn('branch_id',$data)->get();

        return view('customer.index')
        ->with('customers', $customers);
    }

    public function add(){
        $branches = GymBranch::where('gym_id', Auth::user()->gym_id)->get();
        $membership_plans = MembershipPlan::where('gym_id', Auth::user()->gym_id)->get();
        $session_without_trainers = SessionFee::where([
            'gym_id' => Auth::user()->gym_id,
            'type' => 0
        ])->get();
        $session_with_trainers = SessionFee::where([
            'gym_id' => Auth::user()->gym_id,
            'type' => 1
        ])->get();

       return view('customer.add')
        ->with('branches', $branches)
        ->with('membership_plans', $membership_plans)
        ->with('session_without_trainers', $session_without_trainers)
        ->with('session_with_trainers', $session_with_trainers);
    }

    public function create(Request $request){
        // Validation rules
        $validation_rules = [
            'first_name' => 'required',
            'email_address' => 'email|nullable',
            'branch' => 'required',
            'gender' => 'required'
        ];

        // if checked then a selection for service is required
        if($request->entrance_check) {
            $validation_rules['entrance_fee'] = 'required';
            // discount validation should be a number
            if($request->entrance_fee_discount) {
                $validation_rules['entrance_fee_discount'] = 'numeric';
            }
        }
        // if checked then a selection for service is required        
        if($request->training_check) {
            $validation_rules['training_plan'] = 'required';
            // discount validation should be a number
            if($request->training_plan_discount) {
                $validation_rules['training_plan_discount'] = 'numeric';
            }
        }
        // if checked then a selection for service is required        
        if($request->membership_check) {
            $validation_rules['membership_plan'] = 'required';
            // discount validation should be a number
            if($request->membership_plan_discount) {
                $validation_rules['membership_plan_discount'] = 'numeric';
            }
        }

        $validator = Validator::make($request->all(), $validation_rules)->validate();
        // Validation rules

        // Image upload
        $image = 'male_avatarc.png';
        if($request->file('image') == null) {
            if($request->gender == 1) { // female
                $image = 'female_avatarc.png';
            }
        }
        else {
            $avatar = $request->file('image');
            $ext  = strtolower($avatar->getClientOriginalExtension()); //Get extension
            $image = time().'.'. $ext;
            $img  = Image::make($avatar->getRealPath());
            $public_path = public_path('/dist/img/avatar/');
            $img->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($public_path . $image); //save image
        }
        // Image upload

        // Creation of slug
        $slug = $request->first_name . ($request->middle_name? '-'.$request->middle_name:'') . ($request->last_name? '-'.$request->last_name:'');
        $slug = strtolower(str_replace(' ', '-', $slug) . '-' . date('ymdhms'));
        
        $customer = Customer::create([
            'first_name'            => $request->input('first_name'),
            'middle_name'           => $request->input('middle_name'),     
            'last_name'             => $request->input('last_name'),
            'gender'                => $request->input('gender'),
            'birthdate'             => $request->birthdate? date('Y-m-d', strtotime($request->birthdate)):null,
            'email_address'         => $request->input('email_address'),
            'home_address'          => $request->input('home_address'),
            'contact_number'        => $request->input('contact_number'),
            'image'                 => $image,
            'gym_id'                => Auth::user()->gym_id,
            'branch_id'             => $request->input('branch'),
            'slug'                  => $slug
        ]);

        if($request->entrance_check) {
            $entrance_fee = SessionFee::find($request->entrance_fee);
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + '.$entrance_fee->days.' days'));
            
            if($entrance_fee->days == 1) {
                $end_date = date('Y-m-d');
            }
            InvoiceSession::create([
                'start_date' => $start_date,
                'end_date' => $end_date,
                'customer_id' => $customer->id,
                'fee_id' => $request->entrance_fee,
                'discount' => $request->entrance_fee_discount? $request->entrance_fee_discount:0,
                'total' => $request->entrance_fee_discount? $request->entrance_fee_discount:$entrance_fee->price,
                'type' => 0, // without personal trainer
                'created_by' => Auth::user()->id,
                'gym_id' => Auth::user()->gym_id,
                'branch_id' => $request->input('branch'),
            ]);
        }
        if($request->training_check) {
            $training_plan = SessionFee::find($request->training_plan);
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + '.$training_plan->days.' days'));

            if($training_plan->days == 1) {
                $end_date = date('Y-m-d');
            }
            InvoiceSession::create([
                'start_date' => $start_date,
                'end_date' => $end_date,
                'customer_id' => $customer->id,
                'fee_id' => $request->training_plan,
                'discount' => $request->training_plan_discount? $request->training_plan_discount:0,
                'total' => $request->training_plan_discount? $request->training_plan_discount:$training_plan->price,
                'type' => 1, // with personal trainer
                'created_by' => Auth::user()->id,
                'gym_id' => Auth::user()->gym_id,
                'branch_id' => $request->input('branch'),
            ]);
        }
        if($request->membership_check) {
            $membership_plan = MembershipPlan::find($request->membership_plan);
            $start_date = date('Y-m-d');
            $end_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + '.$membership_plan->days.' days'));

            if($membership_plan->days == 1) {
                $end_date = date('Y-m-d');
            }
            InvoiceMembership::create([
                'start_date' => $start_date,
                'end_date' => $end_date,
                'customer_id' => $customer->id,
                'plan_id' => $request->membership_plan,
                'discount' => $request->membership_plan_discount? $request->membership_plan_discount:0,
                'total' => $request->membership_plan_discount? $request->membership_plan_discount:$membership_plan->price,
                'created_by' => Auth::user()->id,
                'gym_id' => Auth::user()->gym_id,
                'branch_id' => $request->input('branch'),
            ]);
        }
        
        return redirect('/customer')
        ->with('message', '<div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully registered a new customer.
                            </div>');
        
    }
    
    public function edit(Request $request) {
        $customer = Customer::with('branch')->where('slug', $request->slug)
        ->first();
        
        $customer_logs = CustomerLog::where('customer_id', '=', $customer->id)
        ->orderBy('id', 'desc')
        ->get();
        
        $customer_purchase = OrderList::join('invoice_product', 'invoice_id', 'invoice_product.id')
        ->where('customer_id', $customer->id)
        ->get();

        $customer_invoice = InvoiceProduct::with('order_list')
        ->where('customer_id', $customer->id)
        ->orderBy('invoice_product.id', 'desc')
        ->get();

        $services = [];

        $invoice_membership = InvoiceMembership::with('membership_plan')->where('customer_id', '=', $customer->id)->get();
        $invoice_entrance = InvoiceSession::with('entrance_fee')->where([
            'customer_id' => $customer->id,
            'type' => 0
        ])->get();
        $invoice_training = InvoiceSession::with('entrance_fee')->where([
            'customer_id' => $customer->id,
            'type' => 1
        ])->get();

        foreach($invoice_membership as $membership) {
            $services[] = [
                $membership->id,
                $membership->start_date,
                $membership->end_date,
                $membership->membership_plan->name,
                $membership->membership_plan->details,
                $membership->membership_plan->days,
                $membership->membership_plan->price,
                $membership->discount,
                $membership->total,
                0,
                $membership->created_at
            ];
        }

        foreach($invoice_entrance as $entrance) {
            $services[] = [
                $entrance->id,
                $entrance->start_date,
                $entrance->end_date,
                $entrance->entrance_fee->name,
                $entrance->entrance_fee->details,
                $entrance->entrance_fee->days,
                $entrance->entrance_fee->price,
                $entrance->discount,
                $entrance->total,
                1,
                $entrance->created_at
            ];
        }

        foreach($invoice_training as $training) {
            $services[] = [
                $training->id,
                $training->start_date,
                $training->end_date,
                $training->entrance_fee->name,
                $training->entrance_fee->details,
                $training->entrance_fee->days,
                $training->entrance_fee->price,
                $training->discount,
                $training->total,
                2,
                $training->created_at
            ];
        }

        return view('customer.info')
        ->with('customer', $customer)
        ->with('customer_logs', $customer_logs)
        ->with('customer_purchase', $customer_purchase)
        ->with('customer_invoice', $customer_invoice)
        ->with('services', $services);
    }

    public function update(CustomerRequest $request, $slug) {
        if($request->branch) {
            $validation_rules['branch'] = 'required';
        }

        $customer = Customer::where('slug',$slug)->first();

        $image = $request->file('image');
        $path   = public_path('/dist/img/avatar/');

        if($image!=null) {
            $ext  = strtolower($image->getClientOriginalExtension()); //Get extension
            $file_name = time().'.'. $ext;
            $img  = Image::make($image->getRealPath());
            $img->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($path . $file_name); //save image
            File::delete($path . $customer->image);
        }

        $customer->update([
            'first_name'            => $request->input('first_name'),
            'middle_name'           => $request->input('middle_name'),     
            'last_name'             => $request->input('last_name'),
            'gender'                => $request->input('gender'),
            'birthdate'             => $request->birthdate? date('Y-m-d', strtotime($request->birthdate)):null,
            'email_address'         => $request->input('email_address'),
            'home_address'          => $request->input('home_address'),
            'contact_number'        => $request->input('contact_number'),
            'image' => $image != null ? $file_name : ($request->gender==0? 'male_avatarc.png':'female_avatarc.png'),
        ]);


        return redirect('/customer/'.$customer->slug)
        ->with('message', '<div class="col-xs-12"><div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Success</h4>
                            You have successfully updated customer profile.
                            </div></div>');
    }
}
