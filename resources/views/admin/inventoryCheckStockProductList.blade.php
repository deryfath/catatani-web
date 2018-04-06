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
                
                <div id="smartwizard">
                  <ul>
                      <li><a href="#step-1">Step 1<br /><small>Cek Komoditas</small></a></li>
                      <li><a href="#step-2">Step 2<br /><small>Cek Pembayaran</small></a></li>
                      <li><a href="#step-3">Final Step<br /><small>Timbang</small></a></li>
                  </ul>

                  <div>
                      <div id="step-1" class="">
                          <img src="" id="image_product_detail" style="width: 100%;margin-top: 12px;">
                          <div class="form-group" id="form_radio_comodity">
                            <label for="exampleInputEmail1">Kualitas Komoditas</label>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_image_product_after_detail" id="optionsRadios1" value="Sesuai" checked="">
                                Sesuai
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_image_product_after_detail" id="optionsRadios2" value="Tidak Sesuai">
                                Tidak Sesuai
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_image_product_after_detail" id="optionsRadios4" value="option4">
                                Lainnya
                              </label>
                            </div>
                             <div class="form-group" id="div_image_comodity_other" style="display:none;">
                                <input type="text" class="form-control" id="other_comodity_value_quality">
                              </div>
                          </div>
                      </div>
                      <div id="step-2" class="">
                          <img id="image_package_detail" alt="" style="width: 100%;margin-top: 12px;">
                          <div class="form-group" id="form_radio_package">
                            <label for="exampleInputEmail1">Memo Pembayaran Produk</label>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_image_package_after_detail" id="optionsRadios1" value="Sesuai" checked="">
                                Sesuai
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_image_package_after_detail" id="optionsRadios2" value="Tidak Sesuai">
                                Tidak Sesuai
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_image_package_after_detail" id="optionsRadios4" value="option4">
                                Lainnya
                              </label>
                            </div>
                             <div class="form-group" id="div_image_package_other" style="display:none;">
                                <input type="text" class="form-control" id="other_package_value_quality">
                              </div>
                          </div>
                      </div>
                      <div id="step-3" class="">
                          <div class="form-group">
                              <label style="display:none;">Kuantitas : <span id="quantity_product_detail"></span> Kg</label>
                          </div>
                         
                          <div class="form-group">
                              <label >Kuantitas Produk Setelah penimbangan (Kg)</label>
                              <input type="text" class="form-control" id="quantity_product_after_detail">
                              <span id="error_qty" class="help-block" style="display:none;color: red;font-weight: bold;"><i class="fa fa-times-circle-o"></i> Kuantitas Tidak Boleh kosong</span>
                           </div>
                           <div class="form-group" id="form_radio">
                            <label for="exampleInputEmail1">Catatan Kualitas</label>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_product_after_detail" id="optionsRadios1" value="Biji Jagung Hancur" checked="">
                                Biji Jagung Hancur
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_product_after_detail" id="optionsRadios2" value="Biji Kopi Tidak Bagus">
                                Biji Kopi Tidak Bagus
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_product_after_detail" id="optionsRadios3" value="Biji Kopi Kering">
                                Biji Kopi Kering
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="quality_product_after_detail" id="optionsRadios4" value="option4">
                                Lainnya
                              </label>
                            </div>
                          </div>
                          <div class="form-group" id="div_other" style="display:none;">
                            <input type="text" class="form-control" id="other_value_quality">
                          </div>
                          <div class="form-group">
                             <button class="btn btn-primary" id="submit_check_stock">Konfirmasi</button>
                          </div>                      
                      </div>
                    
                  </div>
              </div>
                    
                
          </div>

          <div class="modal-footer">
               
                <button class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

@endsection