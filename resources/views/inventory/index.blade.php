@extends('layouts.master')

@section('title')
    ClausenFitness | Inventory
@endsection

@section('css')
    <!-- custom CSS for employee -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Inventory
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Inventory</li>
        </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          {!! Session::get('message') !!}

          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Inventory List</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/inventory/add" class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; Add New Inventory</a>
              <table id="inventory_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="10">#</th>
                    <th>Product</th>
                    <th width="150">Date</th>
                    <th>Quantity</th>
                    <th>Stockout</th>
                    <th>Unit Price</th>
                    <th>Supplier</th>
                    <th width="150">Remarks</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($inventories as $inventory)
                    <tr>
                      <td>{{ $inventory->id }}</td>
                      <td>{{ $inventory->product->product_name }}</td>
                      <td>{{ date('F d, Y h:m A', strtotime($inventory->created_at)) }}</td>
                      <td>{{ $inventory->quantity }}</td>
                      <td>{{ $inventory->stockout_quantity }}</td>
                      <td>Php {{ number_format($inventory->unit_price, 2) }}</td>
                      <td>{{ $inventory->supplier->supplier_name }}</td>
                      <td>{{ $inventory->remarks }}</td>
                      <td>
                        @if(date('Y-m-d') <= date('Y-m-d', strtotime($inventory->created_at.' 1 days')))
                          <a href="/inventory/edit?id={{ $inventory->id }}"><i class="ion ion-compose"></i> Edit</a> | 
                        @endif
                        <a href="/inventory/stockout?id={{ $inventory->id }}"><i class="fa fa-sign-out"></i> Stockout</a>
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
    $('#inventory_table').DataTable({
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