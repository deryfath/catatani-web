@extends('layouts.app-template')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
         <!-- li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li -->
        <!-- <li class="active">Dashboard</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 id="purchase_order_count">0</h3>

              <p>Transaksi Pembelian</p>
            </div>
            <div class="icon">
              <i class="fa fa-cart-arrow-down"></i>
            </div>
            <a href="{{ url('purchase') }}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 id="product_count">0</h3>

              <p>Varian Produk</p>
            </div>
            <div class="icon">
              <i class="ion ion-cube"></i>
            </div>
            <a href="{{ url('product') }}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 id="vendor_count">0</h3>

              <p>Total Petani</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('vendors') }}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 id="comodity_count">0</h3>

              <p>Produk Habis</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('inventory/comodity') }}" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <div class="row">
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Stok Komoditas Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <div id="product_stock_chart"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header">Rp <span id="purchase_order_transaction_total"> 0</span></h5>
                    <span class="description-text">TOTAL TRANSAKSI PEMBELIAN</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header"><span id="total_komoditas_transaction_total"> 0</span> Kg</h5>
                    <span class="description-text">TOTAL KOMODITAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <h5 class="description-header">Rp 24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
       </div>



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 @endsection
