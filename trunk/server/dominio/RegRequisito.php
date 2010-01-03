<?php
require_once ('INuevoRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 01-ene-2009 08:35:39 p.m.
 */
class RegRequisito implements INuevoRegistro
{
	
	/**
	 * @return String
	 */
	public function get_descripcion() {
		return $this->_descripcion;
	}
	
	/**
	 * * @return String
	 */
	public function get_nombre() {
		return $this->_nombre;
	}
	
	/**
	 * @param String $_descripcion
	 */
	public function set_descripcion($_descripcion) {
		$this->_descripcion = $_descripcion;
	}
	
	/**
	 * @param String $_nombre
	 */
	public function set_nombre($_nombre) {
		$this->_nombre = $_nombre;
	}

	private $_nombre;
	private $_descripcion;
	private $_ultimoIdInsertado;

	function __construct()
	{
	}

	


	public function registrar()
	{
		$db= FabricaBaseDatos::crear();
		$fila = array(
			"nombre" => $this->_nombre, 
			"descripcion" => $this->_descripcion	
		);
		
		if($db->insert('requisito', $fila)==1){
			$this->_ultimoIdInsertado = $db->lastInsertId();
			return true;
		}
		return false;
	}

	public function get_ultimoIdInsertado()
	{
		return $this->_ultimoIdInsertado;
	}

}
?>