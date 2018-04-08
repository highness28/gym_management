@extends('layouts.master')

@section('title')
    ClausenFitness | Sales
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Sales
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Sales</li>
        </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          {!! Session::get('message') !!}
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Products Availed</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <table id="product_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th width="30">#</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th width="110">Discount Price</th>
                      <th width="20">Quantity</th>
                      <th>Subtotal</th>
                      <th>Invoice Total</th>
                      <th>Discount Total</th>
                      <th>Status</th>
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
                      <td>{{ $purchase->status == 1 ? 'Paid':'Unpaid' }}</td>
                      <td>{{ date('F d, Y h:m A', strtotime($purchase->created_at)) }}</td>
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
      $('#product_table').DataTable({
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