@extends('layouts.app-template')

@section('content')
    
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Petani
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
                            <a href="#createVendorModal" data-toggle="modal" class="btn btn-primary add-vendor"><i class="glyphicon glyphicon-plus"></i> Tambah Baru</a>
                   
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
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Farm Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Action</th>
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

    <div id="createVendorModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create New Vendor</h4>
          </div>
          <div class="modal-body">

                 <form action="{{route('vendor.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="vendor_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_group">Grup</label>
                        <select id="vendor_group" name="vendor_group" class="form-control">
                            <option value="individual">Individual</option>
                            <option value="kelompok">Kelompok</option>
                            <option value="gapoktan">Gapoktan</option>
                            <option value="koperasi">Koperasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Nama Usaha</label>
                        <input type="text" name="vendor_farm" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" name="vendor_address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telp</label>
                        <input type="text" name="vendor_phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Luas Lahan</label>
                        <input type="text" name="vendor_area" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="vendor_email" class="form-control">
                    </div>
                    <div class="form-group" style="text-align:right;">
                        <button type="submit" class="btn btn-primary" >Add</button>
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
          </div>
         
        </div>

      </div>
    </div>

    <div id="updateVendorModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Vendor</h4>
          </div>
          <div class="modal-body">

                 <form action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="update_vendor_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_group">Grup</label>
                        <select id="update_vendor_group" name="vendor_group" class="form-control">
                            <option value="individual">Individual</option>
                            <option value="kelompok">Kelompok</option>
                            <option value="gapoktan">Gapoktan</option>
                            <option value="koperasi">Koperasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Nama Usaha</label>
                        <input type="text" id="update_vendor_farm" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <input type="text" id="update_vendor_address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telp</label>
                        <input type="text" id="update_vendor_phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Luas Lahan</label>
                        <input type="text" id="update_vendor_area" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="update_vendor_email" class="form-control">
                    </div>
                </form>
          </div>

          <div class="modal-footer">
               <button  id="updateVendor" class="btn btn-primary update_vendor" >Update</button>
                <button  class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

@endsection