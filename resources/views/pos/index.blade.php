@extends('layouts.master')

@section('title')
	ClausenFitness | POS
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <style>
    .action-icon {
      font-size: 20px;
      cursor: pointer;
      color: #555;
    }

    .action-icon:hover {
      color: #999;
    }

    .product {
      width: 50px;
    }

    .product-add {
      cursor: pointer;
    }

    input::number {
      border: none;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }
  </style>
@endsection

@section('content')
	<section class="content-header">
        <h1>
            POS
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">POS</li>
        </ol>
    </section>

    <section class="content">
      <div class="row">
        {!! Session::get('message') !!}
        <div class="col-xs-5">
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
              <table id="product-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th width="10"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                    <tr>
                      <td>
                        <img src="{{ asset('dist/img/product/'.$product->image) }}" class="product product-add" data-value="{{ $product->id.'|'.$product->product_name.'|'.$product->selling_price }}" alt="Product">
                      </td>
                      <td>{{ $product->product_name }}</td>
                      <td>{{ number_format($product->selling_price, 2) }}</td>
                      <td><i class="fa fa-cart-plus action-icon product_add" data-value="{{ $product->id.'|'.$product->product_name.'|'.$product->selling_price }}"></i></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
  
        <form action="{{ url('/pos/add') }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('POST') }}
          <div class="col-xs-7">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h4 class="box-title">Order List <span id="customer_name"></span></h4>
                
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <!-- /.box-header -->
              
              <!-- customer -->
                <input type="hidden" id="customer_id" name="customer_id">
              <!-- / customer -->

              <div class="box-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Discounted Price</th>
                      <th>Subtotal</th>
                      <th width="10"></th>
                    </tr>
                  </thead>

                  <tbody id="order_list">
                    <tr>
                      <td colspan="4"><strong>Discounted Price:</strong></td>
                      <td colspan="2"><input type="number" id="total_discount" class="form-control" style="width: 60px; height: 30px" name="total_discount" value="0"></td>
                    </tr>
                    <tr>
                      <td colspan="4"><strong>Total:</strong></td>
                      <td colspan="2"><strong>Php 0.00</strong></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="co-xs-12">
              <span class="pull-left">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#select_customer"><i class="fa fa-users"></i> Select Customer</button>
                <input type="hidden" id="paid_value" name="paid_value" value="1">
                <button type="button" id="set_unpaid" class="btn btn-danger"> Set Unpaid</button>
              </span>
              <span class="pull-right">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i> Submit</button>
                <button type="button" id="clear" class="btn btn-danger"><i class="fa fa-ban"></i> Clear</button>
              </span>
            </div>
          </div>
        </form>
    </section>

    <section id="modals">
      <!-- remove product modal -->
      <div class="modal modal-info fade" id="remove_product_modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Message</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to remove <span id="remove_modal_product_name"></span>?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-dismiss="modal" id="remove_product_modal_yes">Yes</button>
              <button type="button" class="btn btn-outline" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>

      <!-- clear order list modal -->
      <div class="modal modal-info fade" id="clear_order_list_modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Message</h4>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to clear order list?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-dismiss="modal" id="clear_order_list_modal_yes">Yes</button>
              <button type="button" class="btn btn-outline" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>

      <!-- submit order list modal -->
      <div class="modal modal-danger fade" id="submit_order_list_error">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Message</h4>
            </div>
            <div class="modal-body">
              <p><span id="submit_order_list_error_message"></span></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- customer list modal -->
      <div class="modal modal-default fade" id="select_customer">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Customer List</h4>
            </div>
            <div class="modal-body">
              <table id="customer_list" class="table table-bordered table-striped">
                <thead>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Contact Number</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @foreach($customers as $customer)
                    <tr>
                      <td>{{ $customer->first_name . ($customer->middle_name? ' '.$customer->middle_name:'') . ($customer->last_name? ' '.$customer->last_name:'') }}</td>
                      <td>{{ $customer->gender==0? 'Male':'Female' }}</td>
                      <td>{{ $customer->contact_number }}</td>
                      <td><button type="button" class="btn btn-info btn-sm select_customer_button" data-value="{{ $customer->id.'|'.$customer->first_name . ($customer->middle_name? ' '.$customer->middle_name:'') . ($customer->last_name? ' '.$customer->last_name:'') }}"><i class="fa fa-user"></i> Select</button></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
	
