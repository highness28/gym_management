@extends('layouts.master')

@section('title')
	ClausenFitness | Brand
@endsection

@section('css')
  
@endsection

@section('content')
	<section class="content-header">
      <h1>
        Brand
        <small>Information</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/brand">Gym Management | Brand</a></li>
        <li>Edit</li>
      </ol>
    </section>

     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><h4 class="box-title">{{ $brand->brand_name }}</h3></div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </span>
                                            <input type="text" name="brand_name" class="form-control" placeholder="Brand Name" value="{{ $brand->brand_name }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('brand_name') }}</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <button type="reset" id="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button>
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