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
              <h4 class="box-title">Services Availed</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

            <div class="box-body">
              <table id="service_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Customer Name</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Name</th>
                      <th width="200">Details</th>
                      <th>Days</th>
                      <th width="60">Price</th>
                      <th width="60">Total</th>
                      <th>Type</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($services as $service)
                    <tr>
                      <td>{{ $service[0] }}</td>
                      <td><a href="{{ url('/customer/'.$service[13]) }}">{{ $service[10] . ($service[11]? ' '.$service[11]:'') . ($service[12]? ' '.$service[12]:'') }}</a></td>
                      <td>{{ date('F d, Y', strtotime($service[1])) }}</td>
                      <td>{{ date('F d, Y', strtotime($service[2])) }}</td>
                      <td>{{ $service[3] }}</td>
                      <td>{{ $service[4] }}</td>
                      <td>{{ $service[5] }}</td>
                      <td>Php {{ number_format($service[6], 2) }}</td>
                      <td>Php {{ number_format($service[7], 2) }}</td>
                      <td>
                        @if($service[8]==0)
                          <span class="label label-info">Membership</span>
                        @elseif($service[8]==1)
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
        </div>
    </section>

@endsection
    
@section('js')
  <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
    $(function () {
      $('#service_table').DataTable({
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