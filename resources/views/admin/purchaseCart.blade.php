@extends('layouts.app-template')

@section('content')
    
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><b>
            Review Pembelian
          </b></h1>
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
                                <button class="btn btn-success" onclick="this.disabled=true;this.value='Sending, please wait...';" id="confirmPurchase"><i class="glyphicon glyphicon-saved"></i> Konfirmasi</button>
                            </div>  
                        <div class="panel-body">
                            <table class="table table-striped table-hover" id="dataTables-cart-purchase">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <!-- <th>Kualitas</th> -->
                                        <th>Harga</th>
                                        <th>Kuantitas</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <!-- <th></th> -->
                                        <th></th>
                                        <th>Total</th>
                                        <th id="total_cart_purchase"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            
                           
                        </div>

                    </div>
                </div>
              </div>

           </div> 
        </section>
    </div>

    <div id="editCartPurchaseModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" style="text-align:center;" id="product_vendor_purchase_title"></h4>
          </div>
          <div class="modal-body">

                 <form action="">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Harga (/Kg)</label>
                        <input type="text" id="cart_purchase_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Kuantitas (Kg) </label>
                        <input class="form-control" type="number" id="cart_purchase_quantity" />
                    </div>
                    <!-- <div class="form-group" style="text-align: center;">
                        <label for="address">Rating</label>
                          <div class='rating-stars text-center'>
                            <ul id='stars'>
                              <li class='star' title='Poor' data-value='1'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                              <li class='star' title='Fair' data-value='2'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                              <li class='star' title='Good' data-value='3'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                              <li class='star' title='Excellent' data-value='4'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                              <li class='star' title='WOW!!!' data-value='5'>
                                <i class='fa fa-star fa-fw'></i>
                              </li>
                            </ul>
                          </div>
                    </div> -->
                </form>
          </div>

          <div class="modal-footer">
               <button type="submit" id="submitCartPurchase" class="btn btn-primary submit_product_vendor" >submit</button>
                <button  id="cancelCartPurchase" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
         
        </div>

      </div>
    </div>

@endsection