<?php

namespace App\Http\Controllers;

use Ripcord\Providers\Laravel\Ripcord;


class Odoo extends Ripcord
{

	/**
     * @var string
     */
	protected $ripcord;

	public function __construct()
    {
    	$this->ripcord = new Ripcord();

    }

	public function insertProduct(){
		
		// $ripcord = new Ripcord();

		$this->ripcord->insertProduct();

		return $this->ripcord->identifier;

	}

	public function getProduct(){
		
		// $ripcord = new Ripcord();

		$this->ripcord->getProduct();

		return $this->ripcord->product;

	}


	public function getVendor($id){
		
		// $ripcord = new Ripcord();

		$this->ripcord->getVendor($id);

		return $this->ripcord->vendor;

	}

	public function getPurchaseOrderItemByProductId($id){
		
		// $ripcord = new Ripcord();

		$this->ripcord->getPurchaseOrderItemByProductId($id);

		return $this->ripcord->purchaseOrder;

	}

	public function getPurchaseOrder(){
		
		// $ripcord = new Ripcord();

		$this->ripcord->getPurchaseOrder();

		return $this->ripcord->purchaseOrder;

	}

	public function getPurchaseOrderItem($id){
		
		// $ripcord = new Ripcord();

		$this->ripcord->getPurchaseOrderItem($id);

		return $this->ripcord->purchaseOrder;

	}

	public function getInventoryProduct(){
		
		// $ripcord = new Ripcord();

		$this->ripcord->getInventoryProduct();

		return $this->ripcord->inventory;

	}

	public function getInventoryValuation($id){
		// $ripcord = new Ripcord();

		$this->ripcord->getInventoryValuation($id);

		return $this->ripcord->inventory;
	}

	public function getPurchaseReport(){
		
		// $ripcord = new Ripcord();

		$this->ripcord->getPurchaseReport();

		return $this->ripcord->purchaseReport;

	}

	public function getWeather(){

		$this->ripcord->getWeather();

		return $this->ripcord->resp;
	}

}


 ?>