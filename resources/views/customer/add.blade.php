@extends('layouts.master')

@section('title')
  ClausenFitness | Customer
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/flat/blue.css') }}">
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
            <li>Add</li>
        </ol>
    </section>

    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                {!! Session::get('message') !!}
                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                           
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
                                            <img src="{{ asset('dist/img/avatar/male_avatarc.png') }}" class="prodImgPrev" id="prodImgPrev">
                                        </div>
                                        <input type="file" name="image" id="image" class="imgFile hidden" accept="image/x-png,image/gif,image/jpeg" style="display:none;" enctype="multipart/form-data">
                                    </div>
                                    <div class="col-xs-4 col-xs-offset-4">
                                        <div class="box box-widget widget-user-2">
                                            <div class="widget-user-header bg-aqua">
                                                <strong>Invoice #: 2018-02-0001</strong>
                                            </div>
                                            <div class="box-footer no-padding">
                                                <ul class="nav nav-stacked" id="invoice_breakdown">
                                                    <li><a href="#"><strong>Total: </strong><span class="pull-right"><strong>Php 0.00</strong></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
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
                                        <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="">
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
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="" disabled selected>Gender</option>
                                                <option value="0" {{ old('gender')!=null && old('gender')!=1? 'selected':'' }}>Male</option>
                                                <option value="1" {{ old('gender')==1? 'selected':'' }}>Female</option>
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
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Mobile Number (09567108146)" name="contact_number" value="{{ old('contact_number') }}">
                                        </div>
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
                                            <input type="email" class="form-control" placeholder="Email Address" name="email_address" value="{{ old('email_address') }}">
                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                            <select class="form-control" name="branch" id="branch">
                                                <option value="" disabled selected>Branch</option>
                                                @foreach($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{ old('branch')==$branch->id? 'selected':'' }}>{{ $branch->address }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('branch') }}</i></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                              <div class="row">
                                <div class="col-xs-12">
                                    Choose service type:
                                    <button type="button" class="btn btn-default btn-sm margin-left-50 checkbox-toggle"><i class="fa fa-square-o"></i></button> Check all
                                    <span class="margin-left-20">
                                        <input type="checkbox" name="entrance_check" id="entrance_combo"> Entrance Fee
                                    </span>
                                    <span class="margin-left-20">
                                        <input type="checkbox" name="training_check" id="training_combo"> Training Plan
                                    </span>
                                    <span class="margin-left-20">
                                        <input type="checkbox" name="membership_check" id="membership_combo"> Membership Plan
                                    </span>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                                <div class="row" id="services">
                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary "><i class="fa fa-check-square-o"></i> Submit</button>
                                        <a href="/customer" class="btn btn-danger"><i class="fa fa-ban"></i> Back</a>
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
<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
    });

    $(document).ready(function(){
        var services = $('#services');
        var entrance_fee_options = '';
        var entrance_values = [];
        var training_plan_options = '';
        var training_values = [];
        var membership_options = '';
        var membership_values = [];

        @foreach($session_without_trainers as $entrance_fee)
            entrance_values.push({{ $entrance_fee->price }});
            entrance_fee_options += '\t\t\t<option value="{{ $entrance_fee->id }}">{{ $entrance_fee->name }}</option>\n';
        @endforeach

        @foreach($session_with_trainers as $trainer_plan)
            training_values.push({{ $trainer_plan->price }});
            training_plan_options += '\t\t\t<option value="{{ $trainer_plan->id }}">{{ $trainer_plan->name }}</option>\n';
        @endforeach

        @foreach($membership_plans as $membership_plan)
            membership_values.push({{ $membership_plan->price }});
            membership_options += '\t\t\t<option value="{{ $membership_plan->id }}">{{ $membership_plan->name }}</option>\n';
        @endforeach

        var entrance_fees = '<div class="col-xs-4" id="entrance_fee">\n' +
                                            '\t<div class="input-group">\n' +
                                                '\t\t<span class="input-group-addon"><i class="fa fa-calendar"></i></span>\n' +
                                                '\t\t<select class="form-control" id="entrance_fee_select" name="entrance_fee">\n' +
                                                    '\t\t\t<option disabled selected>Entrance Fee</option>\n' +
                                                    entrance_fee_options +
                                                '\t\t</select>\n' +
                                            '\t</div>\n' +
                                            '\t<div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first("entrance_fee") }}</i></div>' +
                                            '\t</br>' +
                                            '\t<div class="input-group">' +
                                                    '\t\t<div class="input-group-addon"><i class="fa fa-tag"></i></div>' +
                                                    '\t\t<input type="text" class="form-control" id="entrance_fee_discount" placeholder="Entrance Fee Discounted Price" name="entrance_fee_discount" value="{{ old("entrance_fee_discount") }}">' +
                                            '\t</div>' +
                                            '\t<div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first("entrance_fee_discount") }}</i></div>' +
                                        '</div>\n';

        var training_plans = '<div class="col-xs-4" id="training_plan">\n' +
                                            '\t<div class="input-group">\n' +
                                                '\t\t<span class="input-group-addon"><i class="fa fa-calendar"></i></span>\n' +
                                                '\t\t<select class="form-control" id="training_plan_select" name="training_plan">\n' +
                                                    '\t\t\t<option disabled selected>Training Plan</option>\n' +
                                                    training_plan_options +
                                                '\t\t</select>\n' +
                                            '\t</div>\n' +
                                            '\t<div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first("training_plan") }}</i></div>' +
                                            '\t</br>' +
                                            '\t<div class="input-group">' +
                                                    '\t\t<div class="input-group-addon"><i class="fa fa-tag"></i></div>' +
                                                    '\t\t<input type="text" class="form-control" id="training_plan_discount" placeholder="Training Plan Discounted Price" name="training_plan_discount" value="{{ old("training_plan_discount") }}">' +
                                            '\t</div>' +
                                            '\t<div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first("training_plan_discount") }}</i></div>' +
                                        '</div>\n';

        var membership_plans = '<div class="col-xs-4" id="membership_plan">\n' +
                                            '\t<div class="input-group">\n' +
                                                '\t\t<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>\n' +
                                                '\t\t<select class="form-control" id="membership_plan_select" name="membership_plan">\n' +
                                                    '\t\t\t<option disabled selected>Membership Plan</option>\n' +
                                                    membership_options +
                                                '\t\t</select>\n' +
                                            '\t</div>\n' +
                                            '\t<div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first("membership_plan") }}</i></div>' +
                                            '\t</br>' +
                                            '\t<div class="input-group">' +
                                                    '\t\t<div class="input-group-addon"><i class="fa fa-tag"></i></div>' +
                                                    '\t\t<input type="text" class="form-control" id="membership_plan_discount" placeholder="Membership Plan Discounted Price" name="membership_plan_discount" value="{{ old("membership_plan_discount") }}">' +
                                            '\t</div>' +
                                            '\t<div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first("membership_plan_discount") }}</i></div>' +
                                        '</div>\n';

        // Render old inputs of services for entrance_fee
        if("{{ old('entrance_check') }}") {
            $('#entrance_combo').iCheck('check');    
            services.append(entrance_fees);
            if("{{ old('entrance_fee') }}" != '') {
                $('#entrance_fee select').val("{{ old('entrance_fee') }}");
            }
            render_breakdown();
        }

        // Render old inputs of services for training_plan
        if("{{ old('training_check') }}") {
            $('#training_combo').iCheck('check');    
            services.append(training_plans);
            if("{{ old('training_plan') }}" != '') {
                $('#training_plan select').val("{{ old('training_plan') }}");
            }
            render_breakdown();
        }

        // Render old inputs of services for membership_plan
        if("{{ old('membership_check') }}") {
            $('#membership_combo').iCheck('check');    
            services.append(membership_plans);
            if("{{ old('membership_plan') }}" != '') {
                $('#membership_plan select').val("{{ old('membership_plan') }}");
            }
            render_breakdown();
        }

        // Render old input of photo
        if("{{ old('gender') }}" == '1') {
            genderChange(1);
        }

        // checkboxes trigger if changed
        $('#entrance_combo').on('ifChanged', function(event) {
            if(event.target.checked) {
                services.append(entrance_fees);
            }
            else {
                $('#entrance_fee').remove();
            }
            render_breakdown();
        });

        $('#training_combo').on('ifChanged', function(event) {
            if(event.target.checked) {
                services.append(training_plans);
            }
            else {
                $('#training_plan').remove();
            }
            render_breakdown();
        });

        $('#membership_combo').on('ifChanged', function(event) {
            if(event.target.checked) {
                services.append(membership_plans);
            }
            else {
                $('#membership_plan').remove();
            }
            render_breakdown();
        });

        //Enable iCheck plugin for checkboxes
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $('.checkbox-toggle').click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
              //Uncheck all checkboxes
              $("input[type='checkbox']").iCheck("uncheck");
              $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            }
            else {
              //Check all checkboxes
              $("input[type='checkbox']").iCheck("check");
              $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }

            $(this).data("clicks", !clicks);
        });

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

        $(document).on('change', '#entrance_fee_select', render_breakdown);
        $(document).on('change', '#training_plan_select', render_breakdown);
        $(document).on('change', '#membership_plan_select', render_breakdown);
        $(document).on('change', '#entrance_fee_discount', render_breakdown);
        $(document).on('change', '#training_plan_discount', render_breakdown);
        $(document).on('change', '#membership_plan_discount', render_breakdown);

        function render_breakdown() {
            var invoice_breakdown = $('#invoice_breakdown');
            
            invoice_breakdown.empty();

            var total = 0;
            var entrance_price = 0;
            var training_price = 0;
            var membership_price = 0;
            var index = 0;

            if($('#entrance_combo').prop('checked')) {
                index = document.getElementById("entrance_fee_select").selectedIndex;
                if(index != 0) {
                    entrance_price = entrance_values[index-1];
                }
                if($.isNumeric($('#entrance_fee_discount').val())) {
                    entrance_price = parseFloat($('#entrance_fee_discount').val());
                }
                invoice_breakdown.append('<li><a href="#"><strong>Entrance Fee: </strong><span class="pull-right">Php ' + parseFloat(entrance_price).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + '</span></a></li>');
            }
            if($('#training_combo').prop('checked')) {
                index = document.getElementById("training_plan_select").selectedIndex;
                if(index != 0) {
                    training_price = training_values[index-1];
                }
                if($.isNumeric($('#training_plan_discount').val())) {
                    training_price = parseFloat($('#training_plan_discount').val());
                }
                invoice_breakdown.append('<li><a href="#"><strong>Training Plan: </strong><span class="pull-right">Php ' + parseFloat(training_price).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + '</span></a></li>');
            }
            if($('#membership_combo').prop('checked')) {
                index = document.getElementById("membership_plan_select").selectedIndex;
                if(index != 0) {
                    membership_price = membership_values[index-1];
                }
                if($.isNumeric($('#membership_plan_discount').val())) {
                    membership_price = parseFloat($('#membership_plan_discount').val());
                }
                invoice_breakdown.append('<li><a href="#"><strong>Membership Plan: </strong><span class="pull-right">Php ' + parseFloat(membership_price).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + '</span></a></li>');
            }

            total = entrance_price + training_price + membership_price;
            invoice_breakdown.append('<li><a href="#"><strong>Total: </strong><span class="pull-right"><strong>Php ' + parseFloat(total).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,') + '</strong></span></a></li>');
        }

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