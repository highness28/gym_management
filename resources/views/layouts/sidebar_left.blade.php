<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/avatar/'.Auth::user()->image) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->first_name.' '.Auth::user()->middle_name.' '.Auth::user()->last_name}}</p>
          <a href="#"><i class="fa fa-key"></i>
            @if(Auth::user()->user_type == 0)
              Cashier
            @elseif(Auth::user()->user_type == 1)
              Trainer
            @elseif(Auth::user()->user_type == 2)
              Supervisor
            @elseif(Auth::user()->user_type == 3)
              Owner
            @elseif(Auth::user()->user_type == 4)
              Administrator
            @endif
          </a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li>
          <a href="/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li>
          <a href="/pos">
            <i class="ion ion-ios-calculator"></i> <span>POS</span>
          </a>
        </li>

        <li>
          <a href="/customer">
            <i class="fa fa-users"></i><span> Customer List</span>
          </a>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-tags"></i> <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/product"><i class="fa fa-list"></i> Product List</a></li>
            <li><a href="/inventory"><i class="fa fa-archive"></i> Inventory</a></li>
            <li><a href="/main_category"><i class="fa fa-tag"></i> Main Category</a></li>
            <li><a href="/sub_category"><i class="fa fa-tags"></i> Sub Category</a></li>
            <li><a href="/brand"><i class="fa fa-bookmark"></i> Brand</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-line-chart"></i> <span>Sales Monitoring</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/product_sales"><i class="ion ion-ios-calculator"></i> Product</a></li>
            <li><a href="/service_sales"><i class="fa fa-desktop"></i> Service</a></li>
          </ul>
        </li>
  
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i> <span>Mail</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="/mail"><i class="fa fa-circle-o text-red"></i>Inbox
                <span class="pull-right-container">
                  <span class="label label-primary pull-right">13</span>
                </span>
              </a>
            </li>
            <li><a href="/mail/compose"><i class="fa fa-circle-o text-red"></i>Compose</a></li>
            <li><a href="/mail/draft"><i class="fa fa-circle-o"></i>Draft</a></li>
            <li><a href="/mail/trash"><i class="fa fa-circle-o"></i>Trash</a></li>
          </ul>
        </li>
  
        <li class="treeview">
          <a href="#">
            <i class="ion ion-ios-list-outline"></i> <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/report/sales"><i class="fa fa-line-chart"></i> Sales Report</a></li>
            <li><a href="/report/inventory"><i class="fa fa-archive"></i> Inventory Report</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>Gym Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/gym_information"><i class="fa fa-circle-o text-aqua"></i> Gym Information</a></li>
            <li><a href="/branch"><i class="fa fa-circle-o text-aqua"></i> Branch</a></li>
            <li><a href="/employee"><i class="fa fa-circle-o text-aqua"></i> Employee</a></li>
            <li><a href="/session_fee"><i class="fa fa-circle-o text-aqua"></i> Session Fee</a></li>
            <li><a href="/membership_plan"><i class="fa fa-circle-o text-aqua"></i> Membership Plan</a></li>
          </ul>
        </li>
        
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o"></i> <span>Not Started</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Under Maintenance</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>For Testing</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Done</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>