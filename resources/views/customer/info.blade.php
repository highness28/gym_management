@extends('layouts.master')

@section('title')
  ClausenFitness | Customer
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
      <h1>
        Customer Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/customer">Customer</a></li>
        <li class="active">{{ $customer->first_name . ($customer->middle_name? ' '.$customer->middle_name:'') . ($customer->middle_name? ' '.$customer->last_name:'') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        {!! Session::get('message') !!}
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                <img src="{{ asset('dist/img/avatar/'.$customer->image) }}" class="profile-user-img img-responsive img-circle" alt="Profile Picture">

              <h3 class="profile-username text-center">{{ $customer->first_name . ($customer->middle_name? ' '.$customer->middle_name:'') . ($customer->middle_name? ' '.$customer->last_name:'') }}</h3>

              @if($customer->contact_number)
                <p class="text-muted text-center">{{ $customer->contact_number }}</p>
              @endif

              <hr>

              <strong>{!! $customer->gender==0? '<i class="fa fa-male margin-r-5"></i>':'<i class="fa fa-female margin-r-5"></i>' !!} Gender</strong>
              <p class="text-muted">{{ $customer->gender==0? 'Male':'Female' }}</p>
              <hr>

              <strong><i class="fa fa-calendar margin-r-5"></i> Birthdate</strong>
              <p class="text-muted">{{ $customer->birthdate!=null? $customer->birthdate:'' }}</p>
              <hr>

              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
              <p class="text-muted">{{ $customer->email_address }}</p>
              <hr>

              <strong><i class="fa fa-list margin-r-5"></i> Registration Date</strong>
              <p class="text-muted">{{ date('m/d/y h:ma', strtotime($customer->created_at)) }}</p>
              <hr>

              <strong><i class="fa fa-building margin-r-5"></i> Branch</strong>
              <p class="text-muted">{{ $customer->branch->address }}</p>
              <hr>

              <strong><i class="fa fa-home margin-r-5"></i> Address</strong>
              <p class="text-muted">{{ $customer->home_address }}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#service" data-toggle="tab"><i class="fa fa-credit-card"></i> Service</a></li>
              <li><a href="#purchase" data-toggle="tab"><i class="fa fa-money"></i> Purchase</a></li>
              <li><a href="#logs" data-toggle="tab"><i class="fa fa-book"></i> Logs</a></li>
              <li><a href="#profile" data-toggle="tab"><i class="fa fa-cog"></i> Profile Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="service">
                <div class="row">
                    <div class="col-xs-12">
                    <button class="btn btn-default" id="service_table_view"><i class="fa fa-table"></i></button>
                    <button class="btn btn-default" id="service_timeline_view"><i class="fa fa-clock-o"></i></button>
                  </div>
                </div>

                <br>

                <div class="row" id="service_table">
                  <div class="col-xs-12">
                    <table id="customer_service_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Name</th>
                          <th width="200">Details</th>
                          <th>Days</th>
                          <th>Original Price</th>
                          <th>Discounted Price</th>                          
                          <th>Total</th>
                          <th>Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($services as $service)
                          <tr>
                            <td>{{ $service[0] }}</td>
                            <td>{{ date('F d, Y', strtotime($service[1])) }}</td>
                            <td>{{ date('F d, Y', strtotime($service[2])) }}</td>
                            <td>{{ $service[3] }}</td>
                            <td>{{ $service[4] }}</td>
                            <td>{{ $service[5] }}</td>
                            <td>{{ 'Php ' . number_format($service[6], 2) }}</td>
                            <td>{{ $service[7]!=0? 'Php '.number_format($service[7], 2):'N/A' }}</td>
                            <td>{{ $service[7]!=0? 'Php '.number_format($service[7], 2):'Php ' . number_format($service[8], 2) }}</td>
                            <td>
                              @if($service[9]==0)
                                <span class="label label-info">Membership</span>
                              @elseif($service[9]==1)
                                <span class="label label-success">&nbsp&nbsp&nbspEntrance&nbsp&nbsp&nbsp</span>
                              @else
                                <span class="label label-danger">&nbsp&nbsp&nbsp&nbspTraining&nbsp&nbsp&nbsp&nbsp</span>
                              @endif
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <br>

                <div class="row" id="service_timeline">
                  <div class="col-xs-12">
                    <ul class="timeline timeline-inverse">
                      <?php $i = 0; ?>
                      @foreach($services as $service)
                        @if($i < 10)
                          <li class="time-label">
                              <span {!! $service==$services[0]? 'class="bg-red"':'' !!}>
                                {{ date('F d, Y', strtotime($service[9])) }}
                              </span>
                          </li>
                          
                          <li>
                            @if($service[8]==0)
                              <i class="fa fa-credit-card bg-aqua"></i>
                            @elseif($service[8]==1)
                              <i class="fa fa-credit-card bg-green"></i>
                            @else
                              <i class="fa fa-credit-card bg-red"></i>
                            @endif

                            <div class="timeline-item">
                              <h3 class="timeline-header no-border"> {{ $service[0] }}</h3>
                              <div class="timeline-body">
                                <strong>Service Name: </strong>{{ $service[3] }} <br>
                                <strong>Start Date: </strong>{{ $service[1] }} <br>
                                <strong>End Date: </strong>{{ $service[2] }} <br>
                                <strong>Details: </strong>{{ $service[4] }} <br>
                                <strong>Days: </strong>{{ $service[5] }}
                              </div>
                              <div class="timeline-footer">
                                <strong>Total: </strong>{{ $service[8] }}
                              </div>
                            </div>
                          </li>
                        @else
                          <?php break; ?>
                        @endif
                        <?php $i++; ?>
                      @endforeach

                      @if(count($services) > 0)
                        <li>
                          <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="purchase">
                <div class="row">
                    <div class="col-xs-12">
                    <button class="btn btn-default" id="purchase_table_view"><i class="fa fa-table"></i></button>
                    <button class="btn btn-default" id="purchase_timeline_view"><i class="fa fa-clock-o"></i></button>
                  </div>
                </div>

                <br>

                <div class="row" id="purchase_table">
                  <div class="col-xs-12">
                    <table id="customer_purchase_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="30">#</th>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th width="110">Discount Price</th>
                          <th width="20">Quantity</th>
                          <th>Subtotal</th>
                          <th>Total</th>
                          <th>Discount Total</th>
                          <th>Date and Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($customer_purchase as $purchase)
                          <tr>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ $purchase->product->product_name }}</td>
                            <td>{{ 'Php ' . number_format($purchase->product->selling_price, 2) }}</td>
                            <td>{{ $purchase->discount!=0? 'Php ' . number_format($purchase->discount, 2):'N/A' }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>{{ 'Php ' . number_format($purchase->sub_total, 2) }}</td>
                            <td>{{ 'Php ' . number_format($purchase->total, 2) }}</td>
                            <td>{{ $purchase->total_discount!=0? 'Php '.number_format($purchase->total_discount,2):'N\A' }}</td>
                            <td>{{ date('F d, Y h:m A', strtotime($purchase->created_at)) }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <br>

                <div class="row" id="purchase_timeline">
                  <div class="col-xs-12">
                    <ul class="timeline timeline-inverse">
                      <?php $i = 0; ?>
                      @foreach($customer_invoice as $invoice)
                        @if($i < 10)
                          <li class="time-label">
                              <span {!! $invoice==$customer_invoice->first()? 'class="bg-red"':'' !!}>
                                {{ date('F d, Y h:m A', strtotime($invoice->created_at)) }}
                              </span>
                          </li>
                          
                          <li>
                            <i class="fa fa-money bg-aqua"></i>

                            <div class="timeline-item">
                              <h3 class="timeline-header no-border"> #{{ $invoice->id }}</h3>

                              <div class="timeline-body">
                                <table class="table table-condensed">
                                  <thead>
                                    <tr>
                                      <th>Product Name</th>
                                      <th>Price</th>
                                      <th>Discount Price</th>
                                      <th>Quantity</th>
                                      <th>Subtotal</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($invoice->order_list as $order_list)
                                      <tr>
                                        <td>{{ $order_list->product->product_name }}</td>
                                        <td>{{ 'Php ' . number_format($order_list->product->selling_price, 2) }}</td>
                                        <td>{{ $order_list->discount!=0? 'Php ' . number_format($order_list->discount, 2):'N/A' }}</td>
                                        <td>{{ $order_list->quantity }}</td>
                                        <td>{{ 'Php ' . number_format($order_list->discount==0? $order_list->sub_total:$order_list->discount*$order_list->quantity, 2) }}</td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                              <div class="timeline-footer">
                                <span><strong>Total: </strong>Php {{ number_format($invoice->total, 2) }}</span> <br>
                                @if($invoice->total_discount!=0)
                                  <span><strong>Discount Total: </strong>Php {{ number_format($invoice->total_discount, 2) }}</span>
                                @endif
                              </div>
                            </div>
                          </li>
                        @else
                          <?php break; ?>
                        @endif
                        <?php $i++; ?>
                      @endforeach

                      @if(count($customer_invoice) > 0)
                        <li>
                          <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                      @endif
                    </ul>
                  </div>
                </div>

              </div>

              <!-- /.tab-pane -->
              <div class="tab-pane" id="logs">
                <div class="row">
                    <div class="col-xs-12">
                    <button class="btn btn-default" id="log_table_view"><i class="fa fa-table"></i></button>
                    <button class="btn btn-default" id="log_timeline_view"><i class="fa fa-clock-o"></i></button>
                  </div>
                </div>

                <br>

                <div class="row" id="log_table">
                  <div class="col-xs-12">
                    <table id="customer_log_table" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="50">#</th>
                          <th>Date</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($customer_logs as $log)
                          <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ date('F d, Y', strtotime($log->date)) }}</td>
                            <td>{{ date('h:m A', strtotime($log->start_time)) }}</td>
                            <td>{{ date('h:m A', strtotime($log->end_time)) }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="row" id="log_timeline">
                  <div class="col-xs-12">
                    <ul class="timeline timeline-inverse">
                      <?php $i = 0; ?>
                      @foreach($customer_logs as $log)
                        @if($i < 10)
                          <li class="time-label">
                              <span {!! $log==$customer_logs->first()? 'class="bg-red"':'' !!}>
                                {{ date('F d, Y', strtotime($log->date)) }}
                              </span>
                          </li>
                          
                          <li>
                            <i class="fa fa-sign-in bg-aqua"></i>

                            <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> {{ date('h:m A', strtotime($log->start_time)) }}</span>

                              <h3 class="timeline-header no-border"> Entered The Gym
                              </h3>
                            </div>
                          </li>
                          
                          @if($log->end_time!=null)
                            <li>
                              <i class="fa fa-sign-out bg-yellow"></i>

                              <div class="timeline-item">
                                <span class="time"><i class="fa fa-clock-o"></i> {{ date('h:m A', strtotime($log->end_time)) }}</span>

                                <h3 class="timeline-header no-border">Leaved The Gym 
                                </h3>
                              </div>
                            </li>
                          @endif
                        @else
                          <?php break; ?>
                        @endif
                        <?php $i++; ?>
                      @endforeach

                      @if(count($customer_logs) > 0)
                        <li>
                          <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                      @endif
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="profile">
                <form method="POST" enctype="multipart/form-data" class="form-horizontal">
                  {{ csrf_field() }}
                  {{ method_field('POST') }}
                  <div class="form-group">
                    <div class="col-xs-4 col-xs-offset-2">
                        <div class="image_preview">
                            <label for="image"><i class="fa fa-camera"></i></label>
                            <img src="{{ asset('dist/img/avatar/'.$customer->image) }}" class="prodImgPrev" id="prodImgPrev">
                        </div>
                        <input type="file" name="image" id="image" class="imgFile hidden" accept="image/x-png,image/gif,image/jpeg" style="display:none;" enctype="multipart/form-data">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="{{ $customer->first_name }}">
                      <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('first_name') }}</i></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="middle_name" class="col-sm-2 control-label">Middle Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="middle_name" placeholder="Middle Name" name="middle_name" value="{{ $customer->middle_name }}">
                      <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('middle_name') }}</i></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="{{ $customer->last_name }}">
                      <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('last_name') }}</i></div>
                    </div>
                  </div>
    
                  <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label">Gender</label>
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

                    <label for="email" class="col-sm-1 control-label">Email</label>
                    <div class="col-xs-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                            <input type="email" class="form-control" placeholder="Email Address" name="email_address" value="{{ $customer->email_address }}">
                        </div>
                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('email') }}</i></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="birthdate" class="col-sm-2 control-label">Birthdate</label>

                    <div class="col-xs-4">
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" placeholder="Birthday" name="birthdate" value="{{ $customer->birthdate? date('m/d/Y', strtotime($customer->birthdate)):'' }}">
                        </div>
                    </div>
            
                    <label for="contact_number" class="col-sm-1 control-label">Contact</label>
                    <div class="col-xs-5">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" placeholder="Mobile Number (09567108146)" name="contact_number" value="{{ $customer->contact_number }}">
                        </div>
                        <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('contact_number') }}</i></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" placeholder="Home Address" name="home_address" value="{{ $customer->home_address }}">
                      <div class="input_error" style="color:#b71c1c;"><i>{{ $errors->first('home_address') }}</i></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" class="btn btn-danger" value="Update">
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
@endsection

@section('js')
  <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
      //Date picker
      $('#datepicker').datepicker({
          autoclose: true,
      });

      $(document).ready(function(){
        $('#log_timeline').hide();
        $('#purchase_timeline').hide();
        $('#service_timeline').hide();

        $('#service_table_view').on('click', function() {
          $('#service_table').show();
          $('#service_timeline').hide();
        });

        $('#service_timeline_view').on('click', function() {
          $('#service_table').hide();
          $('#service_timeline').show();
        });

        $('#log_table_view').on('click', function() {
          $('#log_table').show();
          $('#log_timeline').hide();
        });

        $('#log_timeline_view').on('click', function() {
          $('#log_table').hide();
          $('#log_timeline').show();
        });

        $('#purchase_table_view').on('click', function() {
          $('#purchase_table').show();
          $('#purchase_timeline').hide();
        });

        $('#purchase_timeline_view').on('click', function() {
          $('#purchase_table').hide();
          $('#purchase_timeline').show();
        });

        $('#customer_service_table').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        });

        $('#customer_purchase_table').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        });

        $('#customer_log_table').DataTable({
          'paging'      : true,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
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
