@extends('layouts.master')

@section('title')
	ClausenFitness | Employee
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
    
	<section class="content-header">
        <h1>
            Employee
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><a href="/employee">Gym Management | Employee</a></li>
            <li>Add</li>
        </ol>
    </section>

    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                {!! Session::get('message') !!}
                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">Employee Information</h4>
                    </div>
                    <form method="POST" id="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="image_preview">
                                            <label for="image"><i class="fa fa-camera"></i></label>
                                            <img src="{{ asset('dist/img/avatar/male_avatarc.png') }}" class="prodImgPrev" id="prodImgPrev">
                                        </div>
                                        <input type="file" name="image" id="image" class="imgFile hidden" accept="image/x-png,image/gif,image/jpeg" style="display:none;" enctype="multipart/form-data">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}">
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('first_name') }}</i></div>
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="{{ old('middle_name') }}">
                                    </div>
                                    <div class="col-xs-4">
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('last_name') }}</i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <select class="form-control" name="gender" id="gender" name="gender">
                                                <option value="" disabled selected>Gender</option>
                                                <option value="0"
                                                    @if(old('gender')=='0')
                                                        {{ 'selected' }}
                                                    @endif>Male</option>
                                                <option value="1"
                                                    @if(old('gender')=='1')
                                                        {{ 'selected' }}
                                                    @endif>Female</option>
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('gender') }}</i></div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Birthday" name="birthdate" value="{{ old('birthdate') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('birthdate') }}</i></div>
                                    </div>
                                     <div class="col-xs-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Mobile Number (09567108146)" name="contact_number" value="{{ old('contact_number') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('contact_number') }}</i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-map-marker"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Home Address" name="home_address" value="{{ old('home_address') }}">
                                </div>
                            </div>
                              <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                            <input type="email" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('email') }}</i></div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                                <select class="form-control" name="user_type" id="user_type">
                                                    <option value="" disabled selected>User Type</option>
                                                    <option value="0"
                                                        @if(old('user_type')=='0')
                                                            {{ 'selected' }}
                                                        @endif>Cashier
                                                    </option>
                                                    <option value="1"
                                                        @if(old('user_type')=='1')
                                                            {{ 'selected' }}
                                                        @endif>Trainer
                                                    </option>
                                                    @if(Auth::user()->user_type==3 || Auth::user()->user_type==4)
                                                        <option value="2"
                                                            @if(old('user_type')=='2')
                                                                {{ 'selected' }}
                                                            @endif>Supervisor
                                                        </option>
                                                    @endif
                                                    @if(Auth::user()->user_type==4)
                                                        <option value="3"
                                                            @if(old('user_type')=='3')
                                                                {{ 'selected' }}
                                                            @endif>Owner
                                                        </option>
                                                    @endif
                                                </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('user_type') }}</i></div>
                                    </div>
                                     <div class="col-xs-4">

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <select class="form-control" name="branch" id="branch" name="branch">
                                                <option value="" disabled>Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}">{{ $branch->address }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('password') }}</i></div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('confirm_password') }}</i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <a href="/employee" class="btn btn-danger"><i class="fa fa-ban"></i> Back</a>
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
            $('#gender').val('0');

            genderChange($('#gender').val());
        });

        $('#gender').on('change', function() {
            genderChange($(this).val());
        });

        if("{{ old('gender') }}" != null) {
            if(!$('#image').val()) {
                genderChange("{{ old('gender') }}");
            }
        }
        
        function genderChange(id) {
            if(!$('#image').val()){
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