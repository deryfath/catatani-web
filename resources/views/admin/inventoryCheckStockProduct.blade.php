@extends('layouts.app-template')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="page-header-custom">
            Terima Barang
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

                          <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Cari Berdasarkan ID Pembelian</a></li>
                              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Cari Berdasarkan Agen Pembeli</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                                   <div class="form-group">
                                        <label for="name">Masukan ID pembelian</label>
                                        <input type="text" id="stock_check_id" class="form-control" style="width: 29%;" required>
                                    </div>
                                    
                                    <div class="form-group" style="    margin-top: 16px;">
                                        <button  id="searchStockCheck" class="btn btn-primary" >Cek</button>
                                    </div>
                              </div>
                               <!-- /.tab-pane -->
                               <div class="tab-pane" id="tab_2">
                                    <div class="form-group">
                                        <label for="name">Pilih Agen</label>
                                        <select id="vendor_purchase_inventory" class="form-control" style="width: 24%;">
                                          
                                        </select>
                                    </div>
                                    
                                    <div class="form-group" style="    margin-top: 16px;">
                                        <button  id="searchStockVendorCheck" class="btn btn-primary" >Cek</button>
                                    </div>
                              </div>
                             
                              <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                          </div>

                           

                                
                        </div>

                    </div>
                </div>
              </div>

           </div> 
        </section>
    </div>

    

     <div class="modal fade" id="modal_warning">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Notifikasi</h4>
              </div>
              <div class="modal-body">
                <p>Pembelian Tidak Ditemukan</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
   

@endsection