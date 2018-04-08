@extends('layouts.master')

@section('title')
    ClausenFitness | Product
@endsection

@section('css')
    <!-- custom CSS for employee -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Product</li>
        </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          {!! Session::get('message') !!}
          
          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Product List</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/product/add" class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; Add New Product</a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Sub Category</th>
                    <th>Main Category</th>
                    <th>Quantity</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td>
                        <a href="/product/edit?id={{ $product->id }}">
                          <img src="{{ asset('dist/img/product/'.$product->image) }}" alt="Product" style="width: 100%">
                        </a>
                      </td>
                      <td>{{ $product->product_name }}</td>
                      <td>{{ $product->selling_price }}</td>
                      <td>{{ $product->brand->brand_name }}</td>
                      <td>{{ $product->sub_category->sub_name }}</td>
                      <td>{{ $product->main_category->main_name }}</td>
                      <td>{{ $product->quantity }}</td>
                      <td><a href="/product/edit?id={{ $product->id }}"><i class="ion ion-compose"></i> Edit</a></td>
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