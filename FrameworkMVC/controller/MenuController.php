<?php

class BajaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
		}
	
	}
	
	

	public function Permiso(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
				
				return  true;
		}
		else {
			
			return  false;
		}
	
	}
	
	 
	
}
?>      