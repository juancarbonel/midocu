<?php
Paquete::usar ( "dominio.INuevoRegistro" );

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:48 p.m.
 */
class RegArea implements INuevoRegistro {
	
	private $_nombre;
	private $_descripcion;
	private $_idAreaPadre;
	private $_ultimoIdInsertado;
	
	function __construct() {
	}
	
	function __destruct() {
	}
	
	/**
	 * @param String $_idAreaPadre
	 */
	public function set_idAreaPadre($_idAreaPadre) {
		if(!empty($_idAreaPadre))
		{
			$this->_idAreaPadre = $_idAreaPadre;
		}
	}
	
	/**
	 * @param String $_descripcion
	 */
	public function set_descripcion($_descripcion) {
		if(!empty($_descripcion))
		{
			$this->_descripcion = $_descripcion;
		}
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		if(!empty($_nombre))
		{
			$this->_nombre = $_nombre;
		}
	}
	
	public function registrar() {
		$db = FabricaBaseDatos::crear ();
		
		$arrayInsertar = array (
		"nombre" =>$this->_nombre,
		"descripcion" => $this->_descripcion, 
		"id_area_padre" => $this->_idAreaPadre );
		
		if ($db->insert ( "area", $arrayInsertar )>= 1) {
			$this->_ultimoIdInsertado = $db->lastInsertId ();
			return true;
		} 
		return false;
	}
	
	public function get_ultimoIdInsertado() {
		return $this->_ultimoIdInsertado;
	}

}
?>