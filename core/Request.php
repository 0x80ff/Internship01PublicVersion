<?php
class Request{
	

	public $url; 	// URL appellé par l'utilisateur
	public $method; //Methode POST/GET

	function __construct(){
		//$this->url = $_SERVER['PATH_INFO']; 
		$req = str_replace(BASE_URI."/", "", $_SERVER['REQUEST_URI']);
		//$method = $_SERVER['REQUEST_METHOD'];
		$this->url = $req;
		//$this->method = $method;
		//echo $this->method;
	}


}