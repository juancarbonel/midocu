<?php

/**
 * Configuracion de la base de datos...
 *
 */
class ConfigDataBase {
	
	
	/**
	 * Enter description here...
	 *
	 * @var tipo de base de datos Mysql =
	 */
	public 	$type_db="PdoMysql";
	public  $host="localhost";
	public  $dbname="midocu";
	public  $username="root";
	public  $password="";
	
	
	
	
	/**
	 * convierte los tributos de la clase a un Array
	 *
	 * @return Array
	 */
	public function toArray() 
	{
		    $parametros = array ( 
		    'host' =>$this->host, 
   			'username' => $this->username, 
   			'password' => $this->password, 
   			'dbname' => $this->dbname);

		    return $parametros;
	}
	
}

?>
