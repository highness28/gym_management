@extends('layouts.master')

@section('title')
	ClausenFitness | Branch
@endsection

@section('css')
  
@endsection

@section('content')
	<section class="content-header">
      <h1>
        Branch
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/branch">Gym Management | Branch</a></li>
        <li>Add</li>
      </ol>
    </section>

     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Branch Information</h4>
                    </div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Address" name="address" value="{{ old('address') }}">
                                </div>
                                <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('address') }}</i></div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Mobile Number (09567108146)" name="contact" value="{{ old('contact') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('contact') }}</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                            <select class="form-control" name="branch_type" id="branch_type">
                                                <option value="" disabled selected>Branch Type</option>
                                                <option value="0" {{ old('branch_type')=='0'? 'selected':''  }}>Secondary Branch</option>
                                                <option value="1" {{ old('branch_type')=='1'? 'selected':''  }}>Main Brach</option>
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('branch_type') }}</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <a href="/branch" class="btn btn-danger"><i class="fa fa-ban"></i> Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection