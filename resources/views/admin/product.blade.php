@extends('layouts.app-template')
@section('content')
    
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
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
                             <a href="#createProductModal" data-toggle="modal" class="btn btn-primary add-Product"><i class="glyphicon glyphicon-plus"></i> Tambah Baru</a>
                             <div class="input-group col-sm-3 pull-right">
                                  <span class="input-group-addon">
                                      <i class="glyphicon glyphicon-search"></i>
                                  </span>
                                  <input type="text" id="search" class="form-control" placeholder="Cari Komoditas..."/>
                              </div>
                        </div>
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
                        <div class="panel-body" style="margin-top: -22px;">

                                <div class="row">
                                  <div class="form-group">
                                    <div class="searchable-container" id="product_card_row"></div>
                                  </div>
                                   
                                </div>
                                
                        </div>

                    </div>
                </div>
              </div>

           </div> 
        </section>
    </div>

    <div id="createProductModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Product</h4>
          </div>
          <div class="modal-body">

                <input type="hidden" name="count" value="1" />
        
                 <form enctype="multipart/form-data" action="{{route('productModel.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="product_name" class="form-control" required>
                    </div>
                     <div class="form-group">
                        <label for="product_category_create">Kategori</label>
                        <select id="product_category_create" name="product_category" class="form-control">
                            <option value="cherry">Cherry</option>
                            <option value="green beans">Green Beans</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <input type="text" name="other_category" style="display:none;margin-top:10px;" class="form-control" id="other_category">
                    </div>
                    <div class="form-group">
                        <label>Pilih Image</label>
                        <input type="file" name="product_image" id="product_file_image_create" required>

                        <img id="product_image_create" src="http://placehold.it/512x512" style="margin-top:10px;width:23%;" />
                    </div>

                    
                    <div class="form-group" style="text-align:right;">
                        <button type="submit" class="btn btn-primary" >Tambah</button>
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
                    </div>
                </form>
          </div>
         
        </div>

      </div>
    </div>

    <div id="updateProductModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Product</h4>
          </div>
          <div class="modal-body">

                 <form enctype="multipart/form-data" action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="product_name" name="product_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="product_category_update">Kategori</label>
                        <select id="product_category_update" class="form-control">
                            <option value="cherry">Cherry</option>
                            <option value="green beans">Green Beans</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <input type="text" id="other_category_update" style="display:none;margin-top:10px;" class="form-control" >
                   
                    </div>
                    <div class="form-group">
                        <label>Choose Image</label>
                        <input type="file" name="product_file_image" id="product_file_image">
                        
                        <img id="product_image" style="margin-top:10px;" />

                    </div>
                    
                </form>
          </div>

          <div class="modal-footer">
               <button  id="updateProduct" class="btn btn-primary update_product" >Update</button>
                <button  class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

    <div class="modal fade" id="confirm-delete-product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <b>Notifikasi</b>
                </div>
                <div class="modal-body">
                    Apakah yakin menghapus komoditi ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger btn-ok" id="confirmDeleteProduct">Hapus</a>
                </div>
            </div>
        </div>
    </div>

@endsection