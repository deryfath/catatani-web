@extends('layouts.app-template')

@section('content')
    
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Persediaan Komoditas
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
                                    <div class="searchable-container" id="product_inventory_container">
                                    <!-- <input type="hidden" id="vendorId" value="{{ session('vendor_id') }}" class="form-control"> -->


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

@endsection