@section('js')
  <script src="{{ asset('js/accounting.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
      var order_list_dictionary = {};
      var total_discount = 0;

      $('#customer_list').DataTable({
        'paging'      : false,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : false,
        'autoWidth'   : false
      });

      $('#product-table').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      });

      $(document).on('click', '#set_unpaid', function() {
        if($('#paid_value').val() === '1') {
          $(this).attr('class', 'btn btn-info').empty().append("Set Paid");
          $('#paid_value').val(0);
        }
        else {
          $(this).attr('class', 'btn btn-danger').empty().append("Set Unpaid");
          $('#paid_value').val(1)
        }
      });

      $(document).on('click', '.select_customer_button', function() {
        var customer = $(this).attr('data-value').split('|');
        $('#select_customer').modal('hide');
        $('#customer_id').val(customer[0]);
        $('#customer_name').empty().append('('+customer[1]+')');
      });

      $(document).on('click', '.product_add', function() {
        var product = $(this).attr('data-value').split('|');
        var found = false;

        $.each(order_list_dictionary, function(i, value) {
          if(value.id == product[0]) {
            found = true;
          }
        });

        if(!found) {
          order_list_dictionary[product[0]] = {
            'id': product[0],
            'name': product[1],
            'price': product[2],
            'discount': 0,
            'quantity': 1
          };
        }
        else {
          order_list_dictionary[product[0]].quantity = order_list_dictionary[product[0]].quantity + 1;
        }
        
        render_order_list();
      });

      $('form').submit(function(e) {
        var order_list_count = Object.keys(order_list_dictionary).length;
        var error = false;
        var error_message = '';

        if($('#customer_id').val()==0) {
          error = true;
          error_message += '<li>Please select a customer</li>';
        }
        if(order_list_count==0) {
          error = true;
          error_message += '<li>Please select a product first</li>';
        }

        if(error) {
          e.preventDefault();
          $('#submit_order_list_error_message').empty().append(error_message);
          $('#submit_order_list_error').modal('show');
        }
      });

      $(document).on('click', '.product_remove', function(e) {
        $('#remove_product_modal').modal('show');
        var id = $(this).attr('data-id');

        $('#remove_modal_product_name').empty().append(order_list_dictionary[id].name);

        $('#remove_product_modal').modal({
          backdrop: 'static',
          keyboard: false
        })
        .one('click', '#remove_product_modal_yes', function(e) {
          delete order_list_dictionary[id];

          var order_list_count = Object.keys(order_list_dictionary).length;
          if(order_list_count==0) {
            total_discount = 0;
          }

          render_order_list();
        });
      });

      $(document).on('click', '#clear', function() {
        var order_list_count = Object.keys(order_list_dictionary).length;

        if(order_list_count > 0) {
          $('#clear_order_list_modal').modal({
            backdrop: 'static',
            keyboard: false
          })
          .one('click', '#clear_order_list_modal_yes', function(e) {
            order_list_dictionary = {};
            total_discount = 0;
            render_order_list();
          });
        }
      });

      $(document).on('change', '.quantity', function(){
        if($(this).val() > 0) {
          order_list_dictionary[$(this).attr('data-id')].quantity = parseInt($(this).val());
        }
        else {
          order_list_dictionary[$(this).attr('data-id')].quantity = 1;
          $(this).val(1);
        }
        render_order_list();
      });

      $(document).on('change', '.discount', function(){
        if($(this).val()!='' && $(this).val() >= 0) {
          order_list_dictionary[$(this).attr('data-id')].discount = parseInt($(this).val());
        }
        else {
          order_list_dictionary[$(this).attr('data-id')].discount = 0;
          $(this).val(0);
        }
        render_order_list();
      });

      $(document).on('change', '#total_discount', function() {
        if($(this).val()!='' && $(this).val() >= 0) {
          total_discount = parseFloat($(this).val())
        }
        else {
          total_discount = 0;
          $(this).val(0);
        }
        render_order_list();
      });
      
      function render_order_list() {
        var order_list_table = $('#order_list');
        var total = 0;

        order_list_table.empty();
        $.each(order_list_dictionary, function(i, value) {
          total += parseFloat(((value.discount==0) || (isNaN(value.discount))? value.price:value.discount) * value.quantity);

          order_list_table.append('<tr>' +
                                    '<input type="hidden" name="product_id[]" value="'+value.id+'">' +
                                    '<input type="hidden" name="sub_total[]" value="'+(value.price * value.quantity)+'">' +
                                    '<td>'+value.name+'</td>' +
                                    '<td>'+accounting.formatMoney(value.price)+'</td>' +
                                    '<td><input type="number" class="form-control quantity" data-id="'+value.id+'" style="width: 60px; height: 30px" name="quantity[]" value="'+value.quantity+'"></td>' +
                                    '<td><input type="number" class="form-control discount" data-id="'+value.id+'" style="width: 60px; height: 30px" name="discount[]" value="'+value.discount+'"></td>' +
                                    '<td>'+accounting.formatMoney(parseFloat(((value.discount==0)? value.price:value.discount) * value.quantity))+'</td>' +
                                    '<td><i class="ion ion-android-remove-circle action-icon product_remove" data-id="'+value.id+'"></i></td>' +
                                  '</tr>');
        });

        order_list_table.append('<tr>' +
                                  '<td colspan="4"><strong>Discounted Price:</strong></td>' +
                                  '<td colspan="2"><input type="number" id="total_discount" class="form-control" style="width: 60px; height: 30px" name="total_discount" value="'+total_discount+'"></td>' +
                                '</tr>' +
                                '<tr>' +
                                  '<input type="hidden" name="total" value="'+total+'">' +
                                  '<td colspan="4"><strong>Total:</strong></td>' +
                                  '<td colspan="2"><strong>'+accounting.formatMoney(((total_discount == 0) ? total:total_discount))+'</strong></td>' +
                                '</tr>');
      }
    });
  </script>
@endsection