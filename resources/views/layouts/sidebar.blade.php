  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

     
      <!--<div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>-->

      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li {{{ (Request::is('/') ? 'class=active' : '') }}}><a href="/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li {{{ (Request::is('purchase') ? 'class=active' : '') }}}><a href="{{ url('purchase') }}"><i class="fa fa-cart-arrow-down"></i> <span>Pembelian</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Persediaan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('inventory/comodity') }}"><i class="fa fa-archive fa-fw"></i>Komoditas</a></li>
            <li><a href="{{ url('inventory/stock') }}"><i class="fa fa-cube fa-fw"></i>Stok Barang</a></li>
            <li><a href="{{ url('inventory/check/stock') }}"><i class="fa fa-sign-in fa-fw"></i>Terima Barang</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-wrench"></i> <span>Kelola</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('product') }}"><i class="fa fa-cubes fa-fw"></i>Komoditas</a></li>
            <li><a href="{{ url('vendors') }}"><i class="fa fa-group fa-fw"></i>Petani</a></li>
            <li><a href="{{ url('agents') }}"><i class="fa fa-group fa-fw"></i>Pembeli</a></li>
          </ul>
        </li>
        <!-- <li><a href="{{ route('user-management.index') }}"><i class="fa fa-link"></i> <span>User management</span></a></li> -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>