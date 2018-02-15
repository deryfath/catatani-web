<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Ripcord\Ripcord as RipcordBase;

class DashboardController extends Controller
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->url = isset($config['url']) ? $config['url'] : config('ripcord.url');
        $this->db = isset($config['db']) ? $config['db'] : config('ripcord.db');
        $this->username = isset($config['user']) ? $config['user'] : config('ripcord.user');
        $this->password = isset($config['password']) ? $config['password'] : config('ripcord.password');


        $this->connect();
    }

    public function connect()
    {

        $logger = new Logger('dashboard');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $common = RipcordBase::client($this->url."/xmlrpc/2/common");

        $this->uid = $common->authenticate($this->db, $this->username, $this->password, []);

        $logger->info($this->uid);  

     }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDashboardCount()
    {   

        $logger = new Logger('dashboard_count');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");

        $varCount = array();

        $dataPurchase = $models->execute_kw($this->db, $this->uid, $this->password,'purchase.order','search_read', array(array(array('invoice_status', '=', 'invoiced' ))),array('fields'=>array('id','amount_total')));
        $dataProduct = $models->execute_kw($this->db, $this->uid, $this->password,'product.product','search_read', array(),array('fields'=>array('id','qty_available','name')));
        $dataVendor = $data = $models->execute_kw($this->db, $this->uid, $this->password,'res.partner','search_read', array(array(array('supplier', '=', true))),array('fields'=>array('id')));
        
        $dataStockProduct = $data = $models->execute_kw($this->db, $this->uid, $this->password,'stock.quant','search_read', array(),array());
        
        $arrStockProduct = array();

        // for ($k=0; $k < count($dataProduct); $k++) { 
            
        //     for ($l=0; $l < count($dataStockProduct); $l++) { 
        //        if($dataProduct[$k]['id']==$dataStockProduct[$l]['product_id']){
        //            array_push(array, var)
        //        }
        //     }
        // }

        $countTotalComodity = 0;
        for ($i=0; $i < count($dataProduct) ; $i++) { 
            $countTotalComodity = $countTotalComodity + $dataProduct[$i]['qty_available'];
        }

        $amountTotalPurchase = 0;
        for ($j=0; $j < count($dataPurchase); $j++) { 
            $amountTotalPurchase = $amountTotalPurchase + $dataPurchase[$j]['amount_total'];
        }

        $logger->info('ARR amount '.$amountTotalPurchase);

        array_push($varCount, count($dataPurchase),count($dataProduct),count($dataVendor),$countTotalComodity,$dataProduct,$amountTotalPurchase,$dataStockProduct);
        return response()->json(array('data'=> $varCount), 200);
    }


}
