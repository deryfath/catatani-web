@extends('layouts.app-template')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="page-header-custom">
            Komoditas Petani
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
                            <button  class="btn btn-primary add-vendor-product"><i class="glyphicon glyphicon-plus"></i> Tambah Komoditas Petani</button>
                            <input type="search" class="pull-right" id="search" placeholder="Cari Komoditas.." >
                        </div>
                        
                        @if (session('status'))
                            <div class="alert alert-success  alert-dismissable" style="margin: 0px 14px;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                    <i class="fa fa-check"></i>&nbsp;&nbsp;
                                 {{ session('status') }}
                            </div>
                        @elseif (session('statusError'))
                            <div class="alert alert-warning  alert-dismissable" style="margin: 0px 14px;" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                    <i class="fa fa-warning"></i>&nbsp;&nbsp;
                                 {{ session('statusError') }}
                            </div>
                        @endif
                        <div class="panel-body" style="margin-top: -22px;">

                                <div class="row">
                                  <div class="form-group">
                                    <div class="searchable-container" id="vendor_product_card_row"></div>
                                  </div>
                                   
                                </div>
                                <!--/row-->
                        </div>

                    </div>
                </div>
              </div>

           </div> 
        </section>
    </div>

    <div id="updateProductVendorModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Product</h4>
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
               <button  id="updateVendorProduct" class="btn btn-primary update_product" >Update</button>
                <button  class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

    <div class="modal fade" id="confirm-delete-product-vendor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <b>Notifikasi</b>
                </div>
                <div class="modal-body">
                    Apakah yakin menghapus komoditi Petani ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger btn-ok-vendor-product" id="confirmDeleteProductVendor">Hapus</a>
                </div>
            </div>
        </div>
    </div>

@endsection