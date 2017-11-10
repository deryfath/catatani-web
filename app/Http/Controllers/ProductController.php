<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Odoo;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Http\Request;
use Ripcord\Ripcord as RipcordBase;

class ProductController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    	$logger = new Logger('insertProduct');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $name = $request->input('product_name');

        $other = $request->input('other_category');
        if($other=="" || $other==null){
        	$kategori = $request->input('product_category');
        }else{
        	$kategori = $other;
        }
        

        $image = $request->file('product_image');
        
        $im = file_get_contents($image);
        $imdata = base64_encode($im);
        $logger->info('Image '.$imdata);

        //save to product template
        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $productId = $models->execute_kw($this->db, $this->uid, $this->password,'product.template', 'create',array(array('name'=>$name,'type'=>'product','available_in_pos'=>false ,'image'=>$imdata,'x_kategori_produk'=>$kategori)));

        $logger->info('Product ID '.$productId);

        //save vendor product
        // $models = RipcordBase::client("http://192.168.130.111:38069/xmlrpc/2/object");
        // $id = $models->execute_kw($this->db, $this->uid, $this->password,'product.supplierinfo', 'create',array(array('name' => $vendorExp[0], 'min_qty' => 0, 'delay' => 1, 'price' => $price, 'product_tmpl_id' => $productId, 'product_code' => '')));


        return redirect('/product')->with('status', 'Product Created!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProduct(Request $request){

    	$logger = new Logger('update_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
        

        $id = $request->input('id');
        $name = $request->input('name');
        $category = $request->input('category');
        $image = $request->input('image');

        $logger->info('Image '. $image);

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $response = $models->execute_kw($this->db, $this->uid, $this->password, 'product.template', 'write',array(array($id), array('name'=>$name,'image'=>$image,'x_kategori_produk'=>$category)));
        // $response2 = $models->execute_kw($this->db, $this->uid, $this->password, 'product.template', 'name_get',array(array($id)));

        $request->session()->flash('status', 'Product Updated!');

        return response()->json(array('data'=> $response), 200);
    }

    /**
     * delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct(Request $request){

    	$logger = new Logger('delete_product');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $logger->info('Foo '.$request->input('id'));

        $id = $request->input('id');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $response = $models->execute_kw($this->db, $this->uid, $this->password,'product.template', 'unlink',array(array($id)));
        
        if( isset( $response['faultCode'] ) ){
        	$request->session()->flash('statusError', 'Gagal menghapus komoditi yang sudah masuk proses Transaksi Pembelian');
        }else {
        	$request->session()->flash('status', 'Komoditi Berhasil Dihapus!');
        }

        // $logger->info('Foo '. var_export($response, true));

        return response()->json(array('data'=> $response), 200);
    }



}
