<?php

Paquete::usar("configuracion.ConfigDataBase");

abstract class ConfigGlobal {
	
	

	public function __construct()
	{
		
		
	}
	  
	/*
	 * obtener Configuracion de base de datos
	 * @return ConfigDataBase
	 */
	static public function getDb()
	{
		$dbConfig=new ConfigDataBase();	
		return $dbConfig;
	}
	
	
	static public function getUrlGlobal(){
		return "http://localhost/midocu/";
	}
	
	static public function getPathGlobal(){
		return dirname(dirname(__FILE__));
	}
	
	static public function getDebug(){
		return false;
	}

}

?>
