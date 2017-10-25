@extends('layouts.app-template')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="page-header-custom">
            Komoditas 
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

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Komoditas</a></li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Proses</a></li>
                                        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Hasil</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="home" >
                                            <table width="100%" class="table table-striped table-bordered table-hover table-inventory" id="dataTables-inventory-comodity">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal Pembelian</th>
                                                        <th>Petani</th>
                                                        <th>Asal Daerah</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Total</th>
                                                        <th>Kualitas</th>
                                                    </tr>
                                                </thead>
                                                
                                            </table>

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="profile">
                                          <table width="100%" class="table table-striped table-bordered table-hover table-inventory-process" id="dataTables-inventory-comodity-process">
                                                <thead>
                                                    <tr>
                                                        <th>Jumlah Awal (Kg)</th>
                                                        <th>Jumlah Setelah Cuci (Kg)</th>
                                                        <th>Jumlah Setelah Kering (Kg)</th>
                                                        <th>Proses</th>
                                                        <th>Jumlah Akhir (Kg)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                
                                            </table>

                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="messages">
                                            <table width="100%" class="table table-striped table-bordered table-hover table-inventory-result" id="dataTables-inventory-comodity-result">
                                                <thead>
                                                    <tr>
                                                        <th>Proses</th>
                                                        <th>Grade 1(Kg)</th>
                                                        <th>Grade 2(Kg)</th>
                                                        <th>Grade 3(Kg)</th>
                                                        <th>Grade 4(Kg)</th>
                                                        <th>Grade 5(Kg)</th>
                                                        <th>Grade 6(Kg)</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                            
                                        </div>
                                    </div>
                            
                        </div>

                    </div>
                </div>
              </div>

           </div> 
        </section>
    </div>

    <div id="updateVendorComodityProcessModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Produk</h4>
          </div>
          <div class="modal-body">

                 <form action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Proses</label>
                        <input type="text" id="update_vendor_process_process" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Jumlah Awal (Kg)</label>
                        <input type="text" id="update_vendor_process_qty" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Jumlah Setelah Cuci (Kg)</label>
                        <input type="text" id="update_vendor_process_jc" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Jumlah Setelah Kering (Kg)</label>
                        <input type="text" id="update_vendor_process_jk" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Jumlah Akhir (Kg)</label>
                        <input type="text" id="update_vendor_process_final" class="form-control">
                    </div>
                </form>
          </div>

          <div class="modal-footer">
               <button  id="updateVendorProcess" class="btn btn-primary update_vendor_process" >Update</button>
                <button  class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

    <div id="updateVendorComodityResultModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Hasil Produk</h4>
          </div>
          <div class="modal-body">

                 <form action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Proses</label>
                        <input type="text" id="update_vendor_result_process" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Grade 1 (Kg)</label>
                        <input type="text" id="update_vendor_result_grade1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Grade 2 (Kg)</label>
                        <input type="text" id="update_vendor_result_grade2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Grade 3 (Kg)</label>
                        <input type="text" id="update_vendor_result_grade3" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Grade 4 (Kg)</label>
                        <input type="text" id="update_vendor_result_grade4" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Grade 5 (Kg)</label>
                        <input type="text" id="update_vendor_result_grade5" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Grade 6 (Kg)</label>
                        <input type="text" id="update_vendor_result_grade6" class="form-control">
                    </div>
                    
                </form>
          </div>

          <div class="modal-footer">
               <button  id="updateVendorResult" class="btn btn-primary update_vendor_result" >Update</button>
                <button  class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

@endsection