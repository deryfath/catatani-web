@extends('layouts.app-template')

@section('content')
    
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><b>
            Detail Pembelian
          </b></h1>
          <ol class="breadcrumb">
            <!-- li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li-->
            <!-- <li class="active">User Mangement</li> -->
          </ol>
        </section>
        
        <!-- /.content -->
        <section class="content">
            <div class="box">
              <div class="box-header">
                <div class="row">
                    
                   
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <div class="row">
                    <div class="col-sm-12">
                         <div class="panel-body">
                            ID Pembelian<div id="purchase_detail_id" style="font-weight:bold;font-size: xx-large;"></div>
                            
                          </div> 

                          <div class="panel-body">
                            <p>Tanggal Pembelian&ensp;: <span id="date_order_detail" style="font-weight:bold;"></span><p>
                            <p>Petani&ensp;: <span id="vendor_purchase_detail" style="font-weight:bold;"></span><p>

                          </div>
  
                     
                        <div class="panel-body">
                            <table class="table table-striped table-hover" id="dataTables-detail-purchase">
                                <thead>
                                    <tr>
                                        <th>Komoditas</th>
                                        <th>Harga</th>
                                        <th>Kuantitas</th>
                                        <th>Subtotal</th>
                                       
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th id="total_detail_purchase"></th>
                                     
                                    </tr>
                                </tfoot>
                            </table>
                            
                           
                        </div>

                    </div>
                </div>
              </div>

           </div> 
        </section>
    </div>

@endsection