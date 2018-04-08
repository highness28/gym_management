@extends('layouts.master')

@section('title')
	ClausenFitness | Session Fee
@endsection

@section('css')
  
@endsection

@section('content')
	<section class="content-header">
      <h1>
        Session Fee
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/session_fee">Gym Management | Session Fee</a></li>
        <li>Add</li>
      </ol>
    </section>

     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Session Fee Information</h4>
                    </div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                     <div class="col-xs-12 col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-info"></i>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Session Name" name="name" value="{{ old('name') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('name') }}</i></div>
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                            <input type="text" class="form-control" placeholder="Price" name="price" value="{{ old('price') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('price') }}</i></div>
                                    </div>

                                    <div class="col-xs-12 col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control" placeholder="Days" name="days" value="{{ old('days') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('days') }}</i></div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <textarea name="details" rows="4" class="form-control" placeholder="Details" values="{{ old('details') }}">{{ old('details') }}</textarea>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('details') }}</i></div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                            <select class="form-control" name="type" id="type">
                                                <option value="" disabled selected>Session Type</option>
                                                <option value="0">Regular</option>
                                                <option value="1">Training</option>
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('type') }}</i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <a href="/session_fee" class="btn btn-danger"><i class="fa fa-ban"></i> Back</a>
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