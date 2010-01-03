<?php


/**
 * @author Anthony Cantuta Jorge
 * @version 1.0
 * @created 27-dic-2008 10:05:12 a.m.
 */
class FiltroDocumentos
{

	private $_idDocumento;
	private $_nombreRemite;
	
	/**
	 * @return String
	 */
	public function get_idDocumento() {
		return $this->_idDocumento;
	}
	
	/**
	 * @return String
	 */
	public function get_nombreRemite() {
		return $this->_nombreRemite;
	}
	
	/**
	 * @param String $_idDocumento
	 */
	public function set_idDocumento($_idDocumento) {
		if(!empty($_idDocumento)){
			$this->_idDocumento = $_idDocumento;
		}
	}
	
	/**
	 * @param String $_nombreRemite
	 */
	public function set_nombreRemite($_nombreRemite) {
		if(!empty($_nombreRemite)){
			$this->_nombreRemite = $_nombreRemite;
		}
	}
	function __construct()
	{
	}

	function __destruct()
	{
	}



}
?>