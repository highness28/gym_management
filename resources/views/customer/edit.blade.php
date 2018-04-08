@extends('layouts.master')

@section('title')
  ClausenFitness | Customer
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')

  <section class="content-header">
        <h1>
            Customer
            <small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="/customer">Customer</a></li>
            <li>Edit</li>
        </ol>
    </section>

    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                {!! Session::get('message') !!}
                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            {{ $customer->first_name . ' ' }}
                            {{ $customer->middle_name? $customer->middle_name:'' . ' ' }}
                            {{ $customer->last_name }}
                        </h4>
                    </div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image_preview">
                                            <label for="image"><i class="fa fa-camera"></i></label>
                                            <img src="{{ asset('dist/img/avatar/'.$customer->image) }}" class="prodImgPrev" id="prodImgPrev">
                                        </div>
                                        <input type="file" name="image" id="image" class="imgFile hidden" accept="image/x-png,image/gif,image/jpeg" style="display:none;" enctype="multipart/form-data">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ $customer->first_name }}">
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('first_name') }}</i></div>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="{{ $customer->middle_name }}">
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('middle_name') }}</i></div>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ $customer->last_name }}">
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('last_name') }}</i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="" disabled selected>Gender</option>
                                                <option value="0" {!! $customer->gender == 0 ? 'selected':'' !!}>Male</option>
                                                <option value="1" {!! $customer->gender == 1 ? 'selected':'' !!}>Female</option>
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('gender') }}</i></div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Birthday" name="birthdate" value="{{ date('m/d/Y', strtotime($customer->birthdate)) }}">
                                        </div>
                                    </div>
                                     <div class="col-xs-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Mobile Number (09567108146)" name="contact_number" value="{{ $customer->contact_number }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Home Address" name="home_address" value="{{ $customer->home_address }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="email" class="form-control" placeholder="Email Address" name="email_address" value="{{ $customer->email_address }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <select class="form-control" name="branch" id="branch">
                                                <option value="" disabled selected>Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{ $customer->branch_id==$branch->id? 'selected':''  }}>{{ $branch->address }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <a href="/customer" class="btn btn-danger"><i class="fa fa-ban"></i> Back</a>
                                        <!-- <button type="reset" id="reset" class="btn btn-danger"><i class="fa fa-ban"></i> Reset</button> -->
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
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
    });

    $(document).ready(function(){
        $('.imgFile').change(function(){
            var file = this.files[0];
            var imagefile = file.type;
            var match= ["image/jpeg","image/png","image/jpg"];  

            if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) {
                $('.prodImgPrev').attr('src','{{ asset('img/noimage.jpg') }}');
                return false;
            }
            else {
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
            $('#gender').val('0');
            
            genderChange($('#gender').val());
        });

        $('#gender').on('change', function() {
            genderChange($(this).val());
        });

        if("{{ old('gender') }}" != null && "{{ $customer->image }}" == '') {
            if(!$('#image').val()) {
                genderChange("{{ old('gender') }}");
            }
        }

        function genderChange(id) {
            if(!$('#image').val() && ("{{ $customer->image }}" == 'male_avatarc.png' || "{{ $customer->image }}" == 'female_avatarc.png')){
                // Female
                if(id==1) {
                    $('#prodImgPrev').attr('src', '{{ asset('dist/img/avatar/female_avatarc.png') }}');
                }
                // Male
                else {
                    $('#prodImgPrev').attr('src', '{{ asset('dist/img/avatar/male_avatarc.png') }}');
                }
            }
        }
    });
</script>
@endsection