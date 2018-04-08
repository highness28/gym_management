@extends('layouts.master')

@section('title')
	ClausenFitness | Product
@endsection

@section('css')
  
@endsection

@section('content')
	<section class="content-header">
      <h1>
        Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="/product">Gym Management | Product</a></li>
        <li>Edit</li>
      </ol>
    </section>
    
     <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Product Information</h4>
                    </div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image_preview">
                                            <label for="image"><i class="fa fa-camera"></i></label>
                                            <img src="{{ asset('dist/img/product/'.$product->image) }}" class="prodImgPrev" id="prodImgPrev">
                                        </div>
                                        <input type="file" name="image" id="image" class="imgFile hidden" accept="image/x-png,image/gif,image/jpeg" style="display:none;" enctype="multipart/form-data">
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('image') }}</i></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="ion ion-android-list"></i>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Product Name" name="product_name" value="{{ $product->product_name }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('product_name') }}</i></div>
                                    </div>
                                    

                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="ion ion-social-usd"></i>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Selling Price" name="selling_price" value="{{ $product->selling_price }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('selling_price') }}</i></div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="ion ion-bookmark"></i>
                                            </div>
                                            <select name="brand" id="brand" class="form-control">
                                                <option value="" disabled selected>Select Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $product->brand_id==$brand->id? 'selected':'' }}>{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('brand') }}</i></div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="ion ion-pricetag"></i>
                                            </div>
                                            <select name="main_category" id="main_category" class="form-control">
                                                <option value="" disabled selected>Select Main Category</option>
                                                @foreach($main_categories as $main_category)
                                                    <option value="{{ $main_category->id }}" {{ $product->main_category_id==$main_category->id? 'selected':'' }}>{{ $main_category->main_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('main_category') }}</i></div>
                                    </div>

                                    <div class="col-xs-12 col-sm-8 col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="ion ion-pricetags"></i>
                                            </div>
                                            <select name="sub_category" id="sub_category" class="form-control">
                                                <option value="" disabled selected>Select Sub Category</option>
                                                @foreach($sub_categories as $sub_category)
                                                    <option value="{{ $sub_category->id }}" {{ $product->sub_category_id==$sub_category->id? 'selected':'' }}>{{ $sub_category->sub_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('sub_category') }}</i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-8">
                                        <textarea name="details" id="details" class="form-control" placeholder="Product Details" rows="5">{{ $product->details }}</textarea>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('details') }}</i></div>
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
    <script>
        $(document).ready(function(){
            $(document.getElementById('remove')).attr('style', 'cursor: pointer');
            $(document).on('click', '#remove', function() {
                $(this).closest('div').remove();
            });
            
            $('.imgFile').change(function(){
                var file = this.files[0];
                var imagefile = file.type;
                var match= ["image/jpeg","image/png","image/jpg"];  

                if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
                {
                    $('.prodImgPrev').attr('src','{{ asset('img/noimage.jpg') }}');
                    return false;
                }
                    else
                {
                    var reader = new FileReader();  
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });

            function imageIsLoaded(e){
                $('.prodImgPrev').attr('src', e.target.result);
            }
            
            $('#reset').on('click', function() {
                $('#image').val('');
                $('#prodImgPrev').attr('src', '{{ asset('dist/img/product/default.png') }}');
            });
        });
    </script>
@endsection