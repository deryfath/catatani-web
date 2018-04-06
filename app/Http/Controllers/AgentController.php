<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Odoo;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Http\Request;
use Ripcord\Ripcord as RipcordBase;

class AgentController extends Controller
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
        $data = $models->execute_kw($this->db, $this->uid, $this->password,'x_agent','search_read', array(),array());
        
        for ($i=0; $i < count($data); $i++) { 
      		$data[$i]['action'] = '<button style="margin-right:10px;" data-id="'.$data[$i]['id'].'" data-name="'.$data[$i]['x_name'].'" data-username="'.$data[$i]['x_username'].'" data-password="'.$data[$i]['x_password'].'"  class="btn btn-xs btn-primary edit-agent"><i class="glyphicon glyphicon-edit"></i> Edit</button><button style="margin-right:10px;" class="btn btn-xs btn-danger delete-agent" data-id="'.$data[$i]['id'].'"><i class="glyphicon glyphicon-trash"></i> Delete</button>';
        }

        return response()->json(array('data'=> $data), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function getAgent()
    {

        $logger = new Logger('get_agent');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $agent = $models->execute_kw($this->db, $this->uid, $this->password,'x_agent', 'search_read',array(),array());
        
        return response()->json(array('data'=> $agent), 200);
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

    	$logger = new Logger('insertAgent');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $name = $request->input('agent_name');
        $username = $request->input('agent_username');
        $password = $request->input('agent_password');
       

        $logger->info('Foo '.$name);

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $id = $models->execute_kw($this->db, $this->uid, $this->password,'x_agent', 'create',array(array('x_name'=>$name,'x_username'=>$username,'x_password'=>$password)));

        return redirect('/agents')->with('status', 'Pembeli berhasil ditambahkan!');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAgent(Request $request){

    	$logger = new Logger('update_agent');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $logger->info('Foo '.$request->input('name'));

        $id = $request->input('id');
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
      

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $response = $models->execute_kw($this->db, $this->uid, $this->password, 'x_agent', 'write',array(array($id), array('x_name'=>$name,'x_username'=>$username,'x_password'=>$password)));
        // $response2 = $models->execute_kw($this->db, $this->uid, $this->password, 'res.partner', 'name_get',array(array($id)));
        
        $request->session()->flash('status', 'Pembeli berhasil diupdate!');

        return response()->json(array('data'=> $response), 200);
    }

    /**
     * delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAgent(Request $request){

    	$logger = new Logger('delete_vendor');
        // Now add some handlers
        $logger->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));

        $logger->info('Foo '.$request->input('id'));

        $id = $request->input('id');

        $models = RipcordBase::client($this->url."/xmlrpc/2/object");
        $response = $models->execute_kw($this->db, $this->uid, $this->password,'x_agent', 'unlink',array(array($id)));
        
        $request->session()->flash('status', 'Pembeli Berhasil Dihapus!');

        return response()->json(array('data'=> $response), 200);
    }
}
