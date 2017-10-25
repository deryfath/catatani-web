<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Odoo;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Http\Request;
use Ripcord\Ripcord as RipcordBase;

class InventoryController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataProductByItem(Request $request){

    	$logger = new Logger('get_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $id = $request->input('product_id');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");

        //GET ORIGIN
        $product = $models->execute_kw($this->db, $this->uid, $this->password,'product.product', 'search_read',array(array(array('id', '=', $id ))),array('fields'=>array('name', 'seller_ids','qty_available','image_medium','type','x_kategori_produk')));
        
        $vendorArr = array();
        for ($i=0; $i < count($product); $i++) {

        	for ($j=0; $j < count($product[$i]['seller_ids']); $j++) { 
        		$vendor = $models->execute_kw($this->db, $this->uid, $this->password,'product.supplierinfo', 'search_read',array(array(array('id', '=', $product[$i]['seller_ids'][$j]))),array('fields'=>array('name','price','x_product_origin')));
        		array_push($vendorArr,$vendor);
        	}

        	$product[$i]['vendor'] = $vendorArr;
        	$vendorArr = array();
        }

        $logger->info('ARR product '.var_export($product,true));

        //GET PURCHASE LINE
        $purchaseOrderLine = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order.line', 'search_read',array(array(array('product_id', '=', $id ))),array('fields'=>array('date_order','state','price_unit','product_qty','product_id','order_id','price_subtotal','partner_id','x_quality_product')));
        	

        for ($i=0; $i < count($purchaseOrderLine); $i++) { 

      		for ($l=0; $l < count($product[0]['vendor']); $l++) { 
        		
        		if($purchaseOrderLine[$i]['partner_id'][0]==$product[0]['vendor'][$l][0]['name'][0]){

        			$purchaseOrderLine[$i]['origin'] = $product[0]['vendor'][$l][0]['x_product_origin'];
        			break;
        		}else{
                    $purchaseOrderLine[$i]['origin'] = "unknown";

                }
        	}

        }
        

        session(['arrProductInventory' => $purchaseOrderLine]);

        $logger->info('ARR INVENTORY '.var_export($purchaseOrderLine,true));

        return response()->json(array('data'=> $purchaseOrderLine), 200);
     }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataProductByItem(){
    	$logger = new Logger('get_data_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

    	$data = session('arrProductInventory');

    	return response()->json(array('data'=> $data), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataVendorProductByItem(Request $request){

    	$logger = new Logger('get_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $id = $request->input('product_id');

        $logger->info('PROSES '.$id);

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");

        //GET ORIGIN
        $product = $models->execute_kw($this->db, $this->uid, $this->password,'product.product', 'search_read',array(array(array('id', '=', $id ))),array());

        $processArr = array('0'=> array( 'proses' => 'Natural'),'1'=>array('proses' => 'Semiwash'), '2'=> array('proses'=>'Fullwash') );

        for ($i=0; $i < count($processArr); $i++) { 
        	$processArr[$i]['qty'] = $product[0]['qty_available'];
        	if($processArr[$i]['proses']=="Natural"){
        		$processArr[$i]['jc'] = $product[0]['x_natural_jc'];
        		$processArr[$i]['jk'] = $product[0]['x_natural_jk'];
        		$processArr[$i]['final'] = $product[0]['x_natural_final'];
        		$processArr[$i]['grade1'] = $product[0]['x_natural_grade1'];
        		$processArr[$i]['grade2'] = $product[0]['x_natural_grade2'];
        		$processArr[$i]['grade3'] = $product[0]['x_natural_grade3'];
        		$processArr[$i]['grade4'] = $product[0]['x_natural_grade4'];
        		$processArr[$i]['grade5'] = $product[0]['x_natural_grade5'];
        		$processArr[$i]['grade6'] = $product[0]['x_natural_grade6'];
        	}else if($processArr[$i]['proses']=="Semiwash"){
        		$processArr[$i]['jc'] = $product[0]['x_semiwash_jc'];
        		$processArr[$i]['jk'] = $product[0]['x_semiwash_jk'];
        		$processArr[$i]['final'] = $product[0]['x_semiwash_final'];
        		$processArr[$i]['grade1'] = $product[0]['x_semiwash_grade1'];
        		$processArr[$i]['grade2'] = $product[0]['x_semiwash_grade2'];
        		$processArr[$i]['grade3'] = $product[0]['x_semiwash_grade3'];
        		$processArr[$i]['grade4'] = $product[0]['x_semiwash_grade4'];
        		$processArr[$i]['grade5'] = $product[0]['x_semiwash_grade5'];
        		$processArr[$i]['grade6'] = $product[0]['x_semiwash_grade6'];
        	}else if($processArr[$i]['proses']=="Fullwash"){
        		$processArr[$i]['jc'] = $product[0]['x_fullwash_jc'];
        		$processArr[$i]['jk'] = $product[0]['x_fullwash_jk'];
        		$processArr[$i]['final'] = $product[0]['x_fullwash_final'];
        		$processArr[$i]['grade1'] = $product[0]['x_fullwash_grade1'];
        		$processArr[$i]['grade2'] = $product[0]['x_fullwash_grade2'];
        		$processArr[$i]['grade3'] = $product[0]['x_fullwash_grade3'];
        		$processArr[$i]['grade4'] = $product[0]['x_fullwash_grade4'];
        		$processArr[$i]['grade5'] = $product[0]['x_fullwash_grade5'];
        		$processArr[$i]['grade6'] = $product[0]['x_fullwash_grade6'];
        	}
        	$processArr[$i]['action'] = '<button style="margin-right:10px;" data-id="'.$product[0]['id'].'" data-qty="'.$processArr[$i]['qty'].'" data-jk="'.$processArr[$i]['jk'].'" data-jc="'.$processArr[$i]['jc'].'" data-final="'.$processArr[$i]['final'].'" data-proses="'.$processArr[$i]['proses'].'" class="btn btn-xs btn-primary edit-vendor-comodity-process"><i class="glyphicon glyphicon-edit"></i> Edit</button>';
        	$processArr[$i]['actionResult'] = '<button style="margin-right:10px;" data-id="'.$product[0]['id'].'" data-grade1="'.$processArr[$i]['grade1'].'" data-grade2="'.$processArr[$i]['grade2'].'" data-grade3="'.$processArr[$i]['grade3'].'" data-grade4="'.$processArr[$i]['grade4'].'" data-grade5="'.$processArr[$i]['grade5'].'" data-grade6="'.$processArr[$i]['grade6'].'" data-proses="'.$processArr[$i]['proses'].'" class="btn btn-xs btn-primary edit-vendor-comodity-result"><i class="glyphicon glyphicon-edit"></i> Edit</button>';
        }

        session(['arrProductProcessInventory' => $processArr]);

        return response()->json(array('data'=> $processArr), 200);
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataVendorProductByItem(){

    	$logger = new Logger('get_data_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

    	$data = session('arrProductProcessInventory');

        return response()->json(array('data'=> $data), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProductInventoryProcess(Request $request){

    	$logger = new Logger('update_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
        
        $id = $request->input('id');
        $process = $request->input('process');
        $jk = $request->input('jk');
        $jc = $request->input('jc');
        $final = $request->input('final_val');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");

        $response = null;
        
        if($process=="Natural"){
        	$response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.product', 'write',array(array($id), array('x_natural_jk'=>$jk,'x_natural_jc'=>$jc, 'x_natural_final'=>$final)));
        }else if($process=="Semiwash"){
        	$response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.product', 'write',array(array($id), array('x_semiwash_jk'=>$jk,'x_semiwash_jc'=>$jc, 'x_semiwash_final'=>$final)));
     
        }else if($process=="Fullwash"){
        	$response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.product', 'write',array(array($id), array('x_fullwash_jk'=>$jk,'x_fullwash_jc'=>$jc, 'x_fullwash_final'=>$final)));
     
        }
                
        // $logger->info('Foo '. var_export($response, true));

        return response()->json(array('data'=> $response), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProductInventoryResult(Request $request){

    	$logger = new Logger('update_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
        
        $id = $request->input('id');
        $process = $request->input('process');
        $grade1 = $request->input('grade1');
        $grade2 = $request->input('grade2');
        $grade3 = $request->input('grade3');
        $grade4 = $request->input('grade4');
        $grade5 = $request->input('grade5');
        $grade6 = $request->input('grade6');

        $logger->info('grade1 '. $grade1);

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");

        $response = null;
        
        if($process=="Natural"){
        	$response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.product', 'write',array(array($id), array('x_natural_grade1'=>$grade1,'x_natural_grade2'=>$grade2, 'x_natural_grade3'=>$grade3, 'x_natural_grade4'=>$grade4, 'x_natural_grade5'=>$grade5, 'x_natural_grade6'=>$grade6)));
        }else if($process=="Semiwash"){
        	$response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.product', 'write',array(array($id), array('x_semiwash_grade1'=>$grade1,'x_semiwash_grade2'=>$grade2, 'x_semiwash_grade3'=>$grade3, 'x_semiwash_grade4'=>$grade4, 'x_semiwash_grade5'=>$grade5, 'x_semiwash_grade6'=>$grade6)));
     
        }else if($process=="Fullwash"){
        	$response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.product', 'write',array(array($id), array('x_fullwash_grade1'=>$grade1,'x_fullwash_grade2'=>$grade2, 'x_fullwash_grade3'=>$grade3, 'x_fullwash_grade4'=>$grade4, 'x_fullwash_grade5'=>$grade5, 'x_fullwash_grade6'=>$grade6)));
     
        }
                
        // $logger->info('Foo '. var_export($response, true));

        return response()->json(array('data'=> $response), 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataStockComodityInventory(){

    	$logger = new Logger('get_data_stock_inventory');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

    	$models = RipcordBase::client($this->url."/xmlrpc/2/object");

    	$processArr = array('0'=> array( 'proses' => 'Natural'),'1'=>array('proses' => 'Semiwash'), '2'=> array('proses'=>'Fullwash') );

    	$productArr = array();

        //GET ORIGIN
        $product = $models->execute_kw($this->db, $this->uid, $this->password,'product.product', 'search_read',array(),array());

        $length = count($processArr) * count($product);

        $logger->info('length '. $length);

        $k = 0;
        $l = 0;

        for ($i=0; $i < $length; $i++) {

        	$productArr[$i]['name'] = $product[$l]['name'];

        	$productArr[$i]['proses'] = $processArr[$k]['proses'];

        	if($processArr[$k]['proses'] == "Natural"){
        		$productArr[$i]['grade1'] = $product[$l]['x_natural_grade1'];
        		$productArr[$i]['grade2'] = $product[$l]['x_natural_grade2'];
        		$productArr[$i]['grade3'] = $product[$l]['x_natural_grade3'];
        		$productArr[$i]['grade4'] = $product[$l]['x_natural_grade4'];
        		$productArr[$i]['grade5'] = $product[$l]['x_natural_grade5'];
        		$productArr[$i]['grade6'] = $product[$l]['x_natural_grade6'];
        	}else if($processArr[$k]['proses'] == "Semiwash"){
        		$productArr[$i]['grade1'] = $product[$l]['x_semiwash_grade1'];
        		$productArr[$i]['grade2'] = $product[$l]['x_semiwash_grade2'];
        		$productArr[$i]['grade3'] = $product[$l]['x_semiwash_grade3'];
        		$productArr[$i]['grade4'] = $product[$l]['x_semiwash_grade4'];
        		$productArr[$i]['grade5'] = $product[$l]['x_semiwash_grade5'];
        		$productArr[$i]['grade6'] = $product[$l]['x_semiwash_grade6'];
        	}else if($processArr[$k]['proses'] == "Fullwash"){
        		$productArr[$i]['grade1'] = $product[$l]['x_fullwash_grade1'];
        		$productArr[$i]['grade2'] = $product[$l]['x_fullwash_grade2'];
        		$productArr[$i]['grade3'] = $product[$l]['x_fullwash_grade3'];
        		$productArr[$i]['grade4'] = $product[$l]['x_fullwash_grade4'];
        		$productArr[$i]['grade5'] = $product[$l]['x_fullwash_grade5'];
        		$productArr[$i]['grade6'] = $product[$l]['x_fullwash_grade6'];
        	}

        	$k++;

        	if($k > count($processArr)-1){
        		$l++;
        		$k = 0;
        	}

        }

        

        return response()->json(array('data'=> $productArr), 200);
    }
}
