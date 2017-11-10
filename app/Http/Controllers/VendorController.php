<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Odoo;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Http\Request;
use Ripcord\Ripcord as RipcordBase;

class VendorController extends Controller
{

	/**
     * @var string
     */
    protected $url;
    
    /**
     * @var string
     */
    protected $db;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;
    /**
     * @var int
     */
    protected $uid;


    public function __construct($config = [])
    {

        $this->url = isset($config['url']) ? $config['url'] : config('ripcord.url');
        $this->db = isset($config['db']) ? $config['db'] : config('ripcord.db');
        $this->username = isset($config['user']) ? $config['user'] : config('ripcord.user');
        $this->password = isset($config['password']) ? $config['password'] : config('ripcord.password');

        $this->connect();
    }

    
    public function connect()
    {

    	$logger = new Logger('get_connect_2');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $common = RipcordBase::client($this->url."/xmlrpc/2/common");

        $this->uid = $common->authenticate($this->db, $this->username, $this->password, []);

        $logger->info($this->uid);	      	

     }


     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $data = $models->execute_kw($this->db, $this->uid, $this->password,'res.partner','search_read', array(array(array('supplier', '=', true))),array('fields'=>array('name','street','phone','email','x_farm_name','x_farm_group','x_farm_area')));
        
        for ($i=0; $i < count($data); $i++) { 
      		$data[$i]['action'] = '<button style="margin-right:10px;" data-id="'.$data[$i]['id'].'" data-farm="'.$data[$i]['x_farm_name'].'" data-group="'.$data[$i]['x_farm_group'].'" data-area="'.$data[$i]['x_farm_area'].'" data-name="'.$data[$i]['name'].'" data-phone="'.$data[$i]['phone'].'" data-email="'.$data[$i]['email'].'" data-address="'.$data[$i]['street'].'" class="btn btn-xs btn-primary edit-vendor"><i class="glyphicon glyphicon-edit"></i> Edit</button><button style="margin-right:10px;" class="btn btn-xs btn-danger delete-vendor" data-id="'.$data[$i]['id'].'"><i class="glyphicon glyphicon-trash"></i> Delete</button><button class="btn btn-xs btn-warning product-vendor" data-id="'.$data[$i]['id'].'" data-name="'.$data[$i]['name'].'"><i class="glyphicon glyphicon-th-large"></i> Product</button>';
        }

