@extends('layouts.master')

@section('title')
    ClausenFitness | Employee
@endsection

@section('css')
    <!-- custom CSS for employee -->
  <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Employee
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Employee</li>
        </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          {!! Session::get('message') !!}

          <div class="box box-primary">
            <div class="box-header with-border">
              <h4 class="box-title">Employee List</h4>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <a href="/employee/add" class="btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; Add New Employee</a>
              <table id="employee-list" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($employees as $employee)
                    <tr>
                      <td>
                        <a href="/employee/edit?id={{ $employee->id }}">
                          <img src="{{ asset('dist/img/avatar/'.$employee->image) }}" alt="Employee" style="width: 100px">
                        </a>
                      </td>
                      <td>
                        {{ $employee->first_name . ' ' }}
                        {{ $employee->middle_name? $employee->middle_name:'' . ' ' }}
                        {{ $employee->last_name }}
                      </td>
                      <td>{{ $employee->gender==0? 'Male':'Female' }}</td>
                      <td>{{ $employee->email_address }}</td>
                      <td>{{ $employee->contact_number }}</td>
                      <td>
                        <a href="/employee/edit?id={{ $employee->id }}"><i class="ion ion-compose"></i> Edit</a>
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
    $('#employee-list').DataTable({
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