<?php
require_once ('IRegistro.php');

/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 04-dic-2008 08:18:48 p.m.
 */
class RecepcionDocumento implements IConvertibleXml
{

	private $_fecha;
	private $_idDocumento;
	/**
	 * @return String
	 */
	public function get_idAreaRecepciona() {
		return $this->_idAreaRecepciona;
	}
	
	/**
	 * @param String $_idAreaRecepciona
	 */
	public function set_idAreaRecepciona($_idAreaRecepciona) {
		$this->_idAreaRecepciona = $_idAreaRecepciona;
	}

	private $_idAreaRecepciona;
	
	/**
	 * @return String
	 */
	public function get_fecha() {
		return $this->_fecha;
	}
	
	
	
	/**
	 * @return String
	 */
	public function get_idDocumento() {
		return $this->_idDocumento;
	}
	
	/**
	 * @param String $_fecha
	 */
	public function set_fecha($_fecha) {
		$this->_fecha = $_fecha;
	}
	
	
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		$this->_idDocumento = $_idDocumento;
	}
	function __construct()
	{
	}

	function __destruct()
	{
	}




	public function toXml()
	{
	}

	

}
?>