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

                                <div class="form-group">
                                    <label for="name">ID Pembelian</label>
                                    <input type="text" id="stock_check_id" class="form-control" required>
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label for="vendor_farm">Kuantitas Setelah Ditimbang (Kg)</label>
                                    <input type="text" id="stock_check_quantity" class="form-control" required>
                                </div>
                                <div class="form-group" style="display:none;">
                                    
                                </style>>
                                  <label >Kuantitas Setelah Ditimbang (Kg)</label>

                                   <div data-role="dynamic-fields">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <label class="sr-only" for="field-name">Nama Komoditas</label>
                                            <input type="text" class="form-control" id="comodity_name_purchase" placeholder="Nama Komoditas">
                                        </div>
                                        <span>-</span>
                                        <div class="form-group">
                                            <label class="sr-only" for="field-value">Kuantitas</label>
                                            <input type="text" class="form-control" id="quantity_purchase" placeholder="Kuantitas(Kg)">
                                        </div>
                                        <button class="btn btn-danger" data-role="remove">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        <button class="btn btn-primary" data-role="add">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </div>  
                                   </div>  
                                </div>
                                <div class="form-group" style="    margin-top: 16px;">
                                    <button  id="searchStockCheck" class="btn btn-primary" >Cek</button>
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