        return response()->json(array('data'=> $data), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$logger = new Logger('insertVendor');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $name = $request->input('vendor_name');
        $email = $request->input('vendor_email');
        $phone = $request->input('vendor_phone');
        $address = $request->input('vendor_address');
        $farm = $request->input('vendor_farm');
        $group = $request->input('vendor_group');
        $area = $request->input('vendor_area');

        $logger->info('Foo '.$name);

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $id = $models->execute_kw($this->db, $this->uid, $this->password,'res.partner', 'create',array(array('name'=>$name,'street'=>$address, 'phone'=>$phone, 'email'=>$email, 'x_farm_name'=>$farm, 'x_farm_group'=>$group, 'x_farm_area'=>$area, 'supplier'=>true)));

        return redirect('/choose/product?vendor_id='.$id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProductVendor(Request $request)
    {

    	$logger = new Logger('insertProductVendor');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $productId = $request->input('productId');
        $vendorId = $request->input('vendorId');
        $price = $request->input('price');
        $origin = $request->input('origin');

        $plant = $request->input('plant');

        if($plant!=null){
        	
	        $plantExp = explode(" - ", $plant);
	       	
        }else{
        	$plantExp[0] = false;
        	$plantExp[1] = false;
        }

        $harvest = $request->input('harvest');

        if($harvest!=null){
	        $harvestExp = explode(" - ", $harvest);

        }else{
        	$harvestExp[0] = false;
	        $harvestExp[1] = false;
        }

        

        $logger->info('Foo '.$productId);

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $id = $models->execute_kw($this->db, $this->uid, $this->password,'product.supplierinfo', 'create',array(array('name' => $vendorId, 'min_qty' => 0, 'delay' => 1, 'price' => $price, 'product_tmpl_id' => $productId, 'product_code' => '', 'x_product_origin'=>$origin, 'x_tanggal_awal_tanam'=>$plantExp[0],'x_tanggal_akhir_tanam'=>$plantExp[1],'x_tanggal_awal_panen'=>$harvestExp[0],'x_tanggal_akhir_panen'=>$harvestExp[1])));

        // $data = $models->execute_kw($this->db, $this->uid, $this->password,'product.supplierinfo','search_read', array(array(array('name', '=', $vendorId))),array('fields'=>array('product_tmpl_id')));
        
        return response()->json(array('data'=> $id), 200);

    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getVendorProduct(Request $request)
    {

    	$logger = new Logger('ProductVendor');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

    	$vendorId = (int)$request->input('vendorId');

    	$logger->info('ARR '.$vendorId);

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $data = $models->execute_kw($this->db, $this->uid, $this->password,'product.supplierinfo','search_read', array(array(array('name', '=', $vendorId))),array('fields'=>array('name','product_tmpl_id','price','x_tanggal_awal_tanam','x_tanggal_akhir_tanam','x_tanggal_awal_panen','x_tanggal_akhir_panen','x_product_origin')));
        
        $productArr = array();

        for ($i=0; $i < count($data); $i++) { 
        	
    		$product = $models->execute_kw($this->db, $this->uid, $this->password,'product.product', 'search_read',array(array(array('id', '=', $data[$i]['product_tmpl_id'][0]))),array('fields'=>array('name', 'seller_ids','qty_available','image_medium','type','x_kategori_produk'))); 

        	$data[$i]['product_detail'] = $product;
        	
        }

        $logger->info('ARR '.var_export($data,true));

        return response()->json(array('data'=> $data), 200);
    }

    /**
     * delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteVendorProduct(Request $request){

    	$logger = new Logger('delete_vendor_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $logger->info('Foo '.$request->input('id'));

        $supplierId = $request->input('supplier_id');
        $supplierProduct = $request->input('supplier_product');
        $productId = $request->input('product_id');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");

        //check product in purchase order line
        $data = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order.line','search_read', array(array(array('product_id', '=', $productId),array('partner_id', '=', $supplierId))),array());

        if(count($data)==0){
            $response = $models->execute_kw($this->db, $this->uid, $this->password,'product.supplierinfo', 'unlink',array(array($supplierProduct)));
            $request->session()->flash('status', 'Komoditi Petani Berhasil Dihapus!');
        }else{
            $request->session()->flash('statusError', 'Gagal menghapus komoditi Petani yang sudah masuk proses Transaksi Pembelian');
            $response = "false";
        }
        
        // $logger->info('Foo '.$response);

        return response()->json(array('data'=> $response), 200);
    }

    /**
     * delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteVendorProductChoose(Request $request){

        $logger = new Logger('delete_vendor_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $logger->info('Foo '.$request->input('id'));

        $supplierId = $request->input('supplier_id');
        $supplierProduct = $request->input('supplier_product');
        $productId = $request->input('product_id');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");

        //check product in purchase order line
        $response = $models->execute_kw($this->db, $this->uid, $this->password,'product.supplierinfo', 'unlink',array(array($supplierProduct)));
        
        // $logger->info('Foo '.$response);

        return response()->json(array('data'=> $response), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateVendorProduct(Request $request){

    	$logger = new Logger('update_vendor_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $id = $request->input('id');
        $price = $request->input('price');
        $plant = $request->input('plant');
        $origin = $request->input('origin');

        if($plant!=null){
            
            $plantExp = explode(" - ", $plant);
            
        }else{
            $plantExp[0] = false;
            $plantExp[1] = false;
        }
        $harvest = $request->input('harvest');
        if($harvest!=null){
            $harvestExp = explode(" - ", $harvest);

        }else{
            $harvestExp[0] = false;
            $harvestExp[1] = false;
        }


        $logger->info('PRICE '.$price);
        
        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.supplierinfo', 'write',array(array($id), array('price'=>$price, 'x_product_origin'=>$origin, 'x_tanggal_awal_tanam'=>$plantExp[0],'x_tanggal_akhir_tanam'=>$plantExp[1],'x_tanggal_awal_panen'=>$harvestExp[0],'x_tanggal_akhir_panen'=>$harvestExp[1])));
        // $response2 = $models->execute_kw($this->db, $this->uid, $this->password, 'res.partner', 'name_get',array(array($id)));
        


        $request->session()->flash('status', 'Vendor Product Updated!');

        return response()->json(array('data'=> $response), 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateVendor(Request $request){

    	$logger = new Logger('update_vendor');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $logger->info('Foo '.$request->input('name'));

        $id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $group = $request->input('group');
        $area = $request->input('area');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $response = $models->execute_kw($this->db, $this->uid, $this->password, 'res.partner', 'write',array(array($id), array('name'=>$name,'email'=>$email,'phone'=>$phone,'street'=>$address,'x_farm_group'=>$group,'x_farm_area'=>$area)));
        // $response2 = $models->execute_kw($this->db, $this->uid, $this->password, 'res.partner', 'name_get',array(array($id)));
        
        $request->session()->flash('status', 'Vendor Updated!');

        return response()->json(array('data'=> $response), 200);
    }

    /**
     * delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteVendor(Request $request){

    	$logger = new Logger('delete_vendor');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $logger->info('Foo '.$request->input('id'));

        $id = $request->input('id');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $response = $models->execute_kw($this->db, $this->uid, $this->password,'res.partner', 'unlink',array(array($id)));
        
        $request->session()->flash('status', 'Vendor Deleted!');

        return response()->json(array('data'=> $response), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
