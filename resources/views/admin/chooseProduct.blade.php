@extends('layouts.app-template')

@section('content')

     <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Pilih Komoditas
          </h1>
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
                            
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="search" class="form-control" id="search" placeholder="Search Product..">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group">
                                    <div class="searchable-container" id="product_vendor_container">
                                    <input type="hidden" id="vendorId" value="{{ session('vendor_id') }}" class="form-control">


                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="form-group">
                                        <div class="col-sm-12 col-md-12 col-lg-12" style="text-align:right;margin-top:10px;">
                                            <button class="btn btn-primary" id="nextProductVendor">Next</button>
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

    <div id="productVendorModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Komoditas Vendor</h4>
          </div>
          <div class="modal-body">

                 <form action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Harga</label>
                        <input type="text" id="product_vendor_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Asal Produk</label>
                        <input type="text" id="product_vendor_origin" class="form-control">
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="address">Plant Date</label>
                        <input type="text" id="product_vendor_plant" name="product_vendor_plant" class="form-control">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="phone">Harvest Date</label>
                        <input type="text" id="product_vendor_harvest" name="product_vendor_harvest" class="form-control">
                    </div>
                </form>
          </div>

          <div class="modal-footer">
               <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';" id="submitProductVendor" class="btn btn-primary submit_product_vendor" >submit</button>
                <button  id="cancelProductVendor" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

     <div id="productVendorModalSuccess" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Komoditas Vendor</h4>
          </div>
          <div class="modal-body" id="body_success">

          </div>

          <div class="modal-footer">
                <button  id="cancelProductVendor" class="btn btn-default" data-dismiss="modal">OK</button>
          </div>
         
        </div>

      </div>
    </div>

    <div id="productVendorModalFailed" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Komoditas Vendor</h4>
          </div>
          <div class="modal-body body-failed" id="body_failed">

          </div>

          <div class="modal-footer">
                <button  id="cancelProductVendor" class="btn btn-default" data-dismiss="modal">OK</button>
          </div>
         
        </div>

      </div>
    </div>

@endsection