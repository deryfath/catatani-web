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

                     @if (session('status'))
                            <div class="alert alert-success  alert-dismissable" id="success-alert" style="margin: 0px 14px;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                    <i class="fa fa-check"></i>&nbsp;&nbsp;
                                 {{ session('status') }}
                            </div>
                        @elseif (session('statusError'))
                            <div class="alert alert-warning  alert-dismissable" id="failed-alert" style="margin: 0px 14px;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                    <i class="fa fa-warning"></i>&nbsp;&nbsp;
                                 {{ session('statusError') }}
                            </div>
                        @endif
                         <div class="panel-body">
                   <div class="row">
                       <div class="col-md-6">
                           ID Pembelian<div id="purchase_stock_detail_id" style="font-weight:bold;font-size: xx-large;"></div>
                    
                       </div>
                       <div class="col-md-6" style="text-align: right;">
                         <div id="check_status" style="vertical-align: top;display: inline-block;text-align: center;width: 83px;position: absolute;margin-left: -30%;"></div>
                           
                       </div>
                   </div>
                    
                  </div> 

                  <div class="panel-body">
                    <p>Tanggal Pembelian&ensp;: <span id="date_order_stock_detail" style="font-weight:bold;"></span><p>
                    <p>Petani&ensp;: <span id="vendor_purchase_stock_detail" style="font-weight:bold;"></span><p>

                  </div>

                    <div class="panel-body">
                            <table class="table table-striped table-hover" style="width:100%" id="dataTables-detail-purchase-stock">
                                <thead>
                                    <tr>
                                        <th>Komoditas</th>
                                        <th>Harga</th>
                                        <th>Kuantitas</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th id="total_detail_purchase_stock"></th>
                                     
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

    <div id="checkStockModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Cek Stok Komoditas <span id="product_title_detail"></span></h4>
          </div>
          <div class="modal-body">

               
                <div class="form-group">
                  <label for="exampleInputEmail1">Kuantitas Produk : <span id="quantity_product_detail"></span> Kg</label>
                </div>
                <div class="row" style="margin-bottom: 22px;">
                  <div class="col-md-6" style="text-align: center;">
                    <label style="width: 100%;" for="exampleInputEmail1">Foto Produk  </label>
                    <img id="image_product_detail" alt="">
                  </div>
                  <div class="col-md-6" style="text-align: center;">
                    <label style="width: 100%;" for="exampleInputEmail1">Foto Kemasan</label>
                    <img id="image_package_detail" alt="">
                  </div>
                </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kuantitas Produk Setelah penimbangan (Kg)</label>
                      <input type="text" class="form-control" id="quantity_product_after_detail">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Catatan Kualitas</label>
                      <input type="text" class="form-control" id="quality_product_after_detail">
                    </div>

                    <!-- <div class="form-group" style="text-align: center;">
                        <label for="address">Kualitas Produk setelah penimbangan</label>
                          <div class='rating-stars text-center'>
                            <ul id='stars'>
                              <li class='star' title='Poor' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                              <li class='star' title='Fair' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                              <li class='star' title='Good' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                              <li class='star' title='Excellent' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                              <li class='star' title='WOW!!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                            </ul>
                          </div>
                    </div> -->
                  
                  
                 
                
          </div>

          <div class="modal-footer">
                <button  class="btn btn-primary" id="submit_check_stock">Submit</button>
                <button  class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

@endsection