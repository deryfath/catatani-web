<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Odoo;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Http\Request;
use Ripcord\Ripcord as RipcordBase;

class PurchaseController extends Controller
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

    protected $arrProduct;

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

        $data = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order','search_read', array(),array());

         for ($i=0; $i < count($data); $i++) { 
      		if($data[$i]['invoice_status']=="invoiced"){
      			$data[$i]['purchase_status'] = "Lunas";
      		}else{
      			$data[$i]['purchase_status'] = "Menunggu Pembayaran"; 
      		}
      		$data[$i]['vendor_name'] = $data[$i]['partner_id'][1];

            $string_version = implode(',', $data[$i]['order_line']);
            $data[$i]['action'] = '<button style="margin-right:10px;" data-total="'.$data[$i]['amount_total'].'" data-vendor="'.$data[$i]['vendor_name'].'" data-orderline="'.$string_version.'" class="btn btn-xs btn-primary detail-purchase"><i class="glyphicon glyphicon-eye-open"></i> Detail</button>';
       
      	 }

        return response()->json(array('data'=> $data), 200);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataProductVendor(Request $request)
    {

    	$logger = new Logger('data_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        // $this->arrProduct = array();
        
    	$this->arrProduct = $request->input('arr_product');

		$logger->info('ARR '.var_export($this->arrProduct,true));

		session(['arrProductPurchase' => $this->arrProduct]);

		return response()->json(array('data'=> $this->arrProduct), 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataProductPurchase(){
    	$logger = new Logger('get_data_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

    	$data = session('arrProductPurchase');

        $logger->info('ARR '.var_export($data,true));

    	for ($i=0; $i < count($data); $i++) { 
      		$data[$i]['action'] = '<button style="margin-right:10px;" data-partnerid="'.$data[$i]['partner_id'].'" data-productid="'.$data[$i]['product_id'].'" data-name="'.$data[$i]['name'].'" data-price="'.$data[$i]['price'].'" data-quantity="'.$data[$i]['quantity'].'" data-subtotal="'.$data[$i]['subtotal'].'" data-quality="'.$data[$i]['quality'].'" class="btn btn-xs btn-primary edit-cart-purchase"><i class="glyphicon glyphicon-edit"></i> Edit</button><button style="margin-right:10px;" class="btn btn-xs btn-danger delete-cart-purchase" data-productid="'.$data[$i]['product_id'].'"><i class="glyphicon glyphicon-trash"></i> Delete</button>';
        }

    	return response()->json(array('data'=> $data), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$logger = new Logger('store_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $arrDataCart = $request->input('arr_product');

		$logger->info('ARR CART'.var_export($arrDataCart,true));	

        $now = date("Y-m-d H:i:s");
        $purchaseName = "Purchase Order";

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $data = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order','search_read', array(),array());
        
        $logger->info('part'.$arrDataCart[0]['partner_id']);

        $partner = explode(",",$arrDataCart[0]['vendor_name']);
        $partnerId = (int)$partner[0];

        //PURCHASE
        $purchase = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order', 'create',array(array('partner_id'=>$partnerId,'state'=>'purchase')));
        // $purchaseLine = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order.line', 'create',array(array('name'=>$purchaseName,'date_planned'=>$now,'product_id'=>20,'order_id'=>$purchase,'product_uom'=>1, 'product_qty'=>1.0,  'price_unit'=>2000)));
        
        $arrPurchaseLineId = array();

        for ($i=0; $i<count($arrDataCart) ; $i++) { 
        	$arrPurchaseLineId[$i] = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order.line', 'create',array(array('name'=>$purchaseName,'date_planned'=>$now,'product_id'=>$arrDataCart[$i]['product_id'],'x_quality_product'=>$arrDataCart[$i]['quality'],'order_id'=>$purchase,'product_uom'=>1, 'product_qty'=>$arrDataCart[$i]['quantity'], 'qty_received'=>$arrDataCart[$i]['quantity'], 'price_unit'=>$arrDataCart[$i]['price'])));
        }

        $logger->info('ARR purchase'.var_export($purchase,true));	

        //RECEIVE PRODUCT
        $attrPurchase = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order','search_read', array(array(array('id', '=', $purchase))),array());	
        $stockMove = $models->execute_kw($this->db, $this->uid, $this->password,'stock.move','search_read', array(array(array('origin', '=', $attrPurchase[0]['name']))),array());	
        $stock = $models->execute_kw($this->db, $this->uid, $this->password, 'stock.move', 'write',array(array($stockMove[0]['id']), array('state'=>'done')));
        $stockImmediate = $models->execute_kw($this->db, $this->uid, $this->password,'stock.immediate.transfer', 'create',array(array('pick_id'=>$stockMove[0]['picking_id'][0])));
        $applyStockImmediate = $models->execute_kw($this->db, $this->uid, $this->password,'stock.immediate.transfer', 'process',array(array($stockImmediate)),array());        

        //INVOICE VALIDATE
        $invoice = $models->execute_kw($this->db, $this->uid, $this->password,'account.invoice', 'create',array(array('partner_id'=>$partnerId,'company_id'=>1,'currency_id'=>13,'journal_id'=>2,'account_id'=>13,'purchase_id'=>$purchase,'origin'=>$attrPurchase[0]['name'],'type'=>'in_invoice')));
        // $invoiceLine = $models->execute_kw($this->db, $this->uid, $this->password,'account.invoice.line', 'create',array(array('name'=>$attrPurchase[0]['name'].': '.$purchaseName,'invoice_id'=>$invoice,'product_id'=>20,'account_id'=>19,'invoice_line_tax_ids'=>[2],'purchase_line_id'=>$arrPurchaseLineId[0],'origin'=>$attrPurchase[0]['name'],'uom_id'=>1,'quantity'=>1.0,'price_unit'=>2000)));    	
		
        $arrInvoiceLineId = array();

        for ($j=0; $j < count($arrDataCart) ; $j++) { 

        	$arrInvoiceLineId[$j] = $models->execute_kw($this->db, $this->uid, $this->password,'account.invoice.line', 'create',array(array('name'=>$attrPurchase[0]['name'].': '.$purchaseName,'invoice_id'=>$invoice,'product_id'=>$arrDataCart[$j]['product_id'],'account_id'=>19,'invoice_line_tax_ids'=>[2],'purchase_line_id'=>$arrPurchaseLineId[$j],'origin'=>$attrPurchase[0]['name'],'uom_id'=>1,'quantity'=>$arrDataCart[$j]['quantity'],'price_unit'=>$arrDataCart[$j]['price'])));    	
        
        }

		$validateOpen = $models->execute_kw($this->db, $this->uid, $this->password, 'account.invoice', 'action_invoice_open',array(array($invoice), array('state'=>'open')));        
        
        //PAYMENT
    	$moveInvoice = $models->execute_kw($this->db, $this->uid, $this->password,'account.invoice','search_read', array(array(array('id', '=', $invoice))),array('fields'=>array('move_id')));
    	$payment = $models->execute_kw($this->db, $this->uid, $this->password,'account.payment', 'create',array(array('partner_id'=>$partnerId,'partner_type'=>'supplier','payment_type'=>'outbound','currency_id'=>13,'payment_method_id'=>2,'journal_id'=>6,'amount'=>$attrPurchase[0]['amount_total'],'payment_date'=>date('Y-m-d'),'communication'=>$moveInvoice[0]['move_id'][1],'invoice_ids'=>array(array(6,0,array($invoice))) )));
        $postPayment = $models->execute_kw($this->db, $this->uid, $this->password,'account.payment', 'post',array($payment));
       		

        return response()->json(array('data'=> $payment), 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateComodityPricePurchase(Request $request){

        $logger = new Logger('update_vendor_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $id = $request->input('id');
        $price = $request->input('price');


        $logger->info('PRICE '.$price);
        
        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.supplierinfo', 'write',array(array($id), array('price'=>$price)));
        // $response2 = $models->execute_kw($this->db, $this->uid, $this->password, 'res.partner', 'name_get',array(array($id)));
        


        $request->session()->flash('status', 'Vendor Product Updated!');

        return response()->json(array('data'=> $response), 200);
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dataProductVendorPurchaseLine(Request $request)
    {

        $logger = new Logger('data_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        // $this->arrProduct = array();
        
        $this->arrProduct = $request->input('arr_order');

        $logger->info('ARR '.var_export($this->arrProduct,true));

        session(['arrProductPurchaseLine' => $this->arrProduct]);

        return response()->json(array('data'=> $this->arrProduct), 200);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataProductPurchaseLine(){
        $logger = new Logger('get_data_purchase');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $data = session('arrProductPurchaseLine');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        
        $arrDetail = array();
        for ($i=0; $i < count($data[0]); $i++) { 

           $dataDetail = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order.line','search_read', array(array(array('id', '=', $data[0][$i]))),array());
           
           array_push($arrDetail, $dataDetail[0]);
        }

        return response()->json(array('data'=> $arrDetail), 200);
    }


}
