@extends('layouts.master')

@section('title')
	ClausenFitness | Dashboard
@endsection

@section('css')
	<!-- custom CSS for employee -->
@endsection

@section('content')
	<section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Membership</span>
              <span class="info-box-number">{{ number_format(1860) }}</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-person-stalker"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Trainee</span>
              <span class="info-box-number">{{ number_format(528) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-pie"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Monthly Sales</span>
              <span class="info-box-number">Php {{ number_format(36022, 2) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-tags"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Promo Avails</span>
              <span class="info-box-number">{{ number_format(245) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
    
      
      <div class="row">
        <div class="col-sm-12 col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Sales</h3>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                    <td>Amino 222</td>
                    <td>Php {{ number_format(12, 2) }}</td>
                    <td>3</td>
                    <td>Php {{ number_format(36, 2) }}</td>
                    <td><span class="label label-success">Paid</span></td>
                  </tr>

                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9841</a></td>
                    <td>Whey Protein</td>
                    <td>Php {{ number_format(12, 2) }}</td>
                    <td>1</td>
                    <td>Php {{ number_format(12, 2) }}</td>
                    <td><span class="label label-danger">Unpaid</span></td>
                  </tr>

                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9841</a></td>
                    <td>Whey Protein</td>
                    <td>Php {{ number_format(12, 2) }}</td>
                    <td>1</td>
                    <td>Php {{ number_format(12, 2) }}</td>
                    <td><span class="label label-success">Paid</span></td>
                  </tr>

                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9840</a></td>
                    <td>Vita Milk (Choco)</td>
                    <td>Php {{ number_format(25, 2) }}</td>
                    <td>1</td>
                    <td>Php {{ number_format(25, 2) }}</td>
                    <td><span class="label label-success">Paid</span></td>
                  </tr>

                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9839</a></td>
                    <td>Hydroxicat</td>
                    <td>Php {{ number_format(30, 2) }}</td>
                    <td>1</td>
                    <td>Php {{ number_format(30, 2) }}</td>
                    <td><span class="label label-success">Paid</span></td>
                  </tr>

                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9838</a></td>
                    <td>Vita Milk (Choco)</td>
                    <td>Php {{ number_format(25, 2) }}</td>
                    <td>2</td>
                    <td>Php {{ number_format(50, 2) }}</td>
                    <td><span class="label label-success">Paid</span></td>
                  </tr>

                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9838</a></td>
                    <td>Cobra Energy Drink</td>
                    <td>Php {{ number_format(20, 2) }}</td>
                    <td>1</td>
                    <td>Php {{ number_format(20, 2) }}</td>
                    <td><span class="label label-danger">Unpaid</span></td>
                  </tr>
                  
                  <tr>
                    <td><a href="pages/examples/invoice.html">OR9837</a></td>
                    <td>Fat Burner</td>
                    <td>Php {{ number_format(15, 2) }}</td>
                    <td>2</td>
                    <td>Php {{ number_format(30, 2) }}</td>
                    <td><span class="label label-success">Paid</span></td>
                  </tr>
                  
                  </tbody>
                </table>
              </div>
              
            </div>
            
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            
          </div>
        </div>
        
        <div class="col-sm-12 col-md-4">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Customer Registration</h3>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                @foreach($services as $service)
                  <li class="item">
                    <div class="product-img">
                      <img src="{{ asset('dist/img/avatar/'.$service[5]) }}" alt="Image">
                    </div>
                    <div class="product-info">
                      <a href="javascript:void(0)" class="product-title">{{ $service[2] . ($service[3]? ' '.$service[3]:'') . ($service[4]? ' '.$service[4]:'') }}</a>
                      @if($service[7]==0)
                        <span class="label label-info pull-right">Membership</span>
                      @elseif($service[7]==1)
                        <span class="label label-success pull-right">&nbsp&nbsp&nbspEntrance&nbsp&nbsp&nbsp</span>
                      @else
                        <span class="label label-danger pull-right">&nbsp&nbsp&nbsp&nbspTraining&nbsp&nbsp&nbsp&nbsp</span>
                      @endif
                      <span class="product-description">
                        {{ date('F d, m', strtotime($service[1])) . ' | ' . $service[0] }}
                      </span>
                    </div>
                  </li>
                @endforeach
              </ul>
            </div>
            
            <div class="box-footer text-center">
              <a href="{{ url('/service_sales') }}" class="uppercase">View All Customer Sales</a>
            </div>
            
          </div>
        </div>
      </div>
    </section>
@endsection
	
@section('js')

@endsection