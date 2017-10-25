@extends('layouts.app-template')

@section('content')

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Stok Barang
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

                            <table width="100%" class="table table-striped table-bordered table-hover table-stock-inventory" id="dataTables-stock-inventory-comodity">
                                <thead>
                                    <tr>
                                        <th>Komoditi</th>
                                        <th>Proses</th>
                                        <th>Grade 1</th>
                                        <th>Grade 2</th>
                                        <th>Grade 3</th>
                                        <th>Grade 4</th>
                                        <th>Grade 5</th>
                                        <th>Grade 6</th>
                                    </tr>
                                </thead>
                                
                            </table>
                                    
                            
                        </div>

                    </div>
                </div>
              </div>

           </div> 
        </section>
    </div>

@endsection