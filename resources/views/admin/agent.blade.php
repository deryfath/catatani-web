@extends('layouts.app-template')

@section('content')
    
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Pembeli
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
                            <a href="#createAgentModal" data-toggle="modal" class="btn btn-primary add-agent"><i class="glyphicon glyphicon-plus"></i> Tambah Pembeli</a>
                   
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success  alert-dismissable" id="success-alert-agent" style="margin: 0px 14px;" role="alert">
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-agent">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Username</th>
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

    <div id="createAgentModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Daftar Pembeli Baru</h4>
          </div>
          <div class="modal-body">

                 <form action="{{route('agent.store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="agent_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label >Username</label>
                        <input type="text" id="agent_username" name="agent_username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label >Password</label>
                        <input type="password" id="agent_password" name="agent_password" class="form-control">
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

    <div id="updateAgentModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Pembeli</h4>
          </div>
          <div class="modal-body">

                 <form action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" id="update_agent_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vendor_farm">Username</label>
                        <input type="text" id="update_agent_username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Password</label>
                        <input type="password" id="update_agent_password" class="form-control">
                        <input type="checkbox" onclick="showPasswordAgent()"> Show Password
                    </div>
                    
                </form>
          </div>

          <div class="modal-footer">
               <button  id="updateAgent" class="btn btn-primary update_agent" >Update</button>
                <button  class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

@endsection