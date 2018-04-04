<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Odoo;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Http\Request;
use Ripcord\Ripcord as RipcordBase;


// use Barryvdh\Debugbar\Facade as DebugBar;

class OdooController extends Controller {

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

	
    public function __construct()
    {

        $this->url = isset($config['url']) ? $config['url'] : config('ripcord.url');
        $this->db = isset($config['db']) ? $config['db'] : config('ripcord.db');
        $this->username = isset($config['user']) ? $config['user'] : config('ripcord.user');
        $this->password = isset($config['password']) ? $config['password'] : config('ripcord.password');

        $this->connect();
    }

    
    public function connect()
    {

    	$logger = new Logger('get_connect');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $common = RipcordBase::client($this->url."/xmlrpc/2/common");

        $this->uid = $common->authenticate($this->db, $this->username, $this->password, []);

        $logger->info($this->uid);	

     }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function getPurchase()
	{
		$logger = new Logger('get_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));


		// $odoo = new Odoo();

		// $purchase = $odoo->getPurchaseOrder();

		$models = RipcordBase::client($this->url."/xmlrpc/2/object");

        $purchase = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order', 'search_read',array(),array('fields'=>array('amount_total','date_order','id','product','name','invoice_status','state')));

		// get purchase order
		for ($i=0; $i < count($purchase); $i++) { 
			 $purchaseItem = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order.line', 'search_read',array(array(array('order_id', '=', $purchase[$i]['id']))),array());
        	 $purchase[$i]['purchase_item'] = $purchaseItem;
			 // $logger->info('Foo '.var_export($productItem,true));	
		}

		return response()->json(array('data'=> $purchase), 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function getPurchaseReport()
	{
		$logger = new Logger('get_purchase_report');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

		// $odoo = new Odoo();

		// $purchase = $odoo->getPurchaseReport();
		$models = RipcordBase::client($this->url."/xmlrpc/2/object");

        $purchase = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.report', 'search_read',array(),array('fields'=>array('commercial_partner_id','price_total')));
        // $purchase = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order.line', 'search_read',array(), array());
		return response()->json(array('data'=> $purchase), 200);
	}

	public function getProductPurchase()
	{
		$logger = new Logger('get_product_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));


		// $odoo = new Odoo();

		// $product = $odoo->getProduct();

		$models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $product = $models->execute_kw($this->db, $this->uid, $this->password,'product.product', 'search_read',array(),array('fields'=>array('name', 'seller_ids','qty_available')));

		// get purchase order
		for ($i=0; $i < count($product); $i++) { 
			 $purchaseProduct = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order.line', 'search_read',array(array(array('product_id', '=', $product[$i]['id']))),array());
       
			 $totalPurchase = 0;

			 for ($j=0; $j < count($purchaseProduct); $j++) { 
			 	$totalPurchase = $totalPurchase + $purchaseProduct[$j]['price_subtotal'];
			 }

			 $product[$i]['total_cost'] = $totalPurchase;
			 // $logger->info('Foo '.var_export($productItem,true));	
		}

		


		return response()->json(array('data'=> $product), 200);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function getProduct()
	{

		$logger = new Logger('get_vendor');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $product = $models->execute_kw($this->db, $this->uid, $this->password,'product.product', 'search_read',array(),array('fields'=>array('name', 'seller_ids','qty_available','image_medium','image','type','x_kategori_produk','x_tipe_produk')));
        
        $vendorArr = array();
        for ($i=0; $i < count($product); $i++) {

        	for ($j=0; $j < count($product[$i]['seller_ids']); $j++) { 
        		$vendor = $models->execute_kw($this->db, $this->uid, $this->password,'product.supplierinfo', 'search_read',array(array(array('id', '=', $product[$i]['seller_ids'][$j]))),array('fields'=>array('name','price')));
        		array_push($vendorArr,$vendor);
        	}

        	$product[$i]['vendor'] = $vendorArr;
        	$vendorArr = array();
        }	
		return response()->json(array('data'=> $product), 200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function getInventoryValuationByProductId()
	{
		$logger = new Logger('get_vendor');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));


		// $odoo = new Odoo();

		// $inventory = $odoo->getProduct();

		$models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $inventory = $models->execute_kw($this->db, $this->uid, $this->password,'product.product', 'search_read',array(),array('fields'=>array('name', 'seller_ids','qty_available')));
        

		for ($i=0; $i < count($inventory); $i++) { 
		   $inventoryVal = $models->execute_kw($this->db, $this->uid, $this->password,'stock.quant', 'search_read',array(array(array('product_id', '=', $inventory[$i]['id']))),array());
       		   
		   $totalVal = 0;

		   for ($j=0; $j < count($inventoryVal); $j++) { 
			 
			 $totalVal = $totalVal + $inventoryVal[$j]['inventory_value'];

		   }

		   $inventory[$i]['inventory_value'] = $totalVal;


		}

		return response()->json(array('data'=> $inventory), 200);
	}


	
}
