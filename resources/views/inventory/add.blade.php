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
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-list"></i>
                                            </div>
                                            <select id="products" name="product_id[]" class="form-control select2" multiple="multiple" data-placeholder="Select product/s">
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id.'|'.$product->product_name }}"
                                                        @if(is_array(old('product_id')))
                                                            @foreach (old('product_id') as $old_product)
                                                                @if(explode('|', $old_product)[0]==$product['id'])
                                                                    selected
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    >{{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('product_id') }}</i></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-users"></i>
                                            </div>
                                            <select id="supplier_id" name="supplier_id" class="form-control">
                                                <option value="" disabled selected>Supplier</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}" {{ old('supplier_id')==$supplier->id? 'selected':'' }}>{{ $supplier->supplier_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('supplier_id') }}</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row" id="quantity_table">
                                    @if(is_array(old('product_id')))
                                        <div class="col-xs-12 col-sm-6">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <th>Product Name</th>
                                                    <th width="100">Unit Price</th>
                                                    <th width="50">Quantity</th>
                                                </thead>
                                                <tbody>
                                                    @for($i = 0; $i < count(old('product_id')); $i++)
                                                        <tr>
                                                            <td>{{ explode('|', old('product_id')[$i])[1] }}</td>
                                                            <td><input type="text" name="unit_price[]" style="width: 100px;" value="{{ old('unit_price')[$i] }}"></td>
                                                            <td><input type="text" name="quantity[]" style="width: 50px;" value="{{ old('quantity')[$i] }}"></td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                    @if($errors)
                                        <?php
                                            $quantity_required = false;
                                            $quantity_numeric = false;
                                            $unit_price_required = false;
                                            $unit_price_numeric = false;
                                        ?>
                                        <div class="col-xs-12">
                                            @foreach($errors->all() as $error)
                                                @if(strpos($error, 'quantity') && strpos($error, 'required'))
                                                    <?php
                                                        $quantity_required = true;
                                                    ?>
                                                @endif
                                                
                                                @if(strpos($error, 'quantity') && strpos($error, 'integer'))
                                                    <?php
                                                        $quantity_numeric = true;
                                                    ?>
                                                @endif

                                                @if(strpos($error, 'unit_price') && strpos($error, 'required'))
                                                    <?php
                                                        $unit_price_required = true;
                                                    ?>
                                                @endif

                                                @if(strpos($error, 'unit_price') && strpos($error, 'number'))
                                                    <?php
                                                        $unit_price_numeric = true;
                                                    ?>
                                                @endif
                                            @endforeach

                                            @if($quantity_required)
                                                <div class="input_error" style="color:#b71c1c;"><i>The quantity field is required</i></div>
                                            @endif

                                            @if($quantity_numeric)
                                                <div class="input_error" style="color:#b71c1c;"><i>The quantity field should be exact</i></div>
                                            @endif

                                            @if($unit_price_required)
                                                <div class="input_error" style="color:#b71c1c;"><i>The unit price field is required</i></div>
                                            @endif

                                            @if($unit_price_numeric)
                                                <div class="input_error" style="color:#b71c1c;"><i>The unit price field should be a number</i></div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-4">
                                        <textarea name="remarks" class="form-control" rows="10" placeholder="Remarks">{{ old('remarks') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                    <a href="/inventory" class="btn btn-danger"><i class="fa fa-ban"></i> Back</a>
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

            $('#products').on('change', function() {
                $products = $('#products').val();
                $product_rows = '';

                $.each($products, function(i, value) {
                    $product_rows += '<tr>' +
                                        '<td>'+value.split('|')[1]+'</td>' +
                                        '<td><input type="text" name="unit_price[]" style="width: 100px;"></td>' +
                                        '<td><input type="text" name="quantity[]" style="width: 50px;" value="1"></td>' +
                                    '</tr>';
                });

                $('#quantity_table').empty();
                
                if($products.length > 0) {
                    $('#quantity_table').append('<div class="col-xs-12 col-sm-6">' +
                                                    '<table class="table table-bordered table-striped">' +
                                                        '<thead>' +
                                                            '<th>Product Name</th>' +
                                                            '<th width="100">Unit Price</th>' +
                                                            '<th width="50">Quantity</th>' +
                                                        '</thead>' +
                                                        '<tbody>' +
                                                            $product_rows +
                                                        '</tbody>' +
                                                    '</table>' +
                                                '</div>');
                }
            });
        });
    </script>
@endsection