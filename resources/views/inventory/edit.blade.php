@extends('layouts.master')

@section('title')
    ClausenFitness | Inventory
@endsection

@section('css')
  
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Inventory
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/inventory">Gym Management | Inventory</a></li>
        <li>Add</li>
      </ol>
    </section>

     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Inventory Information</h4>
                        <span class="pull-right">{{ date('F d, Y h:m A') }}</span>
                    </div>
                    <div class="box-body">
                        <form method="POST" id="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <label for="product_name">Product Name:</label>
                                        <span>{{ $inventory->product->product_name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <input type="number" name="unit_price" class="form-control" placeholder="Unit Price" value="{{ $inventory->unit_price }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-line-chart"></i>
                                            </div>
                                            <input type="number" name="quantity" class="form-control" placeholder="Quantity" value="{{ $inventory->quantity }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <select id="supplier_id" name="supplier_id" class="form-control">
                                                <option value="" disabled selected>Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}" {{ $inventory->supplier_id==$supplier->id? 'selected':'' }}>{{ $supplier->supplier_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('supplier_id') }}</i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <a href="/inventory" class="btn btn-danger"><i class="fa fa-ban"></i> Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                tags: true,
                multiple: true,
                tokenSeparators: [',']
            });
        });
    </script>
@endsection