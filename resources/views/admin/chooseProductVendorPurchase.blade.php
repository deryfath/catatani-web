@extends('layouts.app-template')

@section('content')

     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><b>
            Pilih Komoditas Vendor
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
                        
                            <button class="btn btn-primary add-comodity-purchase"><i class="glyphicon glyphicon-plus"></i> Tambah Komoditas</button>
                            <button class="btn btn-primary add-vendor-purchase"><i class="glyphicon glyphicon-plus"></i> Tambah Petani</button>
                            <div class="cart-purchase pull-right">
                                 <div class="item" style=" position:relative;display:inline-block;">
                                        <a href="#"><span class="notify-badge" id="badge_purchase_cart" style="position: absolute;right:-14px;top:-12px;background:red;text-align: center;border-radius: 30px 30px 30px 30px;color:white;padding:5px 10px;font-size:12px;">0</span>
                                          <button class="btn btn-success pull-right" onclick="this.disabled=true;this.value='Sending, please wait...';" id="nextProductVendorPurchase"><i class="glyphicon glyphicon-shopping-cart" style="font-size:20px;"></i></button>
                                      </a>
                                </div>
                            </div>
                            
                        </div>
                       <div class="panel-body">
                            
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label for="vendor_purchase">Pilih Petani</label>
                                        <select id="vendor_purchase" class="form-control" style="width: 24%;">
                                          
                                        </select>
                                    </div>
                                </div>
                            </div>
                        

                            <div class="row">
                                <div class="form-group">
                                    <div class="searchable-container" id="product_vendor_purchase">


                                    </div>
                                </div>
                            </div>

                            
                        </div>

                    </div>
                </div>
              </div>

           </div> 
        </section>
    </div>

    <div id="productVendorPurchaseModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="text-align:center;" id="product_vendor_purchase_title"></h4>
          </div>
          <div class="modal-body">

                 <form action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Harga (/Kg)</label>
                        <input type="text" id="product_vendor_purchase_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Kuantitas (Kg) </label>
                        <input class="form-control" type="number" id="product_vendor_purchase_quantity" value="1" />
                    </div>
                    <div class="form-group">
                        <label for="address">Barcode ID </label>
                        <input class="form-control" id="product_vendor_purchase_barcode" />
                    </div>
                    <div class="form-group">
                        <label for="address">Lokasi Penyimpanan </label>
                        <input class="form-control" id="product_vendor_purchase_location"/>
                    </div>
                    <!-- <div class="form-group" style="text-align: center;">
                        <label for="address">Rating</label>
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
                </form>
          </div>

          <div class="modal-footer">
               <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';" id="submitProductVendorPurchase" class="btn btn-primary submit_product_vendor" >Beli</button>
                <button  id="cancelProductVendorPurchase" class="btn btn-default" data-dismiss="modal">Batal</button>
          </div>
         
        </div>

      </div>
    </div>

     <div id="chooseProductVendorSuccessAdd" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><b>Notifikasi</b></h4>
          </div>
          <div class="modal-body" >
            Komoditas Berhasil Ditambahkan ke keranjang
          </div>

          <div class="modal-footer">
                <button  id="cancelProductVendor" class="btn btn-default" data-dismiss="modal">OK</button>
          </div>
         
        </div>

      </div>
    </div>

    <div id="chooseProductVendorFailed" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><b>Notifikasi</b></h4>
          </div>
          <div class="modal-body" >
            Harap pilih komoditas yang akan dibeli untuk melanjutkan.
          </div>

          <div class="modal-footer">
                <button  id="cancelProductVendor" class="btn btn-default" data-dismiss="modal">OK</button>
          </div>
         
        </div>

      </div>
    </div>

    

@endsection