@extends('layouts.master')

@section('title')
	ClausenFitness | Customer
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
	<section class="content-header">
        <h1>
            Customer
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Customer</li>
        </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          {!! Session::get('message') !!}
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Customer List</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/customer/add" class="btn-sm btn-success"><i class="fa fa-user"></i>&nbsp; Add New Customer</a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Birthdate</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($customers as $customer)
                    <tr>
                      <td>
                        <a href="/customer/{{ $customer->slug }}">
                          <img src="{{ asset('dist/img/avatar/'.$customer->image) }}" alt="Customer" style="max-height:70px; max-width:70px; ">
                        </a>
                      </td>
                      <td>
                        {{ $customer->first_name . ' ' }}
                        {{ $customer->middle_name? $customer->middle_name:'' . ' ' }}
                        {{ $customer->last_name }}
                      </td>
                      <td>{{ $customer->gender==0? 'Male':'Female' }}</td>
                      <td>{{ $customer->birthdate!=null? date('F d, Y', strtotime($customer->birthdate)):'' }}</td>
                      <td>{{ $customer->email_address }}</td>
                      <td>{{ $customer->home_address }}</td>
                      <td>{{ $customer->contact_number }}</td>
                      <td>
                        <a href="/customer/{{ $customer->slug }}"><i class="ion ion-search"></i> View</a>
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>         
          </div>
        </div>
    </section>

@endsection
	
@section('js')
  <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
      $('#example1').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      });
    });
  </script>
@endsection