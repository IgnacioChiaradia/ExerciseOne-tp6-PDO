<?php

namespace Models;

class Cellphone{

    private $idCellphone;
    private $code;
    private $brand;
    private $model;
    private $price;

    public function getIdCellphone(){
		return $this->idCellphone;
	}

	public function setIdCellphone($idCellphone){
		$this->idCellphone = $idCellphone;
	}

	public function getCode(){
		return $this->code;
	}

	public function setCode($code){
		$this->code = $code;
	}

	public function getBrand(){
		return $this->brand;
	}

	public function setBrand($brand){
		$this->brand = $brand;
	}

	public function getModel(){
		return $this->model;
	}

	public function setModel($model){
		$this->model = $model;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}
}


